 <?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>
		<link rel = "stylesheet" href="../styles/myWorkStyle.css"/>
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

				<h3>My Portfolio</h3>

				<a href='myPortfolio.php'>View My Portfolio</a><br><br>
				<a href='editListing.php'>Edit My Work</a>
				<p>Edit My Portfolio</p>
				<p>More..</p>

			</div>

			<div id = 'rightContent'>

				<h3>Upload New Work</h3>");


			if (isset($_POST['uploadWork']))
			{
				listingSubmit();
			}
			else
			{
				uploadListing();
			}
}

			function uploadListing()
			{
				$self = htmlentities($_SERVER['PHP_SELF']);
		
				echo("<form action = '$self' method='POST' enctype='multipart/form-data'>

					<div id = 'formMargin'>

					<input type='text' name='listingName' placeholder='Listing Name' id='inputBox' required><br><br>");

					$selectQuery = "SELECT categoryname FROM tblCategories ORDER BY categoryname";
					$result = mysql_query($selectQuery);

					echo("<select name = 'category' id = 'inputDropDown'>");
						while($row  = mysql_fetch_row($result))
						{
							echo("<option value = '$row[0]'>$row[0]</option>");
						}
					echo("</select><br><br>

					<label for='image'>Image:</label><br>
					<input type='file' name='image' id='image'><br><br><br>

					<input type='text' name='price' placeholder='Price' id='inputBox' required><br><br>

					<textarea rows='4' cols='50' name='listingInfo' id = 'inputTextArea' placeholder='Listing Bio (150 characters max)' required ></textarea><br><br>

					</div>

					<input type='submit' class = 'uploadButton' name='uploadWork' value = 'Upload Work'>

				</form>");
			}

			function listingSubmit()
			{
				include 'imageUpload.php';
				$userName = $_SESSION['userName'];
				$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
				$ID = mysql_query($getUserID);

				while($row = mysql_fetch_array($ID))
				{
					$userID = $row[0];
				}

				$listingName = mysql_real_escape_string(strip_tags($_POST['listingName']));
				$category = mysql_real_escape_string(strip_tags($_POST['category']));
				$price = mysql_real_escape_string(strip_tags($_POST['price']));
				$listingInfo = mysql_real_escape_string(strip_tags($_POST['listingInfo']));
				$image = mysql_real_escape_string(strip_tags($target));

				$insertQuery="INSERT INTO tblListing (userID, listingName, category, price, listingInfo, listingImage)
					VALUES('$userID', '$listingName', '$category', '$price', '$listingInfo', '$image')";
				$result = mysql_query($insertQuery);


				echo("<br>Cool, you're work has been uploaded to your portfolio!<br><br>
					Would you like to <a href='myPortfolio.php'>view your portfolio</a>, or maybe upload another?");
			}

?>

			</div>

	</div>

	</body>

</html>