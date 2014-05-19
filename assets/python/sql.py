import pymysql
from urllib.request import Request, urlopen
from urllib import parse,error
import nmea_conv
import distance

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


lat = "-0.5719233333333332" 
#lat = 4.5673
lng = "115.69542833333334"
#lng = 542.6468
test = "sdf %(lat)s , get %(lng)s" % {'lat':lat, 'lng':lng }
print(test)
#print(nmea_conv.convLatLng("-3%(lat)f" % {'lat': lat} , "11%(lng)f" % {'lng': lng}))

print (nmea_conv.convLatLng(-34.5673, 11542.6468))
x =distance.main(lat,lng)
print(x['label'])