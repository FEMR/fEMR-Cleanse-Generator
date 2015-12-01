# fEMR-Cleanse-Generator

This standalone web application is created to be used directly with fEMR (https://github.com/FEMR/femr).

### Description

The Cleanse Generator is an intuitive way of cleaning up mispellings and errors within the current medical record database.  Our hopes is this can be expanded to clean future fields.
The goal is to be able to easily operate and have an overall understanding of the 
process of the city cleanse generator. All dependencies, installation/deployment and
warnings will be outlined below.

### Dependencies

- MAMP

### Installation and Deployment

1. Visit the MAMP website for installation

 https://www.mamp.info/en/downloads/

2. Open MAMP

3. Under "Preferences", select the Web Server tab. 

4. Change the Document Root to the root of the Cleanse Generator folder and click Ok.

5. Under the Ports tab make sure that the Apache Port is set to 80 and that the MySQL Port is set to 3306.

6. For fast access to the PHPmyAdmin page, under the Start/Stop tab change the Start page url to /MAMP/index.php?page=phpmyadmin&language=English

7. Open the SQL Database file with an editor program and include "use (your database name);" at the top of the page. 

8. Open your Chrome web browser and type within the web address "localhost/adminpage.html" (This will take you to the cleanse generator home page)

9. You may come across warnings inquiring you to apply script fixes and/or marking the database as resolved. Please apply these changes if necessary.

10. Also, if you do not have the cities dictionary in your database then it will be added.

11. Once you have the Cleanse Generator page open, select the City Cleanse button. Please do not reload or close a page during the cleanse process.

12. When the cleansing is complete, you will be presented with a city in question, a dropdown of five suggestions for the proper city spelling, or the option "other" to type your own suggestion.

13. Upon entering the replacement of your choice, press the Update button. *NOTE* A message will appear next to the column warning you of a successful or unsuccessful change to the database.

14. When cleansing is complete, close out of MAMP.


*WARNINGS*
-Ensure that the database that you are intending to cleanse is linked to the cleanse
generator admin page.

-Do not refresh the page once cleansing

#### FEMR - Fast Electronic Medical Records

[![Build Status](https://travis-ci.org/FEMR/femr.svg?branch=master)](https://travis-ci.org/FEMR/femr)

A simple and fast EMR system.

####Community
1. [JIRA](https://teamfemr.atlassian.net)
2. We collaborate on Slack - contact ken.dunlap@teamfemr.org for an invite!


