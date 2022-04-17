Step 1. Download pre-requisites: 

	    1.  Install the microsoft visual C++ packages 2012, 2013 and (2015-2022) ...this is a requirement for WAMP
		https://docs.microsoft.com/en-US/cpp/windows/latest-supported-vc-redist?view=msvc-170

            2.	Install WAMP server version 3.2.6 on machine:
                Wamp server version 3.2.6 link: https://www.wampserver.com/en/

            3.	Install the Java JDK on machine: 
                Java JDK link (tested on version “javac 1.8.0_202”) link: https://www.oracle.com/java/technologies/downloads/


 
Step 2: Extract the fyp project zip directly into the c:/Wamp64/www folder  . This creates an fyp folder 

Step 3: launch WAMP

----configure the database----

step 4: got to http://localhost/phpmyadmin/

step 5: username: root   password: **(leave blank/empty)**

step 6: select "new"

step 7: name the database "fypdatabase"

step 8: Go to import

step 9: Select choose file

step 10: locate the the directory 

step 11: Select Wamp64/www/fyp/Database/fypdatabase.sql

step 12: Select "Go"

Step 13: Go to a browser and enter http://localhost/fyp  

***NOTE***: Registering an account == when the details are filled in make sure to click on an area of the screen before hitting the 
	    register button to reactivate it. 

	    To create an admin account go to http://localhost/phpmyadmin/. Go to the users table and edit the user you would like to give admin permissions to.
	    Change the admin coloumn from 0 to 1. ****An admin account is needed to approve a teacher account***


