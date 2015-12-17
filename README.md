# fEMR-Cleanse-Generator

This standalone web application is created to be used directly with fEMR (https://github.com/FEMR/femr).

### Description

The Cleanse Generator is an intuitive way of cleaning up misspellings and errors within the current medical record database.  Our hopes is this can be expanded to clean future fields.
The goal is to be able to easily operate and have an overall understanding of the 
process of the city cleanse generator. All dependencies, installation/deployment and
warnings will be outlined below.

### Dependencies

- MAMP
- Big Dump (http://www.ozerov.de/bigdump/)
or
- PHP 5.5.9 w/ mysqli
- MySQL 5.6
- Apache 2.4.7

### Installation and Deployment
##Installing MAMP

MAMP
1. Visit the MAMP website for installation

 https://www.mamp.info/en/downloads/

2. Open MAMP

3. Under "Preferences", select the Web Server tab. 

4. Change the Document Root to the root of the Cleanse Generator folder and click Ok.

5. Under the Ports tab make sure that the Apache Port is set to 80 and that the MySQL Port is set to 3306.

6. For fast access to the PHPmyAdmin page, under the Start/Stop tab change the Start page url to /MAMP/index.php?page=phpmyadmin&language=English
##Creating the cities dictionary

There are two ways of doing this:
1. Import using bigdump.php (slower)

	1.1 Create a database called cities_dictionary
	
	1.2 Open browser and go to localhost/bigdump.php
	
	1.3 Start Dump
	
2. Import using phpMyAdmin

	1.1 Create a database called cities_dictionary
	
	1.2 Open browser and go to localhost/phpMyAdmin
	
	1.3 Select cities_dictionary
	
	1.4 Select Import
	
	1.5 Select Choose File and locate cities dictionary location "ADMIN PAGE/cityDump/mission_cities.sql"
	
	1.6 Click Go
##Configuring database credentials
1.  The city cleanse uses default credentials for host/username/password/femrDBName.  
2.  To configure default credentials goto "ADMIN PAGE/connect.php".
##Starting the Cleanse
1. Open your Chrome web browser and type within the web address "localhost/adminpage.html" (This will take you to the cleanse generator home page)

2. Once you have the Cleanse Generator page open, select the City Cleanse button. Please do not reload or close a page during the cleanse process.

3. When the cleansing is complete, you will be presented with a city in question, a dropdown of five suggestions for the proper city spelling, or the option "other" to type your own suggestion.

4. Upon entering the replacement of your choice, press the Update button. *NOTE* A message will appear next to the column warning you of a successful or unsuccessful change to the database.

5. The cleanse queries the 20 patients per page to provide fast queries.  To change the limit, open the cityCleanse.php and change "per_page" to a desired number (WARNING: This will affect performance and also may return no results).

-Do not refresh the page once cleansing

#### FEMR - Fast Electronic Medical Records

[![Build Status](https://travis-ci.org/FEMR/femr.svg?branch=master)](https://travis-ci.org/FEMR/femr)

A simple and fast EMR system.

####Community
1. [JIRA](https://teamfemr.atlassian.net)
2. We collaborate on Slack - contact ken.dunlap@teamfemr.org for an invite!


