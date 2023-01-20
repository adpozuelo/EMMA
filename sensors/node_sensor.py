from peewee import *
from emma_model import *
from cpuinfo import get_cpu_info
from datetime import datetime
import psutil
import GPUtil
import time
import platform

mysql_db.connect()
tables = [Node, Node_Measure, Gpu, Gpu_Measure]
mysql_db.create_tables(tables, safe=True)

now = datetime.now()
now_int = int(now.strftime('%y%m%d%H%M'))
uptime = time.time() - psutil.boot_time()
days, rest = divmod(uptime, 86400)
hours, minutes = divmod(rest, 3600)
hostname = platform.node()
n_cpu = psutil.cpu_count(logical=False)
n_cpu_ht = psutil.cpu_count()
cpu_info = get_cpu_info()
memory = psutil.virtual_memory()
avx_support = [x for x in cpu_info['flags'] if 'avx' in x]
gpus = GPUtil.getGPUs()
n_gpu = len(gpus)
eth_name = list(psutil.net_if_addrs().keys())[1]

try:
    node = Node.get(Node.hostname == hostname)
except Node.DoesNotExist:
    node = Node.create(
        hostname=hostname,
        kernel=platform.uname().release,
        version=platform.uname().version,
        n_cpu=n_cpu,
        n_cpu_ht=n_cpu_ht,
        n_gpu=n_gpu,
        cpu_brand=cpu_info['brand_raw'],
        cpu_arch=cpu_info['arch'],
        cpu_cache=f"{cpu_info['l3_cache_size']/1048576:.2f} MiB",
        cpu_avx=', '.join(avx_support),
        ip_address=f"{psutil.net_if_addrs()[eth_name][0].address}",
        mem_total=f'{memory.total/1073741824:.2f} GiB'
    )

node_measure = Node_Measure.create(
    node=node,
    date=now_int,
    uptime=f'{days:.0f} days, {hours:.0f} hours, {minutes/60:.0f} minutes',
    load_1=psutil.getloadavg()[0] / n_cpu_ht * 100,
    load_5=psutil.getloadavg()[1] / n_cpu_ht * 100,
    load_15=psutil.getloadavg()[2] / n_cpu_ht * 100,
    mem_avail=memory.available/1073741824,
    mem_used=memory.used/1073741824,
    disk_usage_fs=psutil.disk_usage('/').percent,
    disk_usage_var=psutil.disk_usage('/var').percent,
    disk_usage_scratch=psutil.disk_usage('/scratch').percent
)

if n_gpu:
    for gpu_item in gpus:
        gpu_item_id = str(gpu_item.id)+'_'+node.hostname
        try:
            gpu = Gpu.get(Gpu.gpu_id == gpu_item_id)
        except Gpu.DoesNotExist:
            gpu = Gpu.create(
                gpu_id=gpu_item_id,
                node=node,
                gpu_name=gpu_item.name,
                driver=gpu_item.driver,
                mem_total=f'{gpu_item.memoryTotal/1024:.2f} GiB'
            )

        gpu_measure = Gpu_Measure.create(
            gpu=gpu,
            date=now_int,
            gpu_load=gpu_item.load*100,
            mem_avail=gpu_item.memoryFree/1024,
            mem_used=gpu_item.memoryUsed/1024
        )

mysql_db.close()
