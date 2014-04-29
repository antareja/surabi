
# Echo client program
import socket
import pymysql
from urllib.request import Request, urlopen
from urllib import parse,error
import nmea_conv
import time
import distance

HOST = 'localhost'  # The remote host
PORT = 15000  # The same port as used by the server
url_parse = 'http://tcmgps.com/packet'  # Parse Packet Data to php and insert to database


# Get Data from SQL 

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((HOST, PORT))
s.send(b'Hello, world')
while True:
 listen = s.recv(1024)
 line = repr(listen.decode('utf-8', 'ignore'))
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
        value = {"full_packet" : line , "source" : source , "system" : system, "mobile" : mobile, "base_ip" : base_ip, "packet_number" : packet_number , "base_modem_channel" : base_modem_channel}
        # input change
        if packet_number == '072' :
            print("072 Packet Number")
            input = line[55]
            state = line[56]
            url = url + "&input=" + input + "&state=" + state
            value.update({"input" : input , "state=" : state})
            parse_data = parse.urlencode(value)
            try:
                urlopen(url_parse, parse_data.encode('utf-8'))
                urlopen(url)
            except error.URLError as e: print("URL Error:",e.reason , url)
            except error.HTTPError as e: print("HTTP Error:",e.code , url)
        # gps status with position    
        elif packet_number == '104' :
            print("104 Packet Number")
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
            print(jam)
            
            d = distance.main(lat,lng)
            url = url + "&status=" + status + "&offset=" + offset + "&numeric=" + numeric + "&jam=" + jam + "&lat=" + nmea_conv.convLat(lat) + "&lng=" + nmea_conv.convLng(lng) + "&velocity=" + velocity + "&bearing=" + bearing + "&tanggal=" + tanggal + "&satelite=" + satelite + "&hdop=" + hdop + "&location" + d['label'] + "&distance" + d['distance']
            value.update({"status" : status , "offset" : offset , "numeric" : numeric , "jam" : jam , "lat" : nmea_conv.convLat(lat) , "lng" : nmea_conv.convLng(lng) , "velocity" : velocity , "bearing" : bearing , "tanggal" : tanggal , "satelite" : satelite , "hdop" : hdop, "location" : d['label'], "distance" : d['distance']})
            parse_data = parse.urlencode(value)
            try:
                urlopen(url_parse, parse_data.encode('utf-8'))
                urlopen(url)
            except error.URLError as e: print("URL Error:",e.reason , url)
            except error.HTTPError as e: print("HTTP Error:",e.code , url)
        # gps status with position
        elif packet_number == '100' :
            print("100 Packet Number")
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
            print(jam)
            tanggal = tanggal[0:2] + "-" + tanggal[2:4] +"-"+ tanggal[4:6]
            d = distance.main(lat,lng)
            url = url + "&status=" + status + "&offset=" + offset + "&numeric=" + numeric + "&jam=" + jam + "&lat=" + nmea_conv.convLat(lat) + "&lng=" + nmea_conv.convLng(lng) + "&velocity=" + velocity + "&bearing=" + bearing + "&tanggal=" + tanggal + "&satelite=" + satelite + "&hdop=" + hdop + "&location" + d['label'] + "&distance" + d['distance']
            value.update({"status" : status , "offset" : offset , "numeric" : numeric , "jam" : jam , "lat" : nmea_conv.convLat(lat) , "lng" : nmea_conv.convLng(lng) , "velocity" : velocity , "bearing" : bearing , "tanggal" : tanggal , "satelite" : satelite , "hdop" : hdop, "location" : d['label'], "distance" : d['distance']})
            parse_data = parse.urlencode(value)
            try:
                urlopen(url_parse, parse_data.encode('utf-8'))
                urlopen(url)
            except error.URLError as e: print("URL Error:",e.reason , url)
            # print(response.read())
        elif packet_number == '103' :
            print("103 Packet Number")
                
     # print(source+system+mobile+base_ip+packet_number+base_modem_channel+status+offset+numeric)
s.close()
