import re
import sys
import os

if len(sys.argv)<2:
	sys.exit("Usage: %s filename" % sys.argv[0])

filename=sys.argv[1]
if not os.path.exists(filename):
	sys.exit("Error: File '%s' not found" % sys.argv[1])



#open and read the file
f=open(filename,"r")
#data=f.read

#we prefix our regex string with an "r", for a "raw string". This is to prevent Python from trying to parse special characters in our regular expression.
#(?P<group_name>…) syntax allows one to refer to the matched string through its name
regex=re.compile('(?P<name>.*) batted (?P<bats>[0-9]*) times with (?P<hits>[0-9]*) hits and (?P<runs>[0-9]*) runs')

record={}


for line in f:
    result = regex.match(line)
    if result:
            name = result.group('name')
            bats = float(result.group('bats'))
            hits = float(result.group('hits'))
            runs = float(result.group('runs'))
            if name in record:
                    # add bats, hits, and runs to existing values in dict
                    record[name][1] += bats
                    record[name][2] += hits
                    record[name][3] += runs
            else:
                    record[name] = [name , bats , hits , runs]

f.close()

sortedResult = []

for player in record:
	avg= record[player][2] / record[player][1]
	sortedResult.append((player,avg))
	
sortedResult = sorted(sortedResult,key=lambda player: player[1],reverse=True)

for player in sortedResult:
    print(player[0], "%.3f" % player[1])






