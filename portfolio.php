<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

	<title>Portfolio | Trade Me Portfolios</title>

		<link rel = "stylesheet" href="../styles/reset.css"/>
		<link rel = "stylesheet" href="../styles/portfolioStyle.css"/>
		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>
		<link rel ="stylesheet" href="../styles/lightbox.css" />

		<script src="../scripts/jquery-1.11.0.min.js"></script>
		<script src="../scripts/lightbox.min.js"></script>

	</head>

	<body>

<!-- Portfolio page for an artist that displays all their current work
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 -->

<?php 
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php
echo("<br><br>");
if(isset($_GET['userName']))
{
	echo("<div id = 'portfolioContainer'>");
		$userName = $_GET['userName'];

		$getUserDetails = "SELECT userName, firstName, lastName, userImage, bio, userAddress, email, userGallery 
							FROM tblUser WHERE tblUser.userName = '$userName'";
		$user = mysql_query($getUserDetails);

		if(mysql_num_rows($user)==0)
		{
			echo("<div id = 'error'>Oops, we can't seem to find the user you're looking for sorry.</div>");
		}
		else
		{
			while($row = mysql_fetch_array($user))
			{
				$username = $row[0];
				$firstName = $row[1];
				$lastName = $row[2];
				$userImage = $row[3];
				$bio = $row[4];
				$userAddress = $row[5];
				$email = $row[6];
				$userGallery =$row[7];
			}

				echo("<div id = 'artistInfo'>
					<img src='$userImage' width = '180px' height = '180px' alt='userImage' id='userImage'>
					<div id = 'userInfo'>
					<b>$firstName $lastName</b> <br>
					$userName<br><br>
					$userAddress<br>
					<a href ='mailto:$email?Subject=Hi%20$firstName,%20I%20like%20your%20portfolio!' target='_blank'> $email</a><br><br>
					<i>$bio</i> <br><br>");

					if($userGallery != 0)
					{
						$getGalleryName = "SELECT galleryName FROM tblGallery WHERE tblGallery.galleryID = '$userGallery'";
						$user = mysql_query($getGalleryName);
						while($galRow = mysql_fetch_array($user))
						{
							$galleryName = $galRow[0];
						}
						echo("View My Work At:<br><a href='gallery.php?galleryID=$userGallery'>$galleryName</a><br>");
					}
					
					echo("</div>
				</div>
				<div id = 'artistWork'>");

					$selectString = "SELECT listingName, listingImage, listingID FROM tblListing JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblUser.userName = '$username'";
					$result = mysql_query($selectString);

					$i = 0;

					echo("<table id = 'portfolioTable'>");
					echo("<tr id = 'portfolioRow'>");
					while ($row = mysql_fetch_assoc($result))
					{
						foreach($row as $field => $value)
						{
							if($i == 12)
							{
								$i = 0;
								echo("</tr><tr>");
							}
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
								echo("<td><a class='image' href='$value' data-lightbox = 'portfolio' data-title = \"".htmlspecialchars($listingname)." - By $firstName $lastName\">
										<img id = 'portfolioImage' src='$value' height='125px' width='150px' alt='listingImage' id='listingImage'>
									</a>");
							}
							elseif($field == 'listingID')
							{
								echo("<br><div id = 'listingLink'><a href='viewListing.php?listingID=$value'>$listingname</a></td>");
							}
							$i++;
						}
					}
					echo("</tr>");
					echo("</table>");

					mysql_free_result($user);
					mysql_free_result($result);

			echo("</div>");

			include '/scripts/profileViews.php';
		}
	}
	else
	{
		echo("<div id = 'portfolioContainer'>");
		echo("<div id = 'error'>Oops, we can't seem to find the user you're looking for sorry.</div>");
	}
	echo("</div>");

?>

	</body>

</html>