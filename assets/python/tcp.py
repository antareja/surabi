
# Echo client program
import socket
import urllib.request

HOST = '192.168.12.250'    # The remote host
PORT = 15000              # The same port as used by the server
username = 'haidar';
password = 'haitech';


s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((HOST, PORT))

while True:
 data = s.recv(1024)
 # format = data.encode('ascii')
 line = repr(data)
 values = {'username': username, 'password': password, 'btnSubmit':'Login'}
 data = urllib.parse.urlencode(values)
 binary_data = data.encode('utf-8')
 req  = urllib.request.Request("http://haidar.dev/test/post.php",binary_data)
 respond = urllib.request.urlopen(req)
 print(respond.read())
 if line:
    print(line)
s.close() 
