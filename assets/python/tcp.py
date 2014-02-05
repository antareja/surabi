
# Echo client program
import socket
import urllib
import urllib2

HOST = '192.168.12.250'    # The remote host
PORT = 15000              # The same port as used by the server

url = 'http://surabi.dev/packet'

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((HOST, PORT))

while True:
    data = s.recv(1024)
    # format = data.encode('ascii')
    line = repr(data)
    values = {'full_packet':line}
    data = urllib.urlencode(values)
    req = urllib2.Request(url, data)
    response = urllib2.urlopen(req)
    print(response.read())
    if line:
        print(line)
s.close() 
