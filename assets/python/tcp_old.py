
# Echo client program
import socket
import urllib
import urllib2

HOST = '172.27.191.36'    # The remote host
PORT = 15000              # The same port as used by the server

url = 'http://surabi.dev/packet'



s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((HOST, PORT))

while True:
    data = s.recv(1024)
    # format = data.encode('ascii')
    line = repr(data)
    value = {"source" : source , "system" : system, 
             "mobile" : mobile, "base_ip" : base_ip, 
             "packet_number" : packet_number , 
             "base_modem_channel" : base_modem_channel}

    values2 = {"status" : status , 
               "offset" : offset , 
               "numeric" : numeric , 
               "jam" : jam , 
               "lat=" : lat , 
               "lng" : lng , 
               "velocity" : velocity , 
               "bearing" : bearing , 
               "tanggal" : tanggal , 
               "satelite" : satelite , 
               "hdop" : hdop}
    test = {'test': line}
    values = {'full_packet':line}
    data = urllib.urlencode(values)
    req = urllib2.Request(url, data)
    response = urllib2.urlopen(req)
    #print(response.read())
    if line:
        print(line)
s.close() 
