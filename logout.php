<!DOCTYPE html>

<?php
	session_start();
?>

<html>

	<head>
		<title>Logout | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>

	</head>

	<body>

<!-- Used to log users out of the site
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 -->

<?php 
	//include the files to connect to database, and display the navbar
	include 'connect.inc.php';
	include 'searchBar.php'; 
?>

		<div id = "container">

				<div id = "leftContent">

					<?php
					//destroy the session to log the user out
						session_destroy();
						//redirect to home page after user has been logged out
						header( 'Location: http://portfolio.ict.op.ac.nz/index.php' )
					?>

				</div>

				<div id = "rightContent">

				</div>

		</div>

	</body>

</html>