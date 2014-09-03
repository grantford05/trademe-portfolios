<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>
		<link rel = "stylesheet" href="../styles/accountStyle.css"/>
		<link rel = "stylesheet" href="../styles/buttons.css"/>
		<link rel = "stylesheet" href="../styles/forms.css"/>

	</head>

	<body>

<?php 
	include 'searchBar.php'; 
	include 'connect.inc.php';
	include 'checkLogin.php';
?>

<?php

if(isset($_SESSION['userName']))
{
	echo("<div id = 'container'>

		<div id = 'leftContent'>

			<h3>Account Management</h3>

			<a href='editAccount.php'>Edit My Details</a><br><br>
			Change My Password <br><br>
			<a href='logout.php'>Logout</a> 

		</div>

		<div id = 'rightContent'>

			<h3>$userName's Account</h3>");

			$getUserDetails = "SELECT * FROM tblUser WHERE tblUser.userName = '$userName'";
			$result = mysql_query($getUserDetails);

			while($row = mysql_fetch_array($result))
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

			mysql_free_result($result);

			echo("<div id = 'accountDetails'>
				<h4>Details for $firstName $lastName:</h4>
				Bio: $bio <br>
				Email: $email <br>
				Address: $userAddress <br>
				Phone: $phone <br><br>

				<h4>Portfolio Statistics:</h4>
				Number of Listings: -- <br>
				Portfolio Views: -- <br>
				Number of Comments: -- <br>
				Number of Favourites: -- <br><br>
			</div>");


		echo("</div>



		</div>

	</div>");
}
?>

	</body>

</html>