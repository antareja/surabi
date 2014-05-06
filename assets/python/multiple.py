import subprocess
import os
from time import sleep

path = os.getcwd()
#print(path)
y = (0.1)
subprocess.Popen(["python", path + r'\naked.py'])
sleep(y)
subprocess.Popen(["python", path + r'\fleet_gps.py'])
sleep (y)