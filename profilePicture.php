
<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Profile Picture | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/buttons.css"/>
		<script type="text/javascript" src="scripts/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="scripts/formChecking.js"></script>
	</head>

	<body>

<!-- Users can select a profile picutre to upload, and use on their portfolio
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
	echo("<div id='container'>");
	echo("<div id='singleContent'>");

	//check to see if submit button has been clicked
	if (isset($_POST['confirmChanges']))
	{
		//if submit button clicked then run picture submit function
		submitProfilePicEdit();
	}
	else
	{
		//if not clicked then run the form for user to upload a profile pic
		changeProfilePicForm();
	}
}

	//function that displays the form where a user can choose a profile pic to upload			
	function changeProfilePicForm()
	{

		$self = htmlentities($_SERVER['PHP_SELF']);

		//display the form to allow user to upload profile pic
		echo("<h3>Select an image to upload as your profile image</h3>");

		echo("<form action = '$self' method='POST' enctype='multipart/form-data'>");

		echo("<label for='image'>Image:</label><br>
		<input type='file' name='image' id='profileImage' title='File type must be jpg, jpeg, png, gif, pjpeg or x-png. File size less than 10mb'>
		<span id='image-result'></span><br><br><br>");

		echo("<br><input type='submit' id = 'uploadButton' name='confirmChanges' value = 'Confirm Edit' disabled>");
		echo("</form>");
	}

	//function that uploads the profile picture to the server
	function submitProfilePicEdit()
	{	
		//include the file that uploads the pic to the server
		include 'profileImageUpload.php';

		//get the logged in users username and assign it to a variable
		$userName = $_SESSION['userName'];

		//query to get the userID for the user
		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		//give the image filename and path to a variable
		$userImage = mysql_real_escape_string(strip_tags($target));

		//update the user table to include the new profile picture
		$updateString = "UPDATE tblUser SET userImage = '$userImage' WHERE userID = '$userID'";

		$result = mysql_query($updateString);

		//display feedback to the user
		echo("<h3>Profile Picture Added</h3>");

		echo("Your profile picture has been added to your portfolio. Go to your <a href='portfolio.php?userName=$userName'>Portfolio</a> to view");
	}

?>
</div>
</div>


	</body>

</html>