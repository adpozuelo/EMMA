from peewee import *

mysql_db = MySQLDatabase('yourdatabase', user='yourdatabaseuser', password='yourdatabasepassword',
                         host='yourdatabasehost', port=3306)


class Node(Model):
    hostname = CharField(primary_key=True)
    kernel = CharField()
    version = CharField()
    n_cpu = IntegerField()
    n_cpu_ht = IntegerField()
    n_gpu = IntegerField()
    cpu_brand = CharField()
    cpu_arch = CharField()
    cpu_cache = CharField()
    cpu_avx = CharField()
    ip_address = CharField()
    mem_total = CharField()
    online = IntegerField(default=1)
    error_count = IntegerField(default=0)

    class Meta:
        database = mysql_db


class Node_Measure(Model):
    node = ForeignKeyField(Node, on_delete='CASCADE', backref='measurements')
    date = BigIntegerField()
    uptime = CharField()
    load_1 = FloatField()
    load_5 = FloatField()
    load_15 = FloatField()
    mem_avail = FloatField()
    mem_used = FloatField()
    disk_usage_fs = FloatField()
    disk_usage_var = FloatField()
    disk_usage_scratch = FloatField()

    class Meta:
        database = mysql_db


class Gpu(Model):
    gpu_id = CharField(primary_key=True)
    node = ForeignKeyField(Node, on_delete='CASCADE', backref='gpus')
    gpu_name = CharField()
    driver = CharField()
    mem_total = CharField()
    online = IntegerField(default=1)
    error_count = IntegerField(default=0)

    class Meta:
        database = mysql_db


class Gpu_Measure(Model):
    gpu = ForeignKeyField(Gpu, on_delete='CASCADE', backref='measurements')
    date = BigIntegerField()
    gpu_load = FloatField()
    mem_avail = FloatField()
    mem_used = FloatField()

    class Meta:
        database = mysql_db


class Raspberry(Model):
    hostname = CharField(primary_key=True)
    ip_address = CharField()
    location = CharField(default=' ')
    online = IntegerField(default=1)
    error_count = IntegerField(default=0)

    class Meta:
        database = mysql_db


class Sensor(Model):
    name = CharField(primary_key=True)
    raspberry = ForeignKeyField(Raspberry, on_delete='CASCADE', backref='sensors')
    type = CharField()
    status = IntegerField(default=1)
    online = IntegerField(default=1)
    error_count = IntegerField(default=0)
    warning_temp = FloatField(default=30.0)
    critical_temp = FloatField(default=32.0)
    warning_hum = FloatField(default=80.0)
    critical_hum = FloatField(default=90.0)

    class Meta:
        database = mysql_db


class Sensor_Measure(Model):
    sensor = ForeignKeyField(Sensor, on_delete='CASCADE', backref='measurements')
    date = BigIntegerField()
    temp = FloatField()
    hum = FloatField()

    class Meta:
        database = mysql_db


class Alarm(Model):
    msg = CharField()
    node = ForeignKeyField(Node, on_delete='CASCADE', backref='alarms', null=True)
    sensor = ForeignKeyField(Sensor, on_delete='CASCADE', backref='alarms', null=True)
    raspberry = ForeignKeyField(Raspberry,on_delete='CASCADE', backref='alarms', null=True)
    date = BigIntegerField()
    notified = IntegerField(default=0)

    class Meta:
        database = mysql_db
