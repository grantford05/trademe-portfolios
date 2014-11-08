<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Search | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/resultsStyle.css"/>

		<script src="/scripts/rowlink.js"></script>
		<script src="../scripts/jquery-1.11.0.min.js"></script>
		<script src="../scripts/lightbox.min.js"></script>

	</head>

	<body>

<!-- Output the results of a search
     Authors: Grant Ford and Lucas Mills
     Project: Trade Me Portfolios
     Date: 28/10/2014 -->

<?php
	//include the files to connect to database, and display the navbar
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php

//assign the search entered to a variable
$searchValue = (strip_tags($_POST['searchValue']));
echo("<div id = 'container'>");

//check to see that the search entered was not empty
if(!empty($searchValue))
{
		echo("<h3>Search Results for '$searchValue'</h3><br><br>");

		//query to select the results of the search entered
		$selectString = "SELECT listingID, listingImage, listingName, category, listingInfo, userName FROM tblListing JOIN tblUser 
						ON (tblListing.userID = tblUser.userID) WHERE listingName LIKE '%$searchValue%' 
						OR category LIKE '%$searchValue%' OR listingInfo LIKE '%$searchValue%'";
		$result = mysql_query($selectString);
		//check to see if search query returned values
		if(mysql_num_rows($result)==0)
		{
					//if no results given then give feedback to user
					echo("<div id = 'emptySearch'>
					No results found. :(
				</div>");
		}
		else
		{
			//Echo search results table
			include '/scripts/searchTable.php';
		}

}
else
{		
		//if search was empty then give feedback to user
		echo("<div id = 'emptySearch'>
			Oops, It looks like you didn't actually search for anything. :(
		</div>");
}

?>

			</div>

		</div>

	</body>

</html>