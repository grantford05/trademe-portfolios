<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/indexStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>

	</head>

	<body>

<?php 
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php

		echo("<div id = 'featuredGrids'>

			<h3>Featured Listings</h3>

				<div id = 'featuredListing'>

				</div>


			<h3>Featured Artists</h3>

				<div id = 'featuredArtist'>

				</div>

		</div>");

?>
	</body>

</html>