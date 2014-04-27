import pymysql
from urllib.request import Request, urlopen
from urllib import parse,error
import nmea_conv

conn = pymysql.connect(host='127.0.0.1', user='root', passwd='root', db='gps_tracker')
cur = conn.cursor()
cur.execute("SELECT username, email FROM tcm_user")
print(cur.description)
for row in cur:
    username = row[0]
    print(str(username))
cur.close()
conn.close()
url = "http://surabi.dev/packet/test"
x = {'spam': 1, 'eggs': 2, 'bacon': 0}
x.update({'name': 'haidar'})
params = parse.urlencode(x)
try:
    f = urlopen(url, params.encode('utf-8'))
    print(f.read())
except error.URLError as e: print("URL Error:",e.reason , url)
except error.HTTPError as e: print("HTTP Error:",e.code , url)