
<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Edit Account | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/buttons.css"/>
		<script type="text/javascript" src="scripts/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="scripts/formChecking.js"></script>

	</head>

	<body>

<!-- Users can use this page to edit their account details
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

	//checks if the submit button has been clicked
	if (isset($_POST['confirmChanges']))
	{
		//if button has been clicked, run the submit details function
		submitDetailsEdit();
	}
	else
	{
		//if button has not been clicked show the user the edit details form
		changeDetailsForm();
	}
}
			
	//function that displays the edit details form to the user
	function changeDetailsForm()
	{

		$self = htmlentities($_SERVER['PHP_SELF']);


		echo("<h3>Make changes to your details</h3>");

		echo("<form action = '$self' method='POST'>");

		//get the logged in users username and assign it to a variable
		$userName = $_SESSION['userName'];

		//fetch all the users information from the database 
		$queryString = "SELECT firstName, lastName, email, bio, userAddress, phone FROM tblUser WHERE tblUser.userName = '$userName'";
		$result = mysql_query($queryString);

		//run through the returned data and display it to the screen in textboxes on a form
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
					echo("<textarea name='$field' id = 'email' />$value</textarea><br>");
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
					echo("<label for='$field'>Phone</label><br>");
					echo("<textarea id = 'smallTextAreas' name='$field' />$value</textarea><br>");
				}
			}
		}
		echo("<br><input type='submit' class = 'uploadButton' name='confirmChanges' value = 'Confirm Edit'>");
		echo("</form>");
	}

	//function used to get submit the users updated details
	function submitDetailsEdit()
	{
		//fetch the users username form the session
		$userName = $_SESSION['userName'];

		//query to get the userID for the user
		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		//regex used to check the phone number is correct format
		$phoneCheck = "^[ 0-9()-]+$";

		//assign the entered information into appropriate variables
		$firstName = mysql_real_escape_string(strip_tags($_POST['firstName']));
		$lastName = mysql_real_escape_string(strip_tags($_POST['lastName']));
		$email = mysql_real_escape_string(strip_tags($_POST['email']));
		$bio = mysql_real_escape_string(strip_tags($_POST['bio']));
		$userAddress = mysql_real_escape_string(strip_tags($_POST['userAddress']));
		$tempPhone = mysql_real_escape_string(strip_tags($_POST['phone']));

		//check to see if phone matches the regex
		if(preg_match("/$phoneCheck/", $tempPhone))
		{
			//assign to variable to entered into database
			$phone = $tempPhone;
		}
		else
		{
			//asign an empty value to phone
			$phone = "";
		}

		//update the users details in the database
		$updateString = "UPDATE tblUser SET firstName = '$firstName', lastName = '$lastName',
		email = '$email', bio = '$bio', userAddress = '$userAddress', phone = '$phone' WHERE userID = '$userID'";

		$result = mysql_query($updateString);

		echo("<h3>Changes submitted</h3>");

		//give the user feedback on successful edits
		echo("The changes to your details have been saved. Would you like to <a href='portfolio.php?userName=$userName'>view your portfolio</a>, or return to your <a href='account.php'>account?</a>");
	}

?>
</div>
</div>


	</body>

</html>