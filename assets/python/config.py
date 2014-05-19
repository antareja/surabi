import configparser
import os,sys

def main():
    options  = {}
    config = configparser.ConfigParser()
    config.sections()
    SITE_ROOT = os.path.dirname(os.path.realpath(__file__))
    PARENT_ROOT=os.path.abspath(os.path.join(SITE_ROOT, os.pardir))
    GRANDPAPA_ROOT=os.path.abspath(os.path.join(PARENT_ROOT, os.pardir))
    config.read(GRANDPAPA_ROOT +'/config.ini')
    config.sections()
    options['host'] = config['config']['host'].strip('"')
    options['base_url'] = config['config']['base_url'].strip('"')
    options['base_url_new'] = config['config']['base_url_new'].strip('"')
    options['nodejs_url'] = config['config']['nodejs_url'].strip('"')
    options['db'] = config['database']['db'].strip('"')
    options['db_name'] = config['database']['db_name'].strip('"')
    options['db_prefix'] = config['database']['db_prefix'].strip('"')
    options['db_user'] = config['database']['db_user'].strip('"')
    options['db_pass'] = config['database']['db_pass'].strip('"')
    options['tzname'] = config['config']['tzname'].strip('"')
    return options
      
if __name__ == "__main__":
    main()