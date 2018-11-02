# agsproject1@gmail.com
# kelleymsis

import smtplib
import json
import urllib
import subprocess

#######################################

proc = subprocess.Popen("php email.php", shell=True, stdout=subprocess.PIPE)
script_response = proc.stdout.read()
data = json.loads(script_response)

for em in data:

	TO = em['primaryContactEmail']
	SUBJECT = 'AGS Site Warning'
	TEXT = 'Sensor(s) have determined that a turbine at your site is not performing optimally. Please review the site online at: http://ec2-18-222-172-105.us-east-2.compute.amazonaws.com/.'

	# Gmail Sign In
	gmail_sender = 'agsproject1@gmail.com'
	gmail_passwd = 'kelleymsis'

	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.ehlo()
	server.starttls()
	server.login(gmail_sender, gmail_passwd)

	BODY = '\r\n'.join(['To: %s' % TO,
						'From: %s' % gmail_sender,
						'Subject: %s' % SUBJECT,
						'', TEXT])

	try:
		server.sendmail(gmail_sender, [TO], BODY)
		print ('email sent')
	except:
		print ('error sending mail')

server.quit()