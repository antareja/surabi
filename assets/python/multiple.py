import subprocess
import os
from time import sleep

path = os.getcwd()
#print(path)
y = (0.1)
subprocess.Popen(["python", 'naked.py'])
sleep(y)
subprocess.Popen(["python", 'fleet_gps.py'])
sleep (y)