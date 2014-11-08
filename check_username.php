<?php
/*	 Page is called as part of the form checking process
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 */

	session_start();

//check we have username post var
if(isset($_POST["userName"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	
	//try connect to db
	include 'connect.inc.php';
	
	//trim and lowercase username
	$username =  strtolower(trim($_POST["userName"])); 
	
	//sanitize username
	$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check username in db to make sure it is unique
	$results = mysql_query("SELECT userID FROM tblUser WHERE tblUser.userName='$username'");
	
	//return total count
	$username_exist = mysql_num_rows($results); //total records
	
	//if value is more than 0, username is not available
	if($username_exist) {
		echo "0"; //die('');
	}else{
		echo "1";//die('');
	}
	
	//close db connection
	mysql_close($connection);
}
elseif(isset($_POST["email"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	
	//try connect to db
	include 'connect.inc.php';
	
	//trim and lowercase email
	$email =  strtolower(trim($_POST["email"])); 
	
	//sanitize email
	$email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check email in db to make sure it is unique
	$results = mysql_query("SELECT userID FROM tblUser WHERE tblUser.email='$email'");
	
	//return total count
	$email_exist = mysql_num_rows($results); //total records
	
	//if value is more than 0, email is not available
	if($email_exist) {
		echo "0"; //die('');
	}else{
		echo "1";//die('');
	}
	
	//close db connection
	mysql_close($connection);
}
elseif(isset($_POST["listingName"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	
	//try connect to db
	include 'connect.inc.php';
	
	//assign selected listing name to a variable
	$listingName =  $_POST["listingName"]; 
	//get username from session and assign to variable
	$username = $_SESSION["userName"];
	
	//sanitize listing name
	$listingName = filter_var($listingName, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check listing name in db to make sure it is unique to the user 
	$results = mysql_query("SELECT listingID FROM tblListing JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblListing.listingName = '$listingName' && tblUser.userName = '$username'");
	
	//return total count
	$listingName_exist = mysql_num_rows($results); //total records
	
	//if value is more than 0, listing name is not available
	if($listingName_exist) {
		echo "0"; //die('');
	}else{
		echo "1";//die('');
	}
	
	//close db connection
	mysql_close($connection);
}
?>

