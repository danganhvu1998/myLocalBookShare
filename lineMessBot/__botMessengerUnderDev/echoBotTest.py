from fbchat import log, Client
import re, ast

# Subclass fbchat.Client and override required methods
class EchoBot(Client):
    def onMessage(self, author_id, message_object, thread_id, thread_type, **kwargs):
        self.markAsDelivered(thread_id, message_object.uid)
        self.markAsRead(thread_id)

        log.info("{} from {} in {}".format(message_object, thread_id, thread_type.name))
        # If you're not the author, echo
        if author_id != self.uid:
            self.send(message_object, thread_id=thread_id, thread_type=thread_type)

fhand = open("../.env", "r")
loginInfos = re.findall("<(.+)>", fhand.read())
fhand.close()

client = EchoBot(loginInfos[0], loginInfos[1], session_cookies=ast.literal_eval(loginInfos[2]))
client.listen()