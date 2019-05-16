from collections import defaultdict
from datetime import datetime
import json


def parse_dates(infile):
    # Open file and read in the lines
    with open(infile, 'r') as f:
        lines = f.readlines()

    # Strip whitespace
    lines = [line.strip() for line in lines]

    # Look up defaultdict if you care, very useful data structure
    events_ = defaultdict(str)
    ldate = None
    for line in lines:
        if line is not '':
            try:
                # If it's a date, then ldate eq to it
                # Anything that comes after the date is associated w/ it
                ldate = datetime.strptime(line, "%Y-%m-%d").strftime("%Y-%m-%d")
            except:
                # Key=ldate: Value=line (or lines)
                # the '\n'.join method will concat the strings with a newline
                events_[ldate] = '\n'.join([events_[ldate], line]) if events_[ldate] is not '' else line

    return events_


def output_json(outfile, events_):
    # Write it to file
    with open(outfile, 'w') as f:
        f.write(json.dumps(events_))


"""
Here is some python example code just to show the basic concept of populating the calendar


# Create calendar object
calendar = Calendar()

# Open the resource file (could prob be put in resources/ folder on website)
with open('dates.json', 'r') as infile:
    events = json.loads(infile)

# I honestly don't know how the calendar works, I'll look at it later
# I assume it's something along these lines though

for date, details in calendar.items():
    # Parse the calendar date you're looking at so it matches the format in the file
    curr_date = datetime.strftime(date, '%Y-%m-%d')
    try:
        # Use curr_date as key to get events for that day
        details = events[curr_date]
    except KeyError:
        # If that date is not in the dict, then set it to an empty string
        details = ""

return calendar

"""

if __name__ == '__main__':
    infile = 'Fall2018data.txt'
    outfile = 'Fall2018data.json'
    print(f"Parsing {infile}")
    events = parse_dates(infile)
    print(f"Writing {outfile}")
    output_json(outfile, events)
    print("Script Complete, press any key to exit")
    input()