import pymysql.cursors
from datetime import date
from models import Asprak


def check_absence(cursor, asprak):
    sql = "SELECT"


def check_asprak(cursor, NIM):
    sql = "SELECT * FROM `aspraks` WHERE `nim` = '"+NIM+"'"
    data = cursor.execute(sql)
    data = cursor.fetchone()
    if data == 0:
        print("Tidak ada asprak dengan NIM "+NIM)
    else:
        asprak = Asprak("{data[0]}", "{data[1]}", NIM)
        print("Nama : "+asprak.nama)
        print("NIM  : "+asprak.nim)
        var = ''
        while var != y or var != Y or var != n or var != N:
            var = input("Apakah data benar?(y/n)")
            if var == y or var == Y:
                check_absence(asprak, cursor)
            elif var == n or var == N:
                print("Silakan ulangi tap kartu!")
        return 0


NIM = "118114012"
host = "localhost"
username = "root"
password = ""
database = "kp-labmm"
conn = pymysql.connect(
    host=host,
    db=database,
    user=username,
    passwd=password,
)
cursor = conn.cursor()
check_asprak(cursor, NIM)
# t = time.localtime()
# now = time.strftime("%H:%M:%S", t)
# print(now)
# asprak = Asprak()
# sql_id = "SELECT `id` FROM `aspraks` WHERE `nim` = '"+NIM+"'"
# data_id = cursor.execute(sql_id)
# sql_nama = "SELECT `id` FROM `aspraks` WHERE `nim` = '"+NIM+"'"
# data_id = cursor.execute(sql_id)
# # cursor.fetchone()
# print(data_id)
