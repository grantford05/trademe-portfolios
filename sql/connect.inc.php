<?php

	$host = "mysql.ict.op.ac.nz";

	$userMS = "usr_trademeport";
	
	$passwordMS = "6wYXZeYpEhnht8b7";
	
	$connection = mysql_connect($host, $userMS, $passwordMS)or die("Couldnt connect:" . mysql_error());

	$database = "in700_trademeportfolio";
	
	$db = mysql_select_db($database, $connection) or die("Couldnt select database");

?>