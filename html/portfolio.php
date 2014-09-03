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
?>

<?php
echo("<br><br>");
if(isset($_GET['userName']))
{
		$userName = $_GET['userName'];

		$getUserDetails = "SELECT userName, firstName, lastName, bio FROM tblUser WHERE tblUser.userName = '$userName'";
		$user = mysql_query($getUserDetails);

		while($row = mysql_fetch_array($user))
		{
			$username = $row[0];
			$firstName = $row[1];
			$lastName = $row[2];
			$bio = $row[3];
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

				$selectString = "SELECT listingImage, listingName, category, listingInfo, listingID FROM tblListing JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblUser.userName = '$username'";
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
								elseif($field == 'listingID')
								{
									echo("<td id = 'searchResult'><a href='viewListing.php?listingID=$value'>Click to view listing</a></td>");
								}
								else
								{
									echo("<td id = 'portfolioResult'>$value</td>");
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
else
{
	echo("<br><br><br> broken");
}

?>

	</body>

</html>