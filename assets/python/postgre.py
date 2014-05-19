#!/usr/bin/python
import psycopg2
import sys
import config
 
def main():
    #Define our connection string
    options = config.main()
    conn_string = "host='" + options['host'] + "' dbname='" + options['db_name'] + "' user='" + options['db_user'] + "' password='" + options['db_pass'] + "'" 
    # print the connection string we will use to connect
    print("Connecting to database\n    ->%s") # % (conn_string)
 
    # get a connection, if a connect cannot be made an exception will be raised here
    conn = psycopg2.connect(conn_string)
 
    # conn.cursor will return a cursor object, you can use this cursor to perform queries
    cur = conn.cursor()
    print("Connected!\n")
    
    cur.execute("SELECT username from tcm_user")
    rows = cur.fetchall()
    print("\nShow me the databases:\n")
    for row in rows:
        print (row[0])
 
if __name__ == "__main__":
    main()