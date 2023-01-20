Environments Monitoring & Management Application
================================================

EMMA is a web application developed by Antonio Díaz Pozuelo (adpozuelo@gmail.com) whose objective is
to monitor and manage Technical Scientific Facilities (ICT).

Design and architecture
-----------------------

EMMA has been designed and implemented using two main components:

1. Sensors (Python): “scripts” tailor-made implemented, which are responsible of collecting the sensor
metrics and saving them in the database. These programs are installed on a Raspberry Pi, which has
the corresponding sensor connected, or on a computer or node to be monitored. Sensors are currently
implemented for DHT11/DHT22 (temperature and humidity), KY038 (sound), computer or
computing node (with and without GPU).
2. LAMP Server (Linux+Apache2+MariaDB+PHP):
	1. Web Application (CodeIgniter+Bootstrap+ChartJS): allows us to monitor and manage ICT
through a web interface that adapts to all browsers and electronic devices (responsive web).
	2. Database (MariaDB): which stores the metrics collected by the sensors and all the data necessary
for the proper functioning of the web application.
	3. Management of alerts and reports (Python+Telegram): "scripts" that send alerts to mobile phones
(via Telegram) in the event of sensor failures (device or sensor crash) and/or metrics (high
temperature or humidity, sound from an alarm, etc.). In addition, every certain interval, the
server sends a statistical report of the desired metrics to the mobile phones that belong to the
indicated Telegram group.

Installation
------------

Please, read README_ES.pdf (Spanish) or README_EN.pdf (English) documentation to install EMMA Application.

For any questions or suggestions, please send an email to adpozuelo@gmail.com.
