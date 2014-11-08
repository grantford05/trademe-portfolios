<?php
/*	 Connects to the database.
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 */
	 
	//declare to database host 
	$host = "mysql.ict.op.ac.nz";

	//declare the database host username
	$userMS = "usr_trademeport";
	
	//declare the database host password
	$passwordMS = "6wYXZeYpEhnht8b7";
	
	//connect to the database host
	$connection = mysql_connect($host, $userMS, $passwordMS)or die("Couldnt connect:" . mysql_error());

	//select the database to use
	$database = "in700_trademeportfolio";
	
	//connect to the selected database
	$db = mysql_select_db($database, $connection) or die("Couldnt select database");

?>