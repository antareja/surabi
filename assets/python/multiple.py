import subprocess
import os
import sys
from time import sleep

path = os.getcwd()
#print(path)
y = (0.1)

if getattr(sys, 'frozen', False):
    # frozen
    dir = os.path.dirname(sys.executable)
else:
    # unfrozen
    dir = os.path.dirname(os.path.realpath(__file__))

#full_path = os.path.realpath(__file__)
dir_path = os.path.dirname(dir)
print(dir_path)
#sys.exit(0)
subprocess.Popen(["python", dir_path + r'/python/naked.py'])
sleep(y)
subprocess.Popen(["python", dir_path + r'/python/fleet_gps.py'])
sleep(y)
