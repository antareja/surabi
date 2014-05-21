#!/usr/bin/python3
import urllib.request
from serial import Serial,SerialException
import subprocess
from time import sleep
import sys


port = input("Masukan Com Port: ")
print ("you entered " + port)


try :
    ser = Serial('COM'+ port , 38400, timeout=1)
    print("connected to: " + ser.portstr)
except SerialException:
    print('Serial Com Port:' + port + ' tidak tersedia')
    pass
    sleep(2)
    sys.exit(0)

#print(respond.read())
        
        
while True:
    # Read a line and convert it from b'xxx\r\n' to xxx
    line = ser.readline().decode('utf-8', 'ignore')[:-2]
    #data = urllib.parse.urlencode(line)
    # binary_data    = data.encode('utf-8')
    # req        = urllib.request.Request("http://haidar.dev/test/post.php", line)
    # respond = urllib.request.urlopen(req)
    if line:  # If it isn't a blank line
        print(line)
        if line == '520':
            subprocess.call(["xte", "key Up"])
        elif line == '620':
            subprocess.call(["xte", "key Down"])
        elif line == '110':
            break

ser.close()