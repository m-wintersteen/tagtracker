import random

first_names=("Katie", "Megan", "Hannah", "John","Andy","Joe","Joshua" ,"Christopher" ,"Andrew" ,"Theodore" ,"Caleb" ,"Ryan" ,"Asher" ,"Nathan" ,"Thomas" ,"Leo")
last_names=('Johnson','Smith','Williams', "Luther", "Wintersteen", "Dixon", "Couser", "Palmer", "Critchlow", "Kanewala")
mid_init=('Q','N','M','J','L','P','A','B','R','F','D','V','C')
RN=('R','N')
districts=(100,101,102,103,104,109,110,120,121,122,123,124,130,132,140,141,150,151,170,200,201,202,203,204,210,211,212,213,214,215,216,217,240,250,260,261,262,270,280,281,282,283,284,285,290,291,292,293,298,300,301,302,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,339,340,341,343,350,360,361,362,370,380,388,390,391,392,393,400,401,403,404,405,406,410,411,412,413,415,416,417,418,419,420,421,422,423,424,425,426,432,441,442,444,445,446,447,448,449,450,451,452,454,455,471,500,502,510,511,520,530,540,560,570,575,580,590,600,611,620,621,622,630,631,632,640,641,650,651,652,670,680,690,700,701,702,703,704,705)
animal=("deer", "elk")
sex=("M","F")
Bow_rifle=("Bow","Rifle")


sql1 = "\nINSERT INTO Hunter (Hunter_id,h_password, Fname,Minit, Lname, Resident)\nVALUES"
sql2 = "\nINSERT INTO Tags (Tag_id, Hunter_id,District_id, Animal, Sex, Bow_rifle, Liscense_year)\nVALUES"

n=111113
m=1009

for i in range(100):
  n+=1
  sql1 += "({},'{}','{}','{}','{}','{}'),\n".format(n,"password", random.choice(first_names), random.choice(mid_init), random.choice(last_names), random.choice(RN))
  for j in range(random.randint(0, 3)):
    m+=1
    sql2 += "({},{},{},'{}','{}','{}',{}),\n".format(m, n, random.choice(districts), random.choice(animal), random.choice(sex), random.choice(Bow_rifle), 2019)
   
sql1+="(111214,'password','John','Q','Williams','R');"
sql2+="(2000,111212,350,'deer','F','Rifle',2019);"

print(sql1)
print(sql2)

file = open("huntingDB.sql","a")
file.write(sql1)
file.write(sql2)
file.close()
