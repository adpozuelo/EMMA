from peewee import *
from emma_model import *
import adafruit_dht
import RPi.GPIO as GPIO
from board import *
from datetime import datetime
import time
import psutil
import platform

time.sleep(60)

sensor_model = 'ruido'

SENSOR_PIN = 24
GPIO.setmode(GPIO.BCM)
GPIO.setup(SENSOR_PIN, GPIO.IN)

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
        type='RU'
    )

def callback(channel):
    if GPIO.input(channel):
        if sensor.status:
            alarm = Alarm.create(
                msg = f'{sensor.name} alarm! Sound detected!.',
                sensor= sensor,
                raspberry = raspi,
                date = now_int
            )
            time.sleep(60)
        else:
            print('Sound alarm is not activated!')
    #else:
        #print("LOW sound Detected!")

GPIO.add_event_detect(SENSOR_PIN, GPIO.BOTH, bouncetime=300)  # let us know when the pin goes HIGH or LOW
GPIO.add_event_callback(SENSOR_PIN, callback)  # assign function to GPIO PIN, Run function on change

# infinite loop
while True:
        time.sleep(1)

mysql_db.close()