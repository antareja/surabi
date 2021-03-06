#!/usr/bin/python
import psycopg2
import sys
import time
import label
import config
 
def main(lat, lng):
    start_time = time.time()
    #Define our connection string
    options = config.main()
    conn_string = "host='" + options['host'] + "' dbname='" + options['db_name'] + "' user='" + options['db_user'] + "' password='" + options['db_pass'] + "'"
    # print the connection string we will use to connect
    print("Connecting to database") # % (conn_string)
 
    # get a connection, if a connect cannot be made an exception will be raised here
    conn = psycopg2.connect(conn_string)
 
    # conn.cursor will return a cursor object, you can use this cursor to perform queries
    cur = conn.cursor()
    lat = float(lat)
    lng = float(lng)
    print("Connected!\n")
    sql = ("SELECT label, CHAR_LENGTH(label),lng,lat, ST_Distance(geog_def, poi) AS distance_m"
                " FROM " + options['db_prefix'] + "road,"
                " (select ST_MakePoint(%(lng)f, %(lat)f)::geography as poi) as poi"
                " WHERE ST_DWithin(geog_def, poi, 100000)"
                " AND CHAR_LENGTH(label) >=6 "
                " AND label LIKE '%%+%%' "
                " ORDER BY ST_Distance(geog_def, poi)"
                " LIMIT 1;" % {'lat': lat, 'lng': lng})
    print(sql)
    cur.execute(sql)
    rows = cur.fetchall()
    print(time.time() - start_time, "seconds")
    if len(rows)==0:
        print("Cannot find closest Distance")
        return {'label': '0', 'distance' :'0'}
    else:    
        for row in rows:
            # convert label STA or - to KM
            km = label.main(row[0]);
            print("\nGet Closest Distance:", km['km'])
            return {'label': str(km['km']), 'distance' : round(row[4],2)}
 
if __name__ == "__main__":
    main(lat, lng)