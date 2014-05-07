import nmea_conv
import label
import config
import distance
import time
import re
from urllib.request import Request, urlopen
import urllib.parse
import sys,os
#if "C:\\nginx\\html\\surabi\\assets\\python\\" not in sys.path:
#    sys.path.append("C:\\nginx\\html\\surabi\\assets\\python\\")
#url = "http://localhost:8000/?%s"
#params = urllib.parse.urlencode({'spam': 1, 'eggs': 2, 'bacon': 0})
#try:
#    urlopen(url % params)
#except error.URLError as e: print("URL Error:",e.read() , url)
#except error.HTTPError as e: print("HTTP Error:",e.read() , url)

#sys.exit(0)

SITE_ROOT = os.path.dirname(os.path.realpath(__file__))
print("example 1: "+SITE_ROOT)
PARENT_ROOT=os.path.abspath(os.path.join(SITE_ROOT, os.pardir))
print("example 2: "+PARENT_ROOT)
GRANDPAPA_ROOT=os.path.abspath(os.path.join(PARENT_ROOT, os.pardir))
print("example 3: "+GRANDPAPA_ROOT)
#print("This file directory only")
#full_path = os.path.realpath(__file__)
#dir_path = os.path.dirname(full_path)
#sys.path.append(dir_path)
#print(os.path.dirname(full_path))
#sys.exit(0)
option = config.main()
print(option['db_name'])
print("round(80.33956, 2) : ", round(-0.57986588888, 6))
lng = 115.719
lat = -0.493033   
knots = 30.2
kmh = nmea_conv.convKnots(knots)
print(kmh)
#sys.exit(0)
data = '1,2,3';
x , y,z  = data.split(',')
print(x)

km = label.main('STA 29+000')
print(km['km'])
d =distance.main(lat,lng)
time.sleep(0.5)
val = {"lat": lat, "distance" : d['distance'], "lng" : lng}
re.sub(r'\W+', '', d['label'])
print('get label is=',d['label'])
sys.exit(0)
print("type", type(d['label']), type(d['distance']))
print(str(d['label']), d['distance'], val['distance'])