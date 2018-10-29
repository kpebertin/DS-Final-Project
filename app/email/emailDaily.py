# agsproject1@gmail.com
# kelleymsis

import smtplib
import json
import urllib
import urllib2
#######################################

url = "file://email.php"
req = urllib2.Request(url, headers={'Content-type': 'application/json'})
response = urllib2.urlopen(req)
the_page = response.read()
print(the_page)

#######################################

# TO = 'kyle78@ebertinhome.net'
# SUBJECT = 'TEST MAIL'
# TEXT = 'Here is a message from python.'

# # Gmail Sign In
# gmail_sender = 'agsproject1@gmail.com'
# gmail_passwd = 'kelleymsis'

# server = smtplib.SMTP('smtp.gmail.com', 587)
# server.ehlo()
# server.starttls()
# server.login(gmail_sender, gmail_passwd)

# BODY = '\r\n'.join(['To: %s' % TO,
# 					'From: %s' % gmail_sender,
# 					'Subject: %s' % SUBJECT,
# 					'', TEXT])

# try:
# 	server.sendmail(gmail_sender, [TO], BODY)
# 	print ('email sent')
# except:
# 	print ('error sending mail')

# server.quit()