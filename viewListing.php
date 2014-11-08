<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Listing | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/reset.css"/>
		<link rel = "stylesheet" href="/styles/viewListingStyle.css"/>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel ="stylesheet" href="/styles/lightbox.css" />

		<script src="/scripts/jquery-1.11.0.min.js"></script>
		<script src="/scripts/lightbox.min.js"></script>

	</head>

	<body>

<!-- View a listing from an artist
     Authors: Grant Ford and Lucas Mills
     Project: Trade Me Portfolios
     Date: 28/10/2014 -->
     
<?php 
	//include the files to connect to database, display the navbar, and get users information
	include 'searchBar.php'; 
	include 'connect.inc.php';
	include '/scripts/userDetails/getUserDetails.php';
?>

<?php

	echo("<div id = 'listingContainer'>");

	//get the listingID and assign to a variable
	$listingID = $_GET['listingID'];

	//query to get the information based on the listingID
	$getUserDetails = "SELECT listingName, category, listingImage, price, listingInfo, userName, listingDate, listingID FROM tblListing 
	JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblListing.listingID = '$listingID'";
	$user = mysql_query($getUserDetails);

	//check to see if query returns values
	if(mysql_num_rows($user)==0)
	{
		//if empty then display feedback to user
		echo("<div id = 'error'>Oops, we can't seem to find the listing you're looking for sorry.</div>");
	}
	else
	{
		//loop through query results and assign to variables
		while($row = mysql_fetch_array($user))
		{
			$listingName = $row[0];
			$category = $row[1];
			$image = $row[2];
			$price = $row[3];		
			$listingInfo = $row[4];
			$userName = $row[5];
			$listingDate = $row[6];
			$listingID = $row[7];
		}

			//output the information for the listing that is being viewed
			echo("<div id = 'artInfo'>
				<div id = 'topInfo'>

					$listingName
					<div id = 'category'>$category</div>
					<div id = 'artist'>By: <a href='portfolio.php?userName=$userName'>$userName</a></div>

			</div>	

			<div id = 'listingID'>Listing # : $listingID</div>	

			<div id = 'listing'>
				<div id = 'listingInfo'>$listingInfo</div> <br>

				<a class='image' href='$image' data-lightbox = '$image'>
				<img src='$image' height='35%' width='35%' alt='listingImage' id='listingImage'>
				</a>

			</div>
			</div>
		</div>");
	}

	mysql_free_result($user);


?>

	</body>

</html>