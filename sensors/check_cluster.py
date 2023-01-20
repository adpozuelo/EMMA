from peewee import *
from emma_model import *
from datetime import datetime
import os
import time

mysql_db.connect()
tables = [Raspberry, Node, Alarm]
mysql_db.create_tables(tables, safe=True)

now = datetime.now()
now_int = int(now.strftime('%y%m%d%H%M'))

for node in Node.select():
    for ping in range(3):
        test = True if os.system(
            "ping -c 1 " + node.ip_address + ">/dev/null") == 0 else False
        if test:
            break
        time.sleep(1)
    if test and node.online and node.error_count > 0:
        node.error_count = 0
        node.save()
    if test and not node.online:
        node.error_count -= 1
        if node.error_count == 0:
            alarm = Alarm.create(
                msg=f'{node.hostname} alarm! Connection error solved, node is online.',
                node=node,
                date=now_int
            )
            node.online = 1
        node.save()
    if not test and node.online:
        node.error_count += 1
        if node.error_count == 3:
            alarm = Alarm.create(
                msg=f'{node.hostname} alarm! Several connections error, node is offline.',
                node=node,
                date=now_int
            )
            node.online = 0
        node.save()

for raspi in Raspberry.select():
    for ping in range(3):
        test = True if os.system(
            "ping -c 1 " + raspi.ip_address + ">/dev/null") == 0 else False
        if test:
            break
        time.sleep(1)
    if test and raspi.online and raspi.error_count > 0:
        raspi.error_count = 0
        raspi.save()
    if test and not raspi.online:
        raspi.error_count -= 1
        if raspi.error_count == 0:
            alarm = Alarm.create(
                msg=f'{raspi.hostname} alarm! Connection error solved, raspberry is online.',
                raspberry=raspi,
                date=now_int
            )
            raspi.online = 1
        raspi.save()
    if not test and raspi.online:
        raspi.error_count += 1
        if raspi.error_count == 3:
            alarm = Alarm.create(
                msg=f'{raspi.hostname} alarm! Several connections error, raspberry is offline.',
                raspberry=raspi,
                date=now_int
            )
            raspi.online = 0
        raspi.save()

mysql_db.close()
