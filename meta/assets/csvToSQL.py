import csv

data = ["data/elk.csv","data/deer.csv","data/antelope.csv","data/moose.csv","data/sheep.csv","data/mtngoat.csv"]

lines = csv.reader(open(data[5], "r"))

datalist = list(lines)
datalist = datalist[1:]

sql = "\nINSERT INTO Harvest_estimate(Liscense_year,District,Animal,Num_hunters,Residency,Total_harvest,Days_hunted,Num_males,Num_females,Num_first_years) \nVALUES "

animal = "mtngoat"

for i in datalist:
    if i[1].isnumeric():
        sql += "({},{},'{}',{},'{}',{},{},{},{},{}),\n".format(i[0],i[1],animal,i[3],i[2],i[6],i[4],i[7],i[8],i[9])

file = open("huntingDB.sql","a")
file.write(sql)
file.close()


    
