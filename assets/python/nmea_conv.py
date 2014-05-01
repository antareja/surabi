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
    kmh = knots * 1.852
    return kmh

if __name__ == '__main__':
    # test1.py executed as script
    # do something
    #lat = -0.458245
    #lng = 11542.6468
    convLat(lat)
    convLng(lng)
    convLatLng(lat,lng)
    convKnots(knots)