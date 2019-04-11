from fbchat import log, Client
from fbchat.models import *
import re, ast
import replyMessageController

# Subclass fbchat.Client and override required methods
class EchoBot(Client):
    def onMessage(self, author_id, message_object, thread_id, thread_type, **kwargs):
        self.markAsDelivered(thread_id, message_object.uid)
        self.markAsRead(thread_id)

        log.info("{} from {} in {}".format(message_object, thread_id, thread_type.name))
        # If you're not the author, echo
        if author_id != self.uid:
            if(thread_type == ThreadType.USER):
                message = replyMessageController.replyUserMessage(message_object.text, thread_id)
                self.send(Message(text=message), thread_id=thread_id, thread_type=thread_type)
            elif(len(message_object.mentions)>0):
                message = replyMessageController.replyGroupMessage(message_object.text, thread_id)
                self.send(Message(text=message), thread_id=thread_id, thread_type=thread_type)
    
    def onFriendRequest(self, from_id, msg):
        print("\n\n\n\n")
        print(from_id)
        print("\n\n\n\n")
        self.friendConnect(from_id)
        welcomeText = """
            Welcome to LocalBookShare! You can rend book from us at https://localbookshare.com, for FREE!\nTo confirm account, type "order account confirm confirm_number"
        """
        self.send(Message(text=welcomeText), thread_id=from_id, thread_type=ThreadType.USER)

fhand = open("../.env", "r")
loginInfos = re.findall("<(.+)>", fhand.read())
fhand.close()

client = EchoBot(loginInfos[0], loginInfos[1], session_cookies=ast.literal_eval(loginInfos[2]))
client.listen()