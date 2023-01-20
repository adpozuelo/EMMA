from peewee import *
from emma_model import *
import adafruit_dht
from board import *
from datetime import datetime
import psutil
import platform

sensor_model = 'dht22'
SENSOR_PIN = D4

mysql_db.connect()
tables = [Raspberry, Sensor, Sensor_Measure, Node, Alarm]
mysql_db.create_tables(tables, safe=True)

now = datetime.now()
now_int = int(now.strftime('%y%m%d%H%M'))
hostname = platform.node()
sensor_name = sensor_model+'_'+hostname
eth_name = list(psutil.net_if_addrs().keys())[1]

try:
    raspi = Raspberry.get(Raspberry.hostname == hostname)
except Raspberry.DoesNotExist:
    raspi = Raspberry.create(
        hostname=hostname,
        ip_address=f"{psutil.net_if_addrs()[eth_name][0].address}"
    )

try:
    sensor = Sensor.get(Sensor.name == sensor_name)
except Sensor.DoesNotExist:
    sensor = Sensor.create(
        name=sensor_name,
        raspberry=raspi,
        type='TH'
    )

try:
    dht22 = adafruit_dht.DHT22(SENSOR_PIN, use_pulseio=False)
    temperature = dht22.temperature
    humidity = dht22.humidity
except:
    if sensor.online:
        sensor.error_count += 1
        if sensor.error_count == 3:
            alarm = Alarm.create(
                msg = f'{sensor.name} alarm! Several measurements error, sensor is offline.',
                sensor= sensor,
                raspberry = raspi,
                date = now_int
            )
            sensor.online = 0
            sensor.save()

if temperature is not None and humidity is not None:
    if sensor.online and sensor.error_count > 0:
        sensor.error_count = 0
        sensor.save()
    if not sensor.online:
        sensor.error_count -=1
        if sensor.error_count == 0:
            alarm = Alarm.create(
                msg = f'{sensor.name} alarm! Measurements error solved, sensor is online.',
                sensor= sensor,
                raspberry = raspi,
                date = now_int
            )
            sensor.online = 1
            sensor.save()

    sensor_measure = Sensor_Measure.create(
        sensor=sensor,
        date=now_int,
        temp=temperature,
        hum=humidity
    )

    if sensor.status:
        if temperature > sensor.warning_temp and temperature < sensor.critical_temp:
            alarm = Alarm.create(
                msg = f'{sensor.name} alarm! Warning temperature: {temperature} ºC.',
                sensor= sensor,
                raspberry = raspi,
                date = now_int
            )
        elif temperature > sensor.critical_temp:
            alarm = Alarm.create(
                msg = f'{sensor.name} alarm! Critical temperature: {temperature} ºC.',
                sensor= sensor,
                raspberry = raspi,
                date = now_int
            )
        if humidity > sensor.warning_hum and humidity < sensor.critical_hum:
            alarm = Alarm.create(
                msg = f'{sensor.name} alarm! Warning humidity: {humidity} %.',
                sensor= sensor,
                raspberry = raspi,
                date = now_int
            )
        elif humidity > sensor.critical_hum:
            alarm = Alarm.create(
                msg = f'{sensor.name} alarm! Critical humidity: {humidity} %.',
                sensor= sensor,
                raspberry = raspi,
                date = now_int
            )

mysql_db.close()
