<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>My Portfolio | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/myWorkStyle.css"/>
		<link rel = "stylesheet" href="/styles/buttons.css"/>
		<link rel = "stylesheet" href="/styles/forms.css"/>
		<script type="text/javascript" src="scripts/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="scripts/formChecking.js"></script>

	</head>

	<body>

<!-- Page for users to upload their work, and choose to edit existing work
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
		//display the links for all the options the user has on their my portfolio page
		echo("<div id = 'container'>

			<div id = 'leftContent'>

				<h3>My Portfolio</h3>

				<a href='portfolio.php?userName=$userName'>View My Portfolio</a><br><br>
				<a href='editListing.php'>Edit My Work</a>

			</div>

			<div id = 'rightContent'>

				<h3>Upload New Work</h3>");


			//check to see if submit button has been clicked
			if (isset($_POST['uploadWork']))
			{
				//if submit has been clicked then run the submit function
				listingSubmit();
			}
			else
			{
				//if not clicked then run the form function
				uploadListing();
			}
}

			//function used to display the form for the user to upload their work on. Give live feedback where needed
			function uploadListing()
			{
				$self = htmlentities($_SERVER['PHP_SELF']);
		
				echo("<form action = '$self' method='POST' enctype='multipart/form-data'>

					<div id = 'formMargin'>

					<input type='text' name='listingName' title='Must be unique to other listings on your portfolio' placeholder='Listing Name' id='listingName' required><span id='listingName-result'></span><br><br>");

					//query to get the category names from the database to create a drop down box
					$selectQuery = "SELECT categoryname FROM tblCategories ORDER BY categoryname";
					$result = mysql_query($selectQuery);

					//create the drop down box with the values gathered from the database
					echo("<select name = 'category' id = 'inputDropDown'>");
						while($row  = mysql_fetch_row($result))
						{
							echo("<option value = '$row[0]'>$row[0]</option>");
						}
					echo("</select><br><br>

					<label for='image'>Image:</label><br>
					<input type='file' name='image' title='File type must be jpg, jpeg, png, gif, pjpeg or x-png. File size less than 10mb' id='image' required>
					<span id='image-result'></span><br><br><br>

					<textarea rows='4' cols='50' name='listingInfo' id = 'inputTextArea' placeholder='Listing Description' required ></textarea><br><br>

					</div>

					<input type='submit' id = 'uploadButton' name='uploadWork' value = 'Upload Work' disabled>

				</form>");
			}

			//function used to upload the listing to the database
			function listingSubmit()
			{
				//run the image upload file to upload the listings image
				include 'imageUpload.php';

				//fetch the users username form the session
				$userName = $_SESSION['userName'];

				//query to get the userID for the user
				$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
				$ID = mysql_query($getUserID);

				while($row = mysql_fetch_array($ID))
				{
					$userID = $row[0];
				}

				//assign the users input into variables
				$listingName = mysql_real_escape_string(strip_tags($_POST['listingName']));
				$category = mysql_real_escape_string(strip_tags($_POST['category']));
				$listingInfo = mysql_real_escape_string(strip_tags($_POST['listingInfo']));
				$image = mysql_real_escape_string(strip_tags($target));

				//query to upload the listing to the datbase with the given information
				$insertQuery="INSERT INTO tblListing (userID, listingName, category, listingInfo, listingDate, listingImage)
					VALUES('$userID', '$listingName', '$category', '$listingInfo', NOW(), '$image')";
				$result = mysql_query($insertQuery);

				//display feedback to the user about successfully uploading a listing
				echo("<br>Cool, you're work has been uploaded to your portfolio!<br><br>
					Would you like to <a href='portfolio.php?userName=$userName'>view your portfolio</a>, or maybe upload <a href='workHome.php'>another?</a>");
			}

?>

			</div>

	</div>

	</body>

</html>