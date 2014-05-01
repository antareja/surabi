import nmea_conv
import label
import distance
import time
import re
import sys
from urllib.request import Request, urlopen
import urllib.parse


#url = "http://localhost:8000/?%s"
#params = urllib.parse.urlencode({'spam': 1, 'eggs': 2, 'bacon': 0})
#try:
#    urlopen(url % params)
#except error.URLError as e: print("URL Error:",e.read() , url)
#except error.HTTPError as e: print("HTTP Error:",e.read() , url)

#sys.exit(0)
lng = 115.719
lat = -0.493033   

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