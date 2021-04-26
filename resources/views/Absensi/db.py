#%%
# import
import pymysql.cursors

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

    def get_by_nim(self, NIM):
        sql="SELECT * FROM `aspraks` WHERE `nim` LIKE '118114012'"
        self.cursor.execute(sql)
        data=self.cursor.fetchfirst()
        return data

# %%
