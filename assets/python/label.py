import re

def main(label):
    if re.search('-', label):
        km = label.replace('-', 'KM')
        meter = km.replace("+", ".")
        print('found - here')
    elif re.search('STA', label):
        km = label.replace('STA', 'KM')
        meter = km.replace("+", ".")
        print('found STA here')
    else :
        meter = label    
        print('no found')
    
    return {'km': meter}

if __name__ == "__main__":
    main(label)