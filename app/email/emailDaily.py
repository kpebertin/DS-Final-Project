# agsproject1@gmail.com
# kelleymsis

import smtplib
import mysql.connector
#######################################

conne = mysql.connector.connect(user='root', password='disprotek', host='localhost', database='agsSystem')
q = ("SELECT * FROM Client;")
cursor.execute(q)
for row in cursor:
	print(row)

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