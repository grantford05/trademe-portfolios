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
		<link rel = "stylesheet" href="../styles/buttons.css"/>
	</head>

	<body>

<?php 
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php
if(isset($_GET['userName']))
{
		$userName = $_GET['userName'];

		$getUserDetails = "SELECT userName, firstName, lastName, userImage, bio FROM tblUser WHERE tblUser.userName = '$userName'";
		$user = mysql_query($getUserDetails);

		while($row = mysql_fetch_array($user))
		{
			$username = $row[0];
			$firstName = $row[1];
			$lastName = $row[2];
			$userImage = $row[3];
			$bio = $row[4];
		}

		echo("<div id = 'portfolioContainer'>

				<div id = 'topInfo'>

					$username's Portfolio

				</div>

				<div id = 'artistInfo'>

					<img src='$userImage' height='125px' width='150px' alt='userImage' id='userImage'>
					<div id = 'userInfo'>
					<br>$firstName $lastName</b> <br><br>
					</div>
					<div id = 'userBio'>$bio<br>
					</div>

				</div>

				<div id = 'artistWork'>");

				$selectString = "SELECT listingImage, listingName, category, listingImage, listingID FROM tblListing JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblUser.userName = '$username'";
				$result = mysql_query($selectString);

				echo("<table id = 'portfolioTable'>");
					while ($row = mysql_fetch_assoc($result))
					{
						echo("<tr id = 'portoflioContainers'>");
							foreach($row as $field => $value)
							{
								if ($field == 'listingImage')
								{
									echo("<td><img src='$value' height='125px' width='150px' alt='listingImage' id='artImage'></td>");
								}
								elseif($field == 'listingID')
								{
									echo("<td id = 'searchResult'><a href='viewListing.php?listingID=$value'>Click to view listing</a></td>");
								}
								else
								{
									echo("<td id = 'searchResult'>$value</td>");
								}
							}
							echo("</tr>");
					}
				echo("</table>");
			
				mysql_free_result($user);
				mysql_free_result($result);

		echo("</div>

	</div>");
}

?>

	</body>

</html>