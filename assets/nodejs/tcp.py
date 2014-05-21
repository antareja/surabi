
# Echo client program
import socket
import urllib2
import time
import datetime

HOST = '192.168.12.250'    # The remote host
PORT = 15000              # The same port as used by the server
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((HOST, PORT))
s.send('Hello, world')
isi=""
s.setblocking(0)
def get_data():
 timeout = time.time() + 10   # 5 minutes from now
 while True:
        if time.time() > timeout:
            break
        else :
            try :
                listen = s.recv(1024)
                line = repr(listen)
                if line:
                    line=line.replace("'","")				
                    if len(line) < 120 :
                        print(line)
                        print(datetime.datetime.now())
                        source=line[4]
                        system=line[5:7]
                        mobile=line[6:32]
                        base_ip=line[32:47]
                        packet_number=line[47:50]
                        base_modem_channel=line[50:51]
                        url="http://localhost:8000/?source="+source+"&system="+system+"&mobile="+mobile+"&base_ip="+base_ip+"&packet_number="+packet_number+"&base_modem_channel="+base_modem_channel;
                        if packet_number == '072' :
                            input=line[55]
                            output=line[56]
                            url=url+"&input="+input+"&output="+output
                            urllib2.urlopen(url)
                        elif packet_number == '104' :
                            status=line[55:58]
                            offset=line[58:63]
                            numeric=line[63:72]
                            data=line[line.find('x7f')+3:len(line)-4]
                            jam,lat,lng,velocity,bearing,tanggal,satelite,hdop=data.split(',')
                            if len(jam)<6 :
                                jam='0'+jam
                            if len(tanggal)<6 :
                                tanggal='0'+tanggal
                            jam=jam[0:2]+":"+jam[2:4]+":"+jam[4:6]
                            tanggal=tanggal[0:2]+"-"+tanggal[2:4]+"-"+tanggal[4:6]
                            url=url+"&status="+status+"&offset="+offset+"&numeric="+numeric+"&jam="+jam+"&lat="+lat+"&lng="+lng+"&velocity="+velocity+"&bearing="+bearing+"&tanggal="+tanggal+"&satelite="+satelite+"&hdop="+hdop
                            urllib2.urlopen(url)
                        elif packet_number == '100' :
                            status=line[55:58]
                            offset=line[58:63]
                            numeric=line[63:72]
                            data=line[line.find('x03')+3:len(line)-4]
                            jam,lat,lng,velocity,bearing,tanggal,satelite,hdop=data.split(',')
                            if len(jam)<6 :
                                jam='0'+jam
                            if len(tanggal)<6 :
                                tanggal='0'+tanggal
                            jam=jam[0:2]+":"+jam[2:4]+":"+jam[4:6]
                            tanggal=tanggal[0:2]+"-"+tanggal[2:4]+tanggal[4:6]
                            url=url+"&status="+status+"&offset="+offset+"&numeric="+numeric+"&jam="+jam+"&lat="+lat+"&lng="+lng+"&velocity="+velocity+"&bearing="+bearing+"&tanggal="+tanggal+"&satelite="+satelite+"&hdop="+hdop
                            urllib2.urlopen(url)
                break
            except socket.error :
                isi=""
 get_data()
get_data()
s.close()