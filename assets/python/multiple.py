import subprocess
from time import sleep

y = (0.1)
subprocess.Popen(["python", 'naked.py'])
sleep(y)
subprocess.Popen(["python", 'fleet_gps.py'])
sleep (y)