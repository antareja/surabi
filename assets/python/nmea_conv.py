def printme( str ):
   ("This prints a passed string into this function")
   print (str)
   return
# Convert NMEA Lat
def convLat(lat):
    return (lat / 60)

def convLng(lng):
    firstLng = str(lng)[:3]
    secLng = str(lng)[3:]
    secSixty = float(secLng) / 60
    resultLng = float(firstLng) + float(secSixty) 
    return resultLng


print (convLat(-34.5673))
print (convLng(11542.6468))