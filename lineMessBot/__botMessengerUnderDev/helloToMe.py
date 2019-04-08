from fbchat import Client
from fbchat.models import *
import re
import ast
import time

fhand = open("../.env", "r")
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
    #while True:
    #    autoReply("Dm Tuan, https://discord.gg/qVyQKTM")
    #    time.sleep(5)
    #print(client.searchForUsers("foyripvgf", limit=1)[0])
    print(client.fetchUserInfo("100008335771493"))
    #User(uid='100008335771493', type=ThreadType.USER, photo='https://scontent-nrt1-1.xx.fbcdn.net/v/t1.0-1/p50x50/49686387_2238342953120209_2715401680286908416_n.jpg?_nc_cat=107&_nc_ht=scontent-nrt1-1.xx&oh=2aef4f3382f081e9afcfa2779708e835&oe=5D42066B', name='Đặng Anh Vũ', last_message_timestamp=None, message_count=None, plan=None, url='https://www.facebook.com/foyripvgf', first_name='Vũ', last_name='Đặng Anh', is_friend=True, gender='male_singular', affinity=None, nickname=None, own_nickname=None, color=None, emoji=None)