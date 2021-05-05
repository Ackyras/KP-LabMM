from smartcard.CardType import ATRCardType
from smartcard.CardRequest import CardRequest
from smartcard.util import toHexString, toBytes

# cardtype = ATRCardType(toBytes("3B 8F 80 01 80 4F 0C A0 00 00 03 06 03 00 01 00 00 00 00 6A"))
cardrequest = CardRequest(timeout=1)
cardservice = cardrequest.waitforcard()

cardservice.connection.connect()

SELECT = [0xA0, 0xA4, 0x00, 0x00, 0x02]
DF_TELECOM = [0x7F, 0x10]

apdu = SELECT+DF_TELECOM
print('sending ' + toHexString(apdu))

response, sw1, sw2 = cardservice.connection.transmit(apdu)
print('response: ', response, ' status words: ', "%x %x" % (sw1, sw2))


if sw1 == 0x9F:
    GET_RESPONSE = [0XA0, 0XC0, 00, 00]
    apdu = GET_RESPONSE + [sw2]
    print('sending ' + toHexString(apdu))
    response, sw1, sw2 = cardservice.connection.transmit(apdu)
    print('response: ', toHexString(response),
          ' status words: ', "%x %x" % (sw1, sw2))
