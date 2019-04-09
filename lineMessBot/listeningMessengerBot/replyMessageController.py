from fbchat import Client
from fbchat.models import *
import sys
sys.path.insert(0, '..')
import mysqlController
import re
import time

def accountConfirm(message, userMessengerID):
    try:
        if( mysqlController.isConnected(userMessengerID) ):
            return "This account has already linked to localbookshare.com!"    
        linkNumber = re.findall(r"\d{10,15}", message)[0]
        mysqlController.connectLinkWithID(linkNumber, userMessengerID)
        if( mysqlController.isConnected(userMessengerID) ):
            return "Account Linked :D\nYou can now type 'order borrow status' to see info about the book you are borrowing\nMore functions are on the way :D"
        else:
            return "Cannot confirm this number. Please check again"    
    except:
        return "Cannot find confirm number. Please check again"

def borrowStatus(userMessengerID):
    result = mysqlController.borrowingStatus(userMessengerID)
    if(result==0):
        return "You are not borrowing any book. Go to https://localbookshare.com to find the one you love :3"
    dayToSecond = 24*3600
    timeLeft = max(0, int((result[3]-time.time())/dayToSecond))
    print(result[3], time.time())
    replyMessage = """
        \nBook Name: {}\nBook Link: https://localbookshare.com/detail_book/{}\nTime Left: {} days
    """.format(result[1], result[2], timeLeft)
    if(timeLeft==0):
        replyMessage = replyMessage+"\nPlease return it as soon as possible!"
    return replyMessage

def replyGroupMessage(message, threadID):
    return "huhu"

def replyUserMessage(message, threadID):
    message = message.lower().strip()
    if message[0:5:1]=="order":
        if("account confirm" in message):
            return accountConfirm(message, threadID)
        elif("borrow status" in message):
            return borrowStatus(threadID)
    return "wut?"


if __name__ == "__main__":
    print(borrowStatus("100008335771493"))