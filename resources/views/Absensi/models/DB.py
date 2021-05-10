# %%
# import
import pymysql.cursors
from datetime import date
from models.Asprak import Asprak

# %%


class DB:
    def __init__(self, DB_HOST, DB_USER, DB_PASS, DB_NAME):
        self.host = DB_HOST
        self.name = DB_NAME
        self.user = DB_USER
        self.password = DB_PASS
        self.cursor = None
        self.conn = None
        self.conn = pymysql.connect(
            host=self.host,
            db=self.name,
            user=self.user,
            passwd=self.password,
        )
        self.cursor = self.conn.cursor()

# %%

    def absence(NIM, data):
        sql = "INSERT INTO `absensi` (`asprak_id`) VALUES (`"+data.id+"`)"
        return "success"

    def check_absence(self, ids):
        t = time.localtime()

        sql = "SELECT `id` FROM `aspraks` WHERE `id` = `" + \
            ids+"` AND `tgl_absen` = `"+datenow+"`"
        data = self.cursor.fetchfirst(sql)
        if data == null:
            absence(NIM, data)

    def get_asprak(self, NIM):
        sql = "SELECT * FROM `aspraks` WHERE `nim` = '"+NIM+"'"
        self.cursor.execute(sql)
        data = self.cursor.fetchone()
        asprak = Asprak(data[0], data[1], NIM)
        return asprak

    def check_asprak(self, NIM):
        sql = "SELECT * FROM `aspraks` WHERE `nim` = '"+NIM+"'"
        data = self.cursor.execute(sql)
        if data == 0:
            return False
        else:
            return True
