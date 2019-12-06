import csv

data = ["data/District.csv","data/elk.csv","data/deer.csv","data/antelope.csv","data/moose.csv","data/sheep.csv","data/mtngoat.csv"]

lines = csv.reader(open(data[0], "r"))

datalist = list(lines)

district = []

for i in datalist:
    district.append(int(i[0]))

print(district)
input("")

sql = "INSERT INTO Harvest_estimate(Liscense_year,District,Animal,Num_hunters,Residency,Total_harvest,Days_hunted,Num_males,Num_females,Num_first_years) \nVALUES "
residency = ["N","R","SUM"]
animal = ["elk","deer","antelope","moose","sheep","mtngoat"]

for d in district:
    for a in animal:
        for r in residency:
            sql += "({},{},'{}',{},'{}',{},{},{},{},{}),\n".format(2019,d,a,0,r,0,0,0,0,0)

file = open("huntingDB.sql","a")
file.write(sql)
file.close()

    
