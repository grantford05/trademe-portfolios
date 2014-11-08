
<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Edit Listing | Trade Me Portfolios</title>
		<link rel = "stylesheet" href="/styles/searchStyle.css"/>
		<link rel = "stylesheet" href="/styles/mainStyle.css"/>
		<link rel = "stylesheet" href="/styles/buttons.css"/>

	</head>

	<body>

<!-- Users can use this page to select a listing, then edit them
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

	//check to see if the submit button has been clicked
	if (isset($_POST['editListing']))
	{
		//if submit button clicked run the submit function
		editListingSubmit();
		//assign the selected listing name to the session
		$_SESSION['listingName'] = mysql_real_escape_string(strip_tags($_POST['listingName']));
	}
	//check to see if the delete button has been clicked
	elseif (isset($_POST['deleteListing']))
	{
		//if delete button clicked then run the delete function
		editListingDelete();
	}
	//check to see if the choose listing button has been clicked
	elseif (isset($_POST['chooseListing']))
	{
		//if edit listing button clicked then run the form function
		editListingForm();
	}
	else
	{
		//run the form with drop down box for user to select a listing to edit
		chooseListing();
	}
}
		
	//function used to create drop down box with the names of a users listings	
	function chooseListing()
	{
		$self = htmlentities($_SERVER['PHP_SELF']);
		echo("<h3>Choose a listing to edit</h3>");
		echo("<form action = '$self' method = 'POST'>");

		//get the logged in user username and assign to variable
		$userName = $_SESSION['userName'];

		//query to get userID
		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		//query to get users listing names
		$selectString = "SELECT listingName FROM tblListing WHERE userID = '$userID' ORDER BY listingName ";
		$result = mysql_query($selectString);

		//create the drop down bocx where the user will select their listing from
		echo("<select name = 'listingName' id = 'inputDropDown'>");
			while($row  = mysql_fetch_row($result))
			{
				echo("<option value = \"".htmlspecialchars($row[0])."\">$row[0]</option>");
			}
		echo("</select><br><br>");

		echo("<input type='submit' class = 'uploadButton' name='chooseListing' value = 'Edit Listing'>");
		echo("</form>");
	}

	//function used to display the edit listing form
	function editListingForm()
	{
		$self = htmlentities($_SERVER['PHP_SELF']);

		echo("<h3>Make your changes to the listing</h3>");

		echo("<form action = '$self' method='POST'>");

		//assign the listingName to a variable
		$listingNumber = mysql_real_escape_string(strip_tags($_POST['listingName']));

		//query to get the category names to create drop down box
		$selectQuery = "SELECT categoryname FROM tblCategories ORDER BY categoryname";
		$selectResult = mysql_query($selectQuery);

		//get the logged in users username and assign it to a variable
		$userName = $_SESSION['userName'];

		//query to fetch all the information for the slected listing
		$queryString = "SELECT listingID, listingName, category, listingInfo FROM tblListing JOIN tblUser ON (tblListing.userID = tblUser.userID) WHERE tblListing.listingName = '$listingNumber' && tblUser.userName = '$userName'";
		$result = mysql_query($queryString);

		//run through the returned data and display it to the screen in textboxes on a form
		while($edits = mysql_fetch_assoc($result))
		{
			foreach($edits as $field => $value)
			{
				if($field == 'listingName')
				{
					echo("<label for='$field'>Listing Name</label><br>");
					echo("<textarea id = 'smallTextAreas' required name='$field' />$value</textarea><br>");
				}
				elseif($field == 'category')
				{
					$default_state = "$value";
					echo("<label for='$field'>Category</label><br>");
					echo("<select name = 'category' id = 'inputDropDown'>");
					while($row  = mysql_fetch_row($selectResult))
					{
						if($row[0] != $value)
						{
							echo("<option value = '$row[0]'>$row[0]</option>");
						}
						else
						{								
							echo("<option value = '$default_state' selected='selected'>$default_state</option>");
						}
					}
					echo("</select><br><br>");
				}
				elseif($field == 'listingID')
				{
					echo("<input type='hidden' name='$field' value='$value'/>");
				}
				elseif($field == 'listingInfo')
				{
					echo("<label for='$field'>Listing Information</label><br>");
					echo("<textarea name='$field' id = 'inputTextArea' />$value</textarea><br>");
				}
			}
		}
		
		echo("<div id = 'listingButtons'");
			echo("<br><input type='submit' class = 'uploadButton' name='editListing' value = 'Confirm Edit'>");
			echo("<input type='submit' class = 'deleteButton' name='deleteListing' value = 'Delete Listing'>");
		echo("</div>");

		echo("</form>");
	}

	//function used to submit the details to the database
	function editListingSubmit()
	{
		//get the logged in users username and assign it to a variable
		$userName = $_SESSION['userName'];

		//query to get userID
		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		$listingID = mysql_real_escape_string(strip_tags($_POST['listingID']));
		$listingName = mysql_real_escape_string(strip_tags($_POST['listingName']));
		$category = mysql_real_escape_string(strip_tags($_POST['category']));
		$listingInfo = mysql_real_escape_string(strip_tags($_POST['listingInfo']));

		//update the listing details in the database
		$updateString = "UPDATE tblListing SET listingName = '$listingName', category = '$category', 
		listingInfo = '$listingInfo' WHERE listingID = '$listingID' && userID = '$userID'";

		$result = mysql_query($updateString);

		//give the user feedback on successful edits
		echo("<h3>Changes submitted</h3>");
		echo("Your changes to this listing have been saved. Would you like to view this listing, or return to <a href='workHome.php'>your portfolio?</a>");

	}

	function editListingDelete()
	{
		//assign listingID to a variable
		$listingID = ($_POST['listingID']);

		//delete the chosen listing from the database
		$deleteString = "DELETE FROM tblListing WHERE listingID = '$listingID'";
		$result = mysql_query($deleteString);

		//give the user feedback on successful deletion
		echo("<h3>Listing Deleted</h3>");
		echo("Your listing has been deleted. Would you like to return to <a href='workHome.php'>your portfolio's home</a> or your <a href='account.php'>account?</a>");
	}

?>

			</div>

	</div>
	</body>

</html>