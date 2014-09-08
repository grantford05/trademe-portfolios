
<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>
		<link rel = "stylesheet" href="../styles/buttons.css"/>

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
	echo("<div id='container'>");
	echo("<div id='singleContent'>");

	if (isset($_POST['confirmChanges']))
	{
		submitProfilePicEdit();
	}
	else
	{
		changeProfilePicForm();
	}
}
			
	function changeProfilePicForm()
	{

		$self = htmlentities($_SERVER['PHP_SELF']);


		echo("<h3>Select an image to upload as your profile image</h3>");

		echo("<form action = '$self' method='POST' enctype='multipart/form-data'>");

		echo("<label for='image'>Image:</label><br>
		<input type='file' name='image' id='image'><br><br><br>");

		echo("<br><input type='submit' class = 'uploadButton' name='confirmChanges' value = 'Confirm Edit'>");
		echo("</form>");
	}

	function submitProfilePicEdit()
	{
		include 'profileImageUpload.php';

		$userName = $_SESSION['userName'];


		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		$userImage = mysql_real_escape_string(strip_tags($target));


		$updateString = "UPDATE tblUser SET userImage = '$userImage' WHERE userID = '$userID'";

		$result = mysql_query($updateString);

		echo("<h3>Profile Picture Added</h3>");

		echo("Your profile picture has been added to your portfolio. Go to your <a href='myPortfolio.php'>Portfolio</a> to view");
	}

?>
</div>
</div>


	</body>

</html>