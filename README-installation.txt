Trade Me Portfolios Admin Instructions:

------------------------------------------

Installation:

All files that contain the website’s web pages, php scripts, javascripts scripts, 
and css style sheets are stored on Github, OneDrive, and CD format store on site at Otago Polytechnic.

Though the conceptual prototype is currently hosted on a domain we have setup, hosting the web page on another 
server will require all files added to a server that supports the latest version of PHP.

The database is currently also hosted on a Polytechnic hosted server. If the conceptual prototype needs 
installed on another database, a database seeding script is located inside the ‘scripts’ folder of the website files. 
The host, userMS, passwordMS, and database variables will need to be updated in the ‘connect.inc.php’ file, then run the 
seedDatabase.php file on the websites host server. This will create the tables needed, along with seeding the tblCategories 
table with the art categories needed.

1. Edit the connect.inc.php file to include:
	• $host – url of your database/phpMyAdmin
	• $userMS – login username for phpMyAdmin
	• $passwordMS – password for logging into phpMyAdmin
	• $database – name of database storing the tables
2. Upload all files to your server.
3. Run to seedDatabase.php file from your web browser.

------------------------------------------

Recovery:

In case the necessary files to host the full prototype are lost, any missing files can be pulled from the Github
 account ‘grantford05’. 

Github:
http://github.com/grantford05/trademe-portfolios/ 

------------------------------------------

Administration:

The below instructions are descriptions of the database tables and rows, regarding viewing them via phpMyAdmin.

tblUser:
Stores user details when a user registers. All details except for the username can be changed by the user at any time. 
The email and username must be unique, and the passwords follow a regex pattern.  

tblCategories:
This table stores the art categories that a user can select when uploading a new listing. The seedDatabase.php file 
initially fills this with Trade Me’s default art categories, but any new or requested categories can easily be added.

tblListing:
tblListing stores listings uploaded by the users. The details of the listing can be changed by the user if needed, 
so no management of the data is needed to be done by the administrator.

tblGallery:
tblGallery stores the galleries. These are only uploaded by the administrator, and details can only be changed via 
phpMyAdmin.

If a user wishes to be part of a gallery, you must add the galleries galleryID to the user’s userGallery field.

-------------------------------------------

Contact the Developers:

If you need to get in contact with the developers regarding the conceptual prototype you can contact either
 Lucas Mills or Grant Ford.

Grant Ford – grantford05@gmail.com – 0273011440
Lucas Mills – lucasmillsnz@hotmail.com - 0274186265


