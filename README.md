Paravantage
===========

Project Description:

	This project is built as a part of the SoftEng 751 paper, which is being taught at University of Auckland, year 2014.

	This project is a web application that interactively visualize the 4 common parallel programming pitfalls:
		1). Race Condition.
		2). Mutual Exclusion.
		3). Dead Lock.
		4). Highly Contended Lock.



Project Installation:

	In order to run this web application, you need to configure your machine to run as a server, and then copy your this project into your server directory.
	
	Below instructions will help you to set up this web application on Ubuntu 13.10 (Linux) machine. We have tested it only on Ubuntu 13.10. You are supposed to work in this instruction using terminal.
	
	1). Installing LAMP
		Update your installation package:
			$ sudo apt-get update
		
		Installing LAMP stack:
			$ sudo apt-get install lamp-server^
			(please mind the caret (^) at the end of the command)
		
	2). Installing Apache 2:
		Install apache2 webserver:
			$ apache2
		After installation, it requires a restart for it to work:
			$ sudo /etc/init.d/apache2 restart
		or
			$ sudo service apache2 restart
		
	3). Installing PHP 5:
		Install PHP5
			$ libapache2-mod-php5
		Enable this module by doing
			$ sudo a2enmod php5
		
		Restart the apache2 after the installation:
			$ sudo service apache2 restart
	
	4). Open Server http (80) and https (22) Ports:
		Open the port
			$ sudo iptables -A INPUT -p tcp --dport http -j ACCEPT
			$ sudo iptables -A INPUT -p tcp --dport https -j ACCEPT
		Restart the IPTable
			$ sudo service ufw restart
	
	5). Copy the Paravantage Web Application Into Server Directory:
		Go to where you store Paravantage folder (i.e. Paravantage folder is tored at: /home/adminuser/Desktop/Paravantage)
			$ cd /home/adminuser/Desktop
		Copy the Paravantage folder to server directory:
			$ sudo cp -r ./Paravantage /var/www/
	
	Done !!!
	
	

Running Paravantage Application:

	1). Open Home page
		Open your favourit browser
		In the "Address" bar, type in:
			http://localhost/Paravantage/Home.php
		
		This link will open the Home page on your browser. From this page, you will see four main buttons that link to all four pitfalls pages. So, you can open any pitfall page by just clicking on the button that link to that page.
	
	2). Open Race Condition Page
		There are two different ways to get to this page:
		a). You can go to Home page and click on "Race Condition" button
		or
		b). You can type below link into your address bar:
			http://localhost/Paravantage/RaceCondition.php
	
	3). Open Mutual Exclusion Page
		There are two different ways to get to this page:
		a). You can go to Home page and click on "Mutual Exclusion" button
		or
		b). You can type below link into your address bar:
			http://localhost/Paravantage/MutualExclusion.php
	
	4). Open Dead Lock Page
		There are two different ways to get to this page:
		a). You can go to Home page and click on "Dead Lock" button
		or
		b). You can type below link into your address bar:
			http://localhost/Paravantage/DeadLock.php
	
	5). Open Highly Contended Lock Page
		There are two different ways to get to this page:
		a). You can go to Home page and click on "Highly Contended Lock" button
		or
		b). You can type below link into your address bar:
			http://localhost/Paravantage/HighlyContentedLock.php