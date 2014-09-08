<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/reset.css"/>
		<link rel = "stylesheet" href="../styles/viewListingStyle.css"/>
		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>

	</head>

	<body>

<?php 
	include 'searchBar.php'; 
	include 'connect.inc.php';
	include '../scripts/userDetails/getUserDetails.php';
?>

<?php


	$listingID = $_GET['listingID'];

	$getUserDetails = "SELECT listingName, category, listingImage, price, listingInfo, comments, userName FROM tblListing 
	JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblListing.listingID = '$listingID'";
	$user = mysql_query($getUserDetails);

	while($row = mysql_fetch_array($user))
	{
		$listingName = $row[0];
		$category = $row[1];
		$image = $row[2];
		$price = $row[3];		
		$listingInfo = $row[4];
		$comments = $row[5];
		$userName = $row[6];
	}

	echo("<div id = 'listingContainer'>

		<div id = 'topInfo'>

			$listingName

		</div>

		<div id = 'listingInfo'>
			<br><br>
			<img src='$image' height='225px' width='250px' alt='listingImage' id='listingImage'>

			<p><b>Price:</b> $$price <br>
			<b>Category:</b> $category <br>
			<b>Seller:</b> <a href='portfolio.php?userName=$userName'>$userName</a></p><br>
			<b>Information:</b> $listingInfo <br><br>
		</div>
		<div id='listingComments'>
			<br><b>Comments</b><br>
			<p>Here be some comments</p>
		</div>

	</div>");

	mysql_free_result($user);


?>

	</body>

</html>