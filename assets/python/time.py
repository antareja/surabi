from datetime import datetime, timedelta
from pytz import timezone
import pytz
utc = pytz.utc
utc = timezone('Etc/Greenwich')
eastern = timezone('US/Eastern')
print(utc.zone)
makassar = timezone('Asia/Makassar')
print(makassar.zone)
fmt = '%Y-%m-%d %H:%M:%S %Z%z'
dfmt = '%Y-%m-%d'
tfmt = '%H:%M:%S%z'
#print('skrg'+ str(datetime.utcnow()))
loc_dt = makassar.localize(datetime.now())
utc_dt = datetime.now()
#print(utc.localize(datetime.now()))
#datetime.datetime(year, month, day, hour=0, minute=0, second=0, microsecond=0, tzinfo=None)
input_dt = utc.localize(datetime(2014, 5, 5, 3, 00, 29))
utc_dt = input_dt.astimezone(utc)
yearf = str(20)
year2 = str(14)
year = yearf+year2
print(year)
print(utc_dt.strftime(fmt))
kal_dt  = input_dt.astimezone(makassar)
print(kal_dt.strftime(fmt))
print(kal_dt.strftime(dfmt))
print(kal_dt.strftime(tfmt))
print(input_dt.strftime(dfmt))
print(input_dt.strftime(tfmt))

# convert UTC time to makassar time