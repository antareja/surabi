import sys
from Naked.toolshed.shell import execute_js

#def main():
success = execute_js('../nodejs/server.js')
print('connected nodejs' , sys.argv, ' arguments')
if success:
    print('success')
    # handle success of the JavaScript
else:
    print('cannot connected to nodejs')
    # handle failure of the JavaScript


#if __name__ == "__main__":
#    main()