<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

	<title>Home | Trade Me Portfolios</title>

		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/indexStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/portfolioStyle.css"/>
		<link rel ="stylesheet" href="/styles/lightbox.css" />

		<script src="/scripts/jquery-1.11.0.min.js"></script>
		<script src="/scripts/lightbox.min.js"></script>

	</head>

	<body>

<!-- Home page for the site. Displays featured artists, and listings
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 -->

<?php 
	//include the files to connect to database, and display the navbar
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php
echo("<br><br>");
		echo("<div id = welcome>
			<div id = 'welcomeBanner'>Welcome to Trade Me Portfolios!
			</div>
			<div id = 'logMessage'>");
			//checks if user is logged in then displays their username to them and a logout option
			if(isset($_SESSION['userName']))
			{
				//assign username to variable
				$userName = $_SESSION['userName'];
				//fetch users first name form the database
				$getFirstName = "SELECT firstName FROM tblUser WHERE tblUser.userName = '$userName'";
				$result = mysql_query($getFirstName);
				while($row = mysql_fetch_array($result))
				{
					$firstName = $row[0];
				}
				//display greeting message to logged in user with logout link
				echo("Hi, $firstName! (<a href='logout.php'>Logout</a>)");
				mysql_free_result($result);
			}
			else
			{
				//if no user logged in then display link to logging in or registering
				echo("You are not logged in. Would you like to <a href='account.php'>register/login</a>?");
			}
			echo("</div>");
		echo("</div>");

		echo("<div id = 'featuredGrids'>

			<h3>Featured Listings</h3>

				<div id = 'featuredListing'>

					<br>");
					echo("<table id = 'portfolioTable'>");
					echo("<tr id = 'portfolioRow'>");

						//query to select 6 distinct random listings from the database to be displayed on home page
						$getListingDetails = "SELECT DISTINCT listingName, listingImage, listingID FROM tblListing ORDER BY RAND() LIMIT 6";
						$result = mysql_query($getListingDetails);

							//loop through the results assigning information to appropriate variables, displaying information where needed
							while ($row = mysql_fetch_assoc($result))
							{
								foreach($row as $field => $value)
								{
									if ($field == 'listingName')
									{
										if(strlen($value) > 18)
										{
											$listingname = substr($value, 0, 18) . "...";
										}
										else
										{
											$listingname = $value;
										}
									}
									elseif($field == 'listingImage')
									{
										echo("<td><a class='image' href='$value' data-lightbox = 'portfolio' data-title = \"".htmlspecialchars($listingname)."\">
												<img id = 'portfolioImage' src='$value' height='125px' width='150px' alt='listingImage' id='listingImage'>
											</a>");
									}
									elseif($field == 'listingID')
									{
										echo("<br><div id = 'listingLink'><a href='viewListing.php?listingID=$value'>$listingname</a></td>");
									}
								}
							}
	
					echo("</tr>");
					echo("</table>

				</div>

			<h3>Featured Artists</h3>

				<div id = 'featuredArtist'>

					<div id = 'featureduser'>
					<br>");
					echo("<table id = 'portfolioTable'>");
					echo("<tr id = 'portfolioRow'>");

						//query to select 6 distinct random users from the database to be displayed on home page
						$getUserDetails = "SELECT DISTINCT userImage, firstName, lastName, userName FROM tblUser ORDER BY RAND() LIMIT 6";
						$result = mysql_query($getUserDetails);

							//loop through the results assigning information to appropriate variables, displaying information where needed
							while ($row = mysql_fetch_assoc($result))
							{
								foreach($row as $field => $value)
								{
									if ($field == 'firstName')
									{
										$firstName = $value;
									}
									if ($field == 'lastName')
									{
										$lastName = $value;
									}
									elseif($field == 'userImage')
									{
										echo("<td><img id = 'indexUserImage' src='$value' height='125px' width='150px' alt='userImage' id='userImage'>");
									}
									elseif($field == 'userName')
									{
										echo("<br><div id = 'listingLink'><a href='portfolio.php?userName=$value'>$firstName $lastName</a></td>");
									}
								}
							}
							mysql_free_result($result);
	
					echo("</tr>");
					echo("</table>");
				echo("</div>

				<h3>Featured Galleries</h3>

				<div id = 'featuredArtist'>

					<div id = 'featureduser'>
					<br>");
					echo("<table id = 'portfolioTable'>");
					echo("<tr id = 'portfolioRow'>");

						//query to select 6 distinct random galleries from the database to be displayed on home page
						$getGalleryDetails = "SELECT DISTINCT image, galleryName, galleryID FROM tblGallery ORDER BY RAND() LIMIT 6";
						$result = mysql_query($getGalleryDetails);

							//loop through the results assigning information to appropriate variables, displaying information where needed
							while ($row = mysql_fetch_assoc($result))
							{
								foreach($row as $field => $value)
								{
									if ($field == 'galleryName')
									{
										if(strlen($value) > 18)
										{
											$galleryName = substr($value, 0, 18) . "...";
										}
										else
										{
											$galleryName = $value;
										}
									}
									elseif($field == 'image')
									{
										echo("<td><img id = 'indexUserImage' src='$value' height='125px' width='150px' alt='image' id='image'>");
									}
									elseif($field == 'galleryID')
									{
										echo("<br><div id = 'listingLink'><a href='gallery.php?galleryID=$value'>$galleryName</a></td>");
									}
								}
							}

							mysql_free_result($result);
	
					echo("</tr>");
					echo("</table>");
				echo("</div>

				</div>

		</div>");

?>
	</body>

</html>