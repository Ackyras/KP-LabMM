# %%
from __future__ import print_function
from time import sleep
from models.DB import DB
from smartcard.CardMonitoring import CardMonitor, CardObserver
from smartcard.CardType import CardType
from smartcard.CardRequest import CardRequest
from smartcard.util import toHexString, COMMA, HEX, PACK, toASCIIString
import sys
from models.Asprak import Asprak
import os
sys.path.append(".")

# %%
# a simple card observer that prints inserted/removed cards


class PrintObserver(CardObserver):
    """A simple card observer that is notified
    when cards are inserted/removed from the system and
    prints the list of cards
    """

    """Overrides from parent class"""

    def update(self, observable, actions):
        (addedcards, removedcards) = actions
        for card in addedcards:
            NIM = "118140160"
            check = DB.check_asprak(newdb, NIM)
            if check == False:
                print("Tidak ada data asprak dengan NIM "+NIM)
                print("Ulangi tempel kartu!")
            elif check == True:
                asprak = DB.get_asprak(newdb, NIM)
                # print("+Inserted: ", """DB.check_asprak(newdb, NIM)""")
                print("-Inserted: \n")
                print("Nama : "+asprak.nama)
                print("NIM  : "+asprak.nim)
                print(DB.asbence(self, asprak))
                # print("Silakan ulangi tap kartu!")

        for card in removedcards:
            os.system('cls')
            print("-Removed: ", toHexString(card.atr))
            print("\n\nSilakan tap kartu anda!")


if __name__ == '__main__':
    host = "localhost"
    username = "root"
    password = ""
    database = "kp-labmm"

    newdb = DB(host, username, password, database)

    print("Silakan tap kartu anda!")
    cardmonitor = CardMonitor()
    cardobserver = PrintObserver()
    while True:
        cardmonitor.addObserver(cardobserver)

        # don't forget to remove observer, or the
        # monitor will poll forever...
        sleep(10)
        cardmonitor.deleteObserver(cardobserver)
