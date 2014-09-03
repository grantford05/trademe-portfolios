<!DOCTYPE html>

<html>

	<head>

		<title>Portfolio Database Seed</title>
		<meta charset="UTF-8">

	</head>

	<body>

<?php

	include 'connect.inc.php';

	$dropQuery = "DROP TABLE IF EXISTS tblUser;";

	$result = mysql_query($dropQuery);
	
	/*Creates User database with corresponding fields*/
	$createQuery = "CREATE TABLE tblUser
	(
		userID			INT(6) 		NOT NULL AUTO_INCREMENT,
		userName		VARCHAR(20) NOT NULL,
		firstName		VARCHAR(20) NOT NULL,
		lastName		VARCHAR(20) NOT NULL,
		userImage 		VARCHAR(40)	NOT NULL,
		email 			VARCHAR(30) NOT NULL,
		password		VARCHAR(50) NOT NULL,
		bio 			VARCHAR(150) NOT NULL,
		userAddress		VARCHAR(50) NOT NULL,
		phone			INT(12)		NOT NULL,
		
		PRIMARY KEY(userID)
	)";

	$result = mysql_query($createQuery);

	$dropQuery = "DROP TABLE IF EXISTS tblArtist;";

	$result = mysql_query($dropQuery);

	/*Creates Artist database with corresponding fields*/
	$createQuery = "CREATE TABLE tblArtist
	(
		artistID		INT(6) 			NOT NULL AUTO_INCREMENT,
		userID			INT(6) 			NOT NULL,
		categoryID		INT(6) 			NOT NULL,
		listingImage			VARCHAR(20) 	NOT NULL,
		bio				VARCHAR(250)	NOT NULL,

		PRIMARY KEY(artistID)
	)";

	$result = mysql_query($createQuery);

	$dropQuery = "DROP TABLE IF EXISTS tblGallery;";

	$result = mysql_query($dropQuery);

	/*Creates Gallery database with corresponding fields*/
	$createQuery = "CREATE TABLE tblGallery
	(
		galleryID		INT(6) 		NOT NULL AUTO_INCREMENT,
		categoryID		INT(6) 		NOT NULL,
		galleryName		VARCHAR(40) NOT NULL,
		address			VARCHAR(50) NOT NULL,
		phone			INT(12) 	NOT NULL,
		artistAddress	VARCHAR(40) NOT NULL,
		image			VARCHAR(20) NOT NULL,
		galleryInfo		VARCHAR(50) NOT NULL,
		
		PRIMARY KEY(galleryID)
	)";

	$result = mysql_query($createQuery);

	$dropQuery = "DROP TABLE IF EXISTS tblListing;";

	$result = mysql_query($dropQuery);

	/*Creates Listing database with corresponding fields*/
	$createQuery = "CREATE TABLE tblListing
	(
		listingID		INT(6) 			NOT NULL AUTO_INCREMENT,
		userID			INT(6)			NOT NULL,
		listingName		VARCHAR(50)		NOT NULL,
		category 		VARCHAR(50)		NOT NULL,
		listingImage	VARCHAR(50)	 	NOT NULL,
		price			INT(12) 		NOT NULL,
		listingInfo		VARCHAR(100) 	NOT NULL,
		comments		VARCHAR(50)	 	NOT NULL,
		/* IMPORTANT replace date fields*/
		
		PRIMARY KEY(listingID)
	)";

	$result = mysql_query($createQuery);

	$dropQuery = "DROP TABLE IF EXISTS tblCategories;";

	$result = mysql_query($dropQuery);

	/*Creates Categories database with corresponding fields*/
	$createQuery = "CREATE TABLE tblCategories
	(
		categoryID		INT(6) 			NOT NULL AUTO_INCREMENT,
		categoryname	VARCHAR(30) 	NOT NULL,
		
		PRIMARY KEY(categoryID)
	)";

	

	$dropQuery = "DROP TABLE IF EXISTS tblArtListing;";

	$result = mysql_query($dropQuery);

	$result = mysql_query($createQuery);

	/*Creates ArtListing database with corresponding fields*/
	/*$createQuery = "CREATE TABLE tblArtListing
	(
		artistID		INT(6) 	NOT NULL,
		listingID		INT(6) 	NOT NULL,
		galleryID		INT(6) 	NOT NULL,

	)";*/

	$insertQuery = "INSERT INTO tblCategories (categoryname) VALUE ('Carving & Sculptures'), ('Drawings'), ('Paintings'),
			('Prints'), ('Tattoos'), ('Photographs'), ('Frames'), ('Hanging Sculptures'), ('Home Decor'), ('Writing')";

	$result = mysql_query($insertQuery);
?>

	</body>

</html>