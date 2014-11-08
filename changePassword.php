<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Change Password | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/buttons.css"/>
		<script type="text/javascript" src="scripts/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="scripts/formChecking.js"></script>

	</head>

	<body>

<!-- Users can use this page to change their password
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

	if (isset($_POST['confirmChanges']))
	{
		submitPasswordEdit();
	}
	else
	{
		changePasswordForm();
	}
}
	//include the file that contains the method to encrypt the password		
	include 'pwdCrypt.php';	 
	//function that displays the change password form to the screen
	function changePasswordForm()
	{

		$self = htmlentities($_SERVER['PHP_SELF']);


		echo("<h3>Make changes to your details</h3>");

		//display the form that the user will use to change their password
		echo("<form action = '$self' method='POST'>");
			echo("<input type='password' name='oldPassword' id = 'inputBox' placeholder='Current Password'><br><br>");
			echo("<input type='password' name='newPassword1' title='Minimum 8 characters.' id = 'password' placeholder='New Password'required pattern = \"^.{7,}$\">
				<span id='password-result'></span><br><br>");
			echo("<input type='password' name='newPassword2' title='Minimum 8 characters.' id = 'password2' placeholder='Confirm New Password'required pattern = \"^.{7,}$\">
				<span id='password2-result'></span><br><br>");
		echo("<br><input type='submit' class = 'uploadButton' name='confirmChanges' value = 'Confirm Change'>");
		echo("</form>");
	}

	//function that runs after the form is submitted. 
	function submitPasswordEdit()
	{
		//get the username and current password from the session
		$userName = $_SESSION['userName'];
		$password_hash = $_SESSION['password'];
		//read the values from the password text boxes with strip tags etc. to prevent SQL injection
		$oldPassword = mysql_real_escape_string(strip_tags($_POST['oldPassword']));
		$newPassword1 = mysql_real_escape_string(strip_tags($_POST['newPassword1']));
		$newPassword2 = mysql_real_escape_string(strip_tags($_POST['newPassword2']));

		//check to see if the current password entered matches the one stored in the database
		//runs password through crypt function to check that they match
		if(crypt($oldPassword, $password_hash) == $password_hash)
		{
			$oldPassword = $password_hash;
		}

		//get userID from the database and assign it to variable
		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		//check to see if the passwords match correctly
		if(($password_hash == $oldPassword) && ($newPassword1 == $newPassword2))
		{
			//if they are a match then the new password is passed to the pwdCrypt function to be encrypted
			$newPassword = pwdCrypt($newPassword1);
			//update the database with the new password
			$updateString = "UPDATE tblUser SET password = '$newPassword' WHERE userID = '$userID'";
			$result = mysql_query($updateString);
			//set the session password to match the new password so the user stays ;pgged in
			$_SESSION['password'] = $newPassword;
			//give feedback to the user telling them that they're successful
			echo("<h3>Password submitted</h3>");
			echo("Your new password has been saved. Return to <a href='account.php'>your account</a>");
		}
		else
		{
			//if a set of passwords don't match, then check through to find which one doesn;t match and give appropriate feedback
			if(($password_hash != $oldPassword) && ($newPassword1 == $newPassword2))
			{
				echo("Your old password was incorrect, Please try again");
			}
			elseif(($password_hash == $oldPassword) && ($newPassword1 != $newPassword2))
			{
				echo("Your new password's do not match. Please try again");
			}
			elseif(($password_hash != $oldPassword) && ($newPassword1 != $newPassword2))
			{
				echo("Neither of your passwords were entered correctly. Please try again");
			}
			$self = htmlentities($_SERVER['PHP_SELF']);


			echo("<h3>Make changes to your details</h3>");
			//display the form that the user will use to change their password
			echo("<form action = '$self' method='POST'>");
				echo("<input type='password' name='oldPassword' id = 'inputBox' placeholder='Current Password'><br><br>");
				echo("<input type='password' name='newPassword1' title='Minimum 8 characters.' id = 'password' placeholder='New Password'required pattern = \"^.{7,}$\"><br><br>");
				echo("<input type='password' name='newPassword2' title='Minimum 8 characters.' id = 'password' placeholder='Confirm New Password'required pattern = \"^.{7,}$\"><br><br>");
			echo("<br><input type='submit' class = 'uploadButton' name='confirmChanges' value = 'Confirm Change'>");
			echo("</form>");

		}
	}

?>
</div>
</div>


	</body>

</html>