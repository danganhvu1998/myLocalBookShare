import mysql.connector
import re

# Take username, password, server from .env
result = {}
loginInfoFile = open("../.env").read()
loginInfo = re.findall(r"\{\{(.+)\}\}", loginInfoFile)

mydb = mysql.connector.connect(
    host = loginInfo[0],
    user = loginInfo[1],
    passwd = loginInfo[2],
    database = loginInfo[3]
)

def isConnected(userMessengerID):
    cmd = """
        SELECT name, email
        FROM users
        WHERE messenger_id = {}
    """.format(userMessengerID)
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    result = mycursor.fetchall()
    if(len(result)):
        return result[0]
    return 0

def connectLinkWithID(linkNumber, messengerID):
    if(len(linkNumber)>20):
        return 0
    cmd = """
        UPDATE users
        SET messenger_id = {} 
        WHERE fb_link = {}
    """.format(messengerID, linkNumber)
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    mydb.commit()
    cmd = """
        UPDATE users
        SET fb_link = "13213456489755455452165785134351" 
        WHERE fb_link = {}
    """.format(linkNumber)
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    mydb.commit()
    return 1

def borrowingStatus(userMessengerID):
    cmd = """
        SELECT users.id, books.name, books.id, reservations.return_time
        FROM users
        INNER JOIN reservations ON users.id = reservations.user_id
        INNER JOIN books ON reservations.book_id = books.id
        WHERE users.messenger_id = {} AND reservations.status = 1;
    """.format(userMessengerID)
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    result = mycursor.fetchall()
    if(len(result)):
        return result[0]
    return 0

if __name__ == "__main__":
    #fb link 1254789630
    #print(isConnected("100008335771493"))
    #print(connectLinkWithID("1254789630", "100008335771493"))
    print(borrowingStatus("100008335771493"))
