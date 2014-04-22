
# Echo client program
import socket
import urllib
import urllib2

HOST = 'localhost'  # The remote host
PORT = 15000  # The same port as used by the server
url_parse = 'http://surabi.dev/packet'  # Parse Packet Data to php and insert to database

# Convert NMEA to regular Latitude Longitude

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((HOST, PORT))
s.send('Hello, world')
while True:
 listen = s.recv(1024)
 line = repr(listen)
 if line:
    line = line.replace("'", "")
    if len(line) < 120 :
        print(line)
        source = line[4]
        system = line[5:7]
        mobile = line[6:32]
        base_ip = line[32:47]
        packet_number = line[47:50]
        base_modem_channel = line[50:51]
        url = "http://localhost:8000/?source=" + source + "&system=" + system + "&mobile=" + mobile + "&base_ip=" + base_ip + "&packet_number=" + packet_number + "&base_modem_channel=" + base_modem_channel;
        value = {"source" : source , "system" : system, "mobile" : mobile, "base_ip" : base_ip, "packet_number" : packet_number , "base_modem_channel" : base_modem_channel}
        # input change
        if packet_number == '072' :
            print '072 Packet Number'
            input = line[55]
            state = line[56]
            url = url + "&input=" + input + "&state=" + state
            value2 = {"input" : input , "state=" : state}
            values = dict(value.items() + value2.items())
            parse_data = urllib.urlencode(values)
            req = urllib2.Request(url_parse, parse_data)
            urllib2.urlopen(req)
            urllib2.urlopen(url)
        # gps status with position    
        elif packet_number == '104' :
            print '104 Packet Number'
            status = line[55:58]
            offset = line[58:63]
            numeric = line[63:72]
            data = line[line.find('x7f') + 3:len(line) - 4]
            jam, lat, lng, velocity, bearing, tanggal, satelite, hdop = data.split(',')
            if len(jam) < 6 :
                jam = '0' + jam
            if len(tanggal) < 6 :
                tanggal = '0' + tanggal
            jam = jam[0:2] + ":" + jam[2:4] + ":" + jam[4:6]
            tanggal = tanggal[0:2] + "-" + tanggal[2:4] + "-" + tanggal[4:6]
            print jam
            url = url + "&status=" + status + "&offset=" + offset + "&numeric=" + numeric + "&jam=" + jam + "&lat=" + lat + "&lng=" + lng + "&velocity=" + velocity + "&bearing=" + bearing + "&tanggal=" + tanggal + "&satelite=" + satelite + "&hdop=" + hdop
            value2 = {"status" : status , "offset" : offset , "numeric" : numeric , "jam" : jam , "lat" : lat , "lng" : lng , "velocity" : velocity , "bearing" : bearing , "tanggal" : tanggal , "satelite" : satelite , "hdop" : hdop}
            values = dict(value.items() + value2.items())
            parse_data = urllib.urlencode(values)
            req = urllib2.Request(url_parse, parse_data)
            try:
                urllib2.urlopen(req)
            except urllib2.HTTPError, err:
                if err.code == 404:
                    print 'error'
                else:
                    raise    
            urllib2.urlopen(url)
        # gps status with position
        elif packet_number == '100' :
            print '100 Packet Number'
            status = line[55:58]
            offset = line[58:63]
            numeric = line[63:72]
            data = line[line.find('x03') + 3:len(line) - 4]
            jam, lat, lng, velocity, bearing, tanggal, satelite, hdop = data.split(',')
            if len(jam) < 6 :
                jam = '0' + jam
            if len(tanggal) < 6 :
                tanggal = '0' + tanggal
            jam = jam[0:2] + ":" + jam[2:4] + ":" + jam[4:6]
            print jam
            tanggal = tanggal[0:2] + "-" + tanggal[2:4] +"-"+ tanggal[4:6]
            url = url + "&status=" + status + "&offset=" + offset + "&numeric=" + numeric + "&jam=" + jam + "&lat=" + lat + "&lng=" + lng + "&velocity=" + velocity + "&bearing=" + bearing + "&tanggal=" + tanggal + "&satelite=" + satelite + "&hdop=" + hdop
            value2 = {"status" : status , "offset" : offset , "numeric" : numeric , "jam" : jam , "lat" : lat , "lng" : lng , "velocity" : velocity , "bearing" : bearing , "tanggal" : tanggal , "satelite" : satelite , "hdop" : hdop}
            values = dict(value.items() + value2.items())
            parse_data = urllib.urlencode(values)
            req = urllib2.Request(url_parse, parse_data)
            try:
                urllib2.urlopen(req)
            except urllib2.HTTPError, err:
                if err.code == 404:
                    print 'error'
                else:
                    raise
            # print(response.read())
            urllib2.urlopen(url)
        elif packet_number == '103' :
            print '103 Packet Number'
                
     # print(source+system+mobile+base_ip+packet_number+base_modem_channel+status+offset+numeric)
s.close()
