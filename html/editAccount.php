
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
		submitDetailsEdit();
	}
	else
	{
		changeDetailsForm();
	}
}
			
	function changeDetailsForm()
	{

		$self = htmlentities($_SERVER['PHP_SELF']);


		echo("<h3>Make changes to your details</h3>");

		echo("<form action = '$self' method='POST'>");

		$userName = $_SESSION['userName'];


		$queryString = "SELECT firstName, lastName, email, bio, userAddress, phone FROM tblUser WHERE tblUser.userName = '$userName'";
		$result = mysql_query($queryString);

		while($edits = mysql_fetch_assoc($result))
		{
			foreach($edits as $field => $value)
			{
				if($field == 'firstName')
				{
					echo("<label for='$field'>First Name</label><br>");
					echo("<textarea name='$field' id = 'smallTextAreas' />$value</textarea><br>");
				}
				elseif($field == 'lastName')
				{
					echo("<label for='$field'>Last Name</label><br>");
					echo("<textarea name='$field' id = 'smallTextAreas' />$value</textarea><br>");
				}
				elseif($field == 'email')
				{
					echo("<label for='$field'>Email</label><br>");
					echo("<textarea name='$field' id = 'smallTextAreas' />$value</textarea><br>");
				}
				elseif($field == 'bio')
				{
					echo("<label for='$field'>Bio</label><br>");
					echo("<textarea name='$field' id = 'inputTextArea' />$value</textarea><br>");
				}
				elseif($field == 'userAddress')
				{
					echo("<label for='$field'>Address</label><br>");
					echo("<textarea name='$field' id = 'smallTextAreas' />$value</textarea><br>");
				}
				elseif($field == 'phone')
				{
					echo("<label for='$field'>phone</label><br>");
					echo("<textarea id = 'smallTextAreas' name='$field' />$value</textarea><br>");
				}
			}
		}
		echo("<br><input type='submit' class = 'uploadButton' name='confirmChanges' value = 'Confirm Edit'>");
		echo("</form>");
	}

	function submitDetailsEdit()
	{
		$userName = $_SESSION['userName'];

		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		$firstName = mysql_real_escape_string(strip_tags($_POST['firstName']));
		$lastName = mysql_real_escape_string(strip_tags($_POST['lastName']));
		$email = mysql_real_escape_string(strip_tags($_POST['email']));
		$bio = mysql_real_escape_string(strip_tags($_POST['bio']));
		$userAddress = mysql_real_escape_string(strip_tags($_POST['userAddress']));
		$phone = mysql_real_escape_string(strip_tags($_POST['phone']));


		$updateString = "UPDATE tblUser SET firstName = '$firstName', lastName = '$lastName',
		email = '$email', bio = '$bio', userAddress = '$userAddress', phone = '$phone' WHERE userID = '$userID'";

		$result = mysql_query($updateString);

		echo("<h3>Changes submitted</h3>");

		echo("The changes to your details have been saved");
	}

?>
</div>
</div>


	</body>

</html>