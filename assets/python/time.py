from datetime import datetime, timedelta
from pytz import timezone
import pytz
utc = pytz.utc
print(utc.zone)
eastern = timezone('Asia/Makassar')
print(eastern.zone)