import re

def main():

	with open('Fall2018.txt', 'r') as InputFile:
		mainlist = []
		templist= ["", "", ""]

		for line in InputFile:
			Data = line.strip().replace("\"", "").replace("\\n","").split(":",1)		#gets rid of newlines and \, splits string into two variables 0, 1

			if Data[0] == "title":														#checks for title and saves it into list[0]	
				tempVar = Data[1][1:-1]													#removes comma
				templist[1] = tempVar
				#print("title: "+Data[1])
					
			if Data[0] == "start":														#checks for start and saves it as list[2]
				tempVar = Data[1].split("T",1)											#formatting
				templist[0] = tempVar[0][1:]
				#print("date: "+Data[1]+"\n")
				mainlist.extend(templist)												#adds each list to the mainlist 
				
		#listPrint(mainlist)
		fileWrite(mainlist)

def listPrint(mainlist):

	for item in mainlist:
        		print(item)
        		print("\n")

def fileWrite(mainlist):

	with open('Fall2018data.txt', 'w') as outputFile:
		for item in mainlist:
        		outputFile.write(item)
        		outputFile.write("\n")
        		
main()