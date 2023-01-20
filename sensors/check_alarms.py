from peewee import *
from emma_model import *
from datetime import datetime
import os
import time

mysql_db.connect()
tables = [Raspberry, Node, Alarm]
mysql_db.create_tables(tables, safe=True)

now = datetime.now()
now_str = now.strftime('%d/%m/%y %H:%M')

for alarm in Alarm.select().where(Alarm.notified == 0):
    msg = f'\U0000203C {now_str} \U0000203C {alarm.msg}'
    command = '/snap/bin/telegram-cli -W -e "msg GROUP {}"'.format(msg)
    os.system(command)
    alarm.notified = 1
    alarm.save()
    time.sleep(5)

mysql_db.close()