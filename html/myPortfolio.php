<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/reset.css"/>
		<link rel = "stylesheet" href="../styles/portfolioStyle.css"/>
		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>

	</head>

	<body>

<?php 
	include 'searchBar.php'; 
	include 'connect.inc.php';
	include 'checkLogin.php';
	include '../scripts/userDetails/getUserDetails.php';
?>

<?php

if(isset($_SESSION['userName']))
{
			$getUserDetails = "SELECT * FROM tblUser WHERE tblUser.userName = '$userName'";
			$user = mysql_query($getUserDetails);

			while($row = mysql_fetch_array($user))
			{
				$userID = $row[0];
				$username = $row[1];
				$firstName = $row[2];
				$lastName = $row[3];
				$image = $row[4];
				$email = $row[5];
				$bio = $row[7];
				$userAddress = $row[8];
				$phone = $row[9];
			}

			echo("<div id = 'portfolioContainer'>

				<div id = 'topInfo'>

					$username's Portfolio

				</div>

				<div id = 'artistInfo'>

					<img src='../images/user.jpg' height='125px' width='150px' alt='userImage' id='userImage'>
					<div id = 'userInfo'>
					<b>$firstName $lastName</b> <br><br>
					$bio <br>
					</div>

				</div>

				<div id = 'artistWork'>");

					$selectString = "SELECT listingImage, listingName, category, listingInfo FROM tblListing WHERE userID = '$userID'";
					$result = mysql_query($selectString);

					echo("<table id = 'portfolioTable'>");
						while ($row = mysql_fetch_assoc($result))
						{
							echo("<tr id = 'portoflioContainers'>");
							foreach($row as $field => $value)
							{
								if ($field == 'listingImage')
								{
									echo("<td><img src='../images/art.jpg' height='125px' width='150px' alt='userImage' id='userImage'></td>");
								}
								else
								{
									echo("<td id = 'portfolioResult'>$value</td>");
								}
							}
							echo("</tr>");
						}
					echo("</table>");
				
					mysql_free_result($result);

			echo("</div>

	</div>");
}

?>

	</body>

</html>