/etc/init.d/apache2 stop
/opt/lampp/lampp startapache
/opt/lampp/lampp startmysql
/opt/lampp/lampp startftp
inotifywait -m /opt/lampp/proftpd/didaktikapp -e create |
while read events; do
	php /opt/lampp/proftpd/didaktikapp/test.php >> /opt/lampp/proftpd/logsDidaktikapp.txt; 
done
