<!DOCTYPE html>

<?php
	session_start();
?>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>

	</head>

	<body>

<?php 
	include 'connect.inc.php';
	include 'searchBar.php'; 
?>

		<div id = "container">

				<div id = "leftContent">

					<p>Logged out.</p>

					<?php
						session_destroy();
						 header( 'Location: http://portfolio.ict.op.ac.nz/html/index.php' )
					?>

				</div>

				<div id = "rightContent">

				</div>

		</div>

	</body>

</html>