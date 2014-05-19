import sys,os
from Naked.toolshed.shell import execute_js


#def main():
SITE_ROOT = os.path.dirname(os.path.realpath(__file__))
PARENT_ROOT=os.path.abspath(os.path.join(SITE_ROOT, os.pardir))
success = execute_js(PARENT_ROOT + '/nodejs/server.js')
print('connected nodejs' , sys.argv, ' arguments')
if success:
    print('success')
    # handle success of the JavaScript
else:
    print('cannot connected to nodejs')
    # handle failure of the JavaScript


#if __name__ == "__main__":
#    main()