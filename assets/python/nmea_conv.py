from datetime import datetime, timedelta
from pytz import timezone
import pytz
import config

# Convert NMEA Lat
# Convert NMEA to regular Latitude Longitude
def convLat(lat):
    return str((float(lat) / 60))

def convLng(lng):
    firstLng = str(lng)[:3]
    secLng = str(lng)[3:]
    secSixty = float(secLng) / 60
    resultLng = float(firstLng) + float(secSixty) 
    return str(resultLng)

def convLatLng(lat,lng):
    resultLat = (float(lat) / 60)
    firstLng = str(lng)[:3]
    secLng = str(lng)[3:]
    secSixty = float(secLng) / 60
    resultLng = float(firstLng) + float(secSixty) 
    resultLatLng = str(resultLat) + ", " + str(resultLng)
    return str(resultLatLng)

# Convert Knots to KMH
def convKnots(knots):
    kmh = float(knots) * 1.852
    return kmh

def convUtcTime(date, time):
    options = config.main()
    utc = pytz.utc
    utc = timezone('Etc/Greenwich')
    tzname = timezone(options['tzname'])
    fmt = '%Y-%m-%d %H:%M:%S %Z%z'
    dfmt = '%Y-%m-%d'
    tfmt = '%H:%M:%S%z'
    yearTwo = str(20)
    yearLastTwo = date[4:6]
    year = yearTwo+yearLastTwo
    month = date[2:4]
    day = date[0:2]
    hour = time[0:2]
    minute = time[2:4]
    second = time[4:6]
    #datetime.datetime(year, month, day, hour=0, minute=0, second=0, microsecond=0, tzinfo=None)
    input_dt = utc.localize(datetime(int(year), int(month), int(day), int(hour), int(minute), int(second)))
    kal_dt = input_dt.astimezone(tzname)
    print(kal_dt.strftime(fmt))
    #print(date, time)
    return {'date' : kal_dt.strftime(dfmt) ,'time' : kal_dt.strftime(tfmt), 
            'date_utc' : input_dt.strftime(dfmt), 'time_utc' : input_dt.strftime(tfmt)}

if __name__ == '__main__':
    # test1.py executed as script
    # do something
    #lat = -0.458245
    #lng = 11542.6468
    convLat(lat)
    convLng(lng)
    convLatLng(lat,lng)
    convKnots(knots)