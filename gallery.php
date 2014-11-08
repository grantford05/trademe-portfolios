<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

	<title>Gallery | Trade Me Portfolios</title>

		<link rel = "stylesheet" href="../styles/indexStyle.css"/>
		<link rel = "stylesheet" href="../styles/reset.css"/>
		<link rel = "stylesheet" href="../styles/portfolioStyle.css"/>
		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>
		<link rel ="stylesheet" href="../styles/lightbox.css" />

		<script src="../scripts/jquery-1.11.0.min.js"></script>
		<script src="../scripts/lightbox.min.js"></script>

	</head>

	<body>

<!-- Gallery page to show the artists' currently exhibiting with them
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
//checks that there is a galleryID 
if(isset($_GET['galleryID']))
{
	echo("<div id = 'portfolioContainer'>");
		//assign galleryId to a variable
		$galleryID = $_GET['galleryID'];

		//query to get the information about the chosen gallery
		$getGalleryDetails = "SELECT galleryName, address, phone, galleryEmail, website, image, galleryInfo FROM tblGallery WHERE tblGallery.galleryID = '$galleryID'";
		$gallery = mysql_query($getGalleryDetails);

		//check that the query returned a value
		if(mysql_num_rows($gallery)==0)
		{
			//no value is returned then output feedback to the user
			echo("<div id = 'error'>Oops, we can't seem to find the gallery you're looking for sorry.</div>");
		}
		else
		{
			//if a value is returned then assign the data to appropriate variables
			while($row = mysql_fetch_array($gallery))
			{
				$galleryName = $row[0];
				$address = $row[1];
				$phone = $row[2];
				$galleryEmail = $row[3];
				$website = $row[4];
				$image = $row[5];
				$galleryInfo = $row[6];
			}

				//display the gallery information to the user
				echo("<div id = 'artistInfo'>
					<img src='$image' width = '180px' height = '180px' alt='userImage' id='userImage'>
					<div id = 'userInfo'>
					<b>$galleryName</b> <br><br>
					$address<br><br>
					$phone<br><br>
					<a href='$website'>$website</a><br><br>
					<a href ='mailto:$galleryEmail?Subject=Dear%20$galleryName,%20I%20saw%20your%20Gallery%20on%20Trade%20Me%20portfolios!' target='_blank'> $galleryEmail</a><br><br>
					<i>$galleryInfo</i> <br><br>
					</div>
				</div>
				<div id = 'artistWork'>");

					echo("<table id = 'portfolioTable'>");
					echo("<tr id = 'portfolioRow'>");

						//get the information of users that are linked to the gallery
						$getUserDetails = "SELECT DISTINCT userImage, firstName, lastName, userName FROM tblUser WHERE tblUser.userGallery = '$galleryID'";
						$result = mysql_query($getUserDetails);

							//assign the query values to variables and output the appropriate information
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
					
					mysql_free_result($gallery);

			echo("</div>");
		}
	}
	else
	{
		//if no galleryID is given then give the user feedback
		echo("<div id = 'portfolioContainer'>");
		echo("<div id = 'error'>Oops, we can't seem to find the gallery you're looking for sorry.</div>");
	}
	echo("</div>");

?>

	</body>

</html>