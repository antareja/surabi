def printme( str ):
   ("This prints a passed string into this function")
   print (str)
   return
# Convert NMEA Lat
def convLat(lat):
    return str((float(lat) / 60))

def convLng(lng):
    firstLng = str(lng)[:3]
    secLng = str(lng)[3:]
    secSixty = float(secLng) / 60
    resultLng = float(firstLng) + float(secSixty) 
    return resultLng

def convLatLng(lat,lng):
    resultLat = (lat / 60)
    firstLng = str(lng)[:3]
    secLng = str(lng)[3:]
    secSixty = float(secLng) / 60
    resultLng = float(firstLng) + float(secSixty) 
    resultLatLng = str(resultLat) + ", " + str(resultLng)
    return str(resultLatLng)


print (convLat(-0.458245))
print (convLng(11542.6468))
print (convLatLng(-34.5673, 11542.6468))