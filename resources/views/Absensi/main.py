# %%
from __future__ import print_function
from time import sleep
from db import DB
from smartcard.CardMonitoring import CardMonitor, CardObserver
from smartcard.CardType import CardType
from smartcard.CardRequest import CardRequest
from smartcard.util import toHexString, COMMA, HEX, PACK, toASCIIString
import sys
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
            print("+Inserted: ", toHexString(card.atr))
        for card in removedcards:
            print("-Removed: ", toHexString(card.atr))


if __name__ == '__main__':
    host = "localhost"
    username = "root"
    password = ""
    database = "kp-labmm"

    newdb = DB(host, username, password, database)

    print("Insert or remove a smartcard in the system.")
    cardmonitor = CardMonitor()
    cardobserver = PrintObserver()
    while True:
        cardmonitor.addObserver(cardobserver)

        # don't forget to remove observer, or the
        # monitor will poll forever...
        sleep(10)
        cardmonitor.deleteObserver(cardobserver)
