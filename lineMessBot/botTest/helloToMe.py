from fbchat import Client
from fbchat.models import *
import re
import ast
import time

fhand = open(".env", "r")
loginInfos = re.findall("<(.+)>", fhand.read())
fhand.close()
client = Client(loginInfos[0], loginInfos[1], session_cookies=ast.literal_eval(loginInfos[2]))
print('Own id: {}'.format(client.uid))
#print(client.getSession())

def sendMessToThread(threadID, message):
    client.send(Message(text=message), thread_id=threadID, thread_type=ThreadType.USER)
    client.markAsRead(threadID)

def sendMessToUser(reveiverName, message):
    reveiver = client.searchForUsers(reveiverName, limit=1)[0]
    client.send(Message(text=message), thread_id=reveiver.uid, thread_type=ThreadType.USER)
    client.markAsRead(reveiver.uid)

def autoReply(message):
    users = client.fetchUnread()
    for user in users:
        sendMessToThread(user, message)
        print(user, message)
        

if __name__ == "__main__":
    #client.send(Message(text='Hi me!'), thread_id="100008335771493", thread_type=ThreadType.USER)
    #sendMessToUser("foyripvgf", "Xin Chao")
    while True:
        autoReply("Dm Tuan, https://discord.gg/qVyQKTM")
        time.sleep(5)