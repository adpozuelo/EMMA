from peewee import *
from emma_model import *
from datetime import datetime, timedelta
import numpy as np
import subprocess

mysql_db.connect()
tables = [Sensor, Sensor_Measure]
mysql_db.create_tables(tables, safe=True)

now = datetime.now()
now_str = now.strftime('%d/%m/%y %H:%M')
now_int = int(now.strftime('%y%m%d%H%M'))
sub_times = [6, 12, 24]

report = '\U00002728 GROUP: Report {}\n'.format(now.strftime('%d/%m/%y %H:%M'))

for sensor in Sensor.select():
    if sensor.status and sensor.type=='TH':
        report += '\n\U000027a1 Sensor: {}\n'.format(sensor.name)
        for sub_time in sub_times:
            before = now - timedelta(hours=sub_time)
            before_int = int(before.strftime('%y%m%d%H%M'))
            temps_data = []
            hums_data = []
            for sensor_measure in Sensor_Measure.select().where(
                (Sensor_Measure.sensor == sensor.name) & 
                (Sensor_Measure.date > before_int) &
                (Sensor_Measure.date < now_int)):
                    temps_data.append(sensor_measure.temp)
                    hums_data.append(sensor_measure.hum)
            temps_data = np.array(temps_data, dtype=float)
            hums_data = np.array(hums_data, dtype=float)
            if len(temps_data) > 1 and len(hums_data) > 1:
                mu_t = np.mean(temps_data)
                mu_h = np.mean(hums_data)
                report += ('[{0}h]: μ(T)={1:0.2f}ºC, μ(H)={2:0.2f}%\n'
                            .format(sub_time, mu_t, mu_h))
            else:
                report += 'No data available\n'

mysql_db.close()

proc = subprocess.Popen(['/snap/bin/telegram-cli',
        '--log-level', '0',
        '--verbosity', '0',
        '--wait-dialog-list',
        '--disable-link-preview',
        '--disable-colors',
        '--disable-readline',
        '--exec', 'msg GROUP "{}"'.format(report.replace('\n', '\\n'))])
