<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

	<title>Account | Trade Me Portfolios</title>

		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/accountStyle.css"/>
		<link rel = "stylesheet" href="/styles/buttons.css"/>
		<link rel = "stylesheet" href="/styles/forms.css"/>

		<script type="text/javascript" src="scripts/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="scripts/formChecking.js"></script>
		<script type="text/javascript" src="scripts/tooltips.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

	</head>

	<body>

<!-- Users account page that displays their details, and gives links to pages to edit them
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 -->

<?php 
	//include the files to connect to database, display the navbar, and check login
	include 'searchBar.php'; 
	include 'connect.inc.php';
	include 'checkLogin.php';
?>

<?php
//checks if user is logged in then displays appropriate content. if they are not logged in then checkLogin.php runs
if(isset($_SESSION['userName']))
{

	echo("<div id = 'container'>

		<div id = 'leftContent'>");
	
			//display the links for all the options the user has on the account page
			echo("<h3>Account Management</h3>
			<a href='editAccount.php'>Edit My Details</a><br><br>
			<a href='changePassword.php'>Change My Password</a><br><br>
			<a href='profilePicture.php'>Add Profile Picture</a><br><br>
			<a href='logout.php'>Logout</a> 

		</div>

		<div id = 'rightContent'>

			<h3>$userName's Account</h3>");
			
			//sql squery to get all the logged in users information from the database
			$getUserDetails = "SELECT * FROM tblUser WHERE tblUser.userName = '$userName'";
			$result = mysql_query($getUserDetails);

			while($row = mysql_fetch_array($result))
			{
				$userID = $row[0];
				$username = $row[1];
				$firstName = $row[2];
				$lastName = $row[3];
				$userImage = $row[4];
				$email = $row[5];
				$bio = $row[7];
				$userAddress = $row[8];
				$phone = $row[9];
				$profileViews = $row[11];
			}

			mysql_free_result($result);

			//sql query to get view count from the users listing table
			$result = mysql_query("SELECT * FROM tblListing JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblUser.userName = '$userName'");
			$listingCount = mysql_num_rows($result);

			//display the users information on the screen
			echo("<div id = 'accountDetails'>
				<h4>Details for $firstName $lastName:</h4>
				Bio: $bio <br>
				Email: $email <br>
				Address: $userAddress <br>
				Phone: $phone <br><br>

				<h4>Portfolio Statistics:</h4>
				Number of Listings: $listingCount <br>
				Portfolio Views: $profileViews <br>
			</div>");


		echo("</div>



		</div>

	</div>");
}
?>

	</body>

</html>