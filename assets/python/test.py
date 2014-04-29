
import nmea_conv
import distance
import time


lng = 115.6971365273
lat = -0.57612263962088   

data = '1,2,3';
x , y,z  = data.split(',')
print(x)

d =distance.main(lat,lng)
time.sleep(0.5)
print(d['label'], d['distance'])