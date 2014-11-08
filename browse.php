<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Browse | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/buttons.css"/>		
		<link rel = "stylesheet" href="/styles/resultsStyle.css"/>

		<script src="/scripts/browse.js" type="text/javascript"></script>
		<script src="../scripts/jquery-1.11.0.min.js"></script>
		<script src="../scripts/lightbox.min.js"></script>


	</head>

	<body>

<!-- Users can use this page to browse for listings
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 -->

<?php
	//include the files to connect to database, and display the navbar
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php

		echo("<div id = 'container'>

			<div id = 'browse'>
			<div id = 'browseBorder'>
			<h3>Browse</h3>
			<p>Want to refine your search? Browse below.</p>");

			$self = htmlentities($_SERVER['PHP_SELF']);

				//create a form that has drop down boxes for the user to select from
				echo("<form action = '$self' method='POST'>

					<p>I am looking for a listing under the category ");

					//Fetch all the category names form the categories table
					$selectQuery = "SELECT categoryname FROM tblCategories ORDER BY categoryname";
					$result = mysql_query($selectQuery);

					//add the category names to a drop down box
					echo("<select name = 'categoryType' id = 'smallDropDown'>
						<option value = 'all'>All Art Categories</option>");
						while($row  = mysql_fetch_row($result))
						{
							echo("<option value = '$row[0]'>$row[0]</option>");
						}

					//create drop down box for the user to select the way the results are sorted
					echo("</select> sorted by  

						<select name = 'listingOrder' id = 'smallDropDown'>
							<option value = 'listingID DESC'>Newest</option>
							<option value = 'listingID ASC'>Oldest</option>
							<option value = 'listingName ASC'>A-Z</option>
							<option value = 'listingName DESC'>Z-A</option>
						</select>

					</p>

					<div id = 'browseButton'>

						<input type='submit' class = 'uploadButton' name='refreshSearch' value = 'Browse'>

					</div>
					</div>

				</form>");

				//check that the user has clicked the submit button, run browse function when they have
				if(isset($_POST['refreshSearch']))
				{
					browse();
				}

				//create the function that select the browse results output based on what selection the user made
				function browse()
				{
					//assign the user sleections to variables
					$categoryType = $_POST['categoryType'];
					$listingOrder = $_POST['listingOrder'];

					//check to see if the user selected a specfic category or to see all
					if($categoryType == 'all')
					{
						//run the query to fetch the listings to output to the user. 
						$selectString = "SELECT listingID, listingImage, listingName, category, listingInfo, userName FROM tblListing JOIN tblUser 
						ON (tblListing.userID = tblUser.userID) ORDER BY $listingOrder";
						$result = mysql_query($selectString);
					}
					else
					{
						//run the query to fetch the listings to output to the user. 
						$selectString = "SELECT listingID, listingImage, listingName, category, listingInfo, userName FROM tblListing JOIN tblUser 
						ON (tblListing.userID = tblUser.userID) WHERE category = '$categoryType' ORDER BY $listingOrder";
						$result = mysql_query($selectString);	
					}
				
					//check that some sort of results was returned from the query
					if(mysql_num_rows($result)==0)
					{
							//if no results are returned give the user feedback telling them  
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

?>

			</div>

	</div>

	</body>

</html>