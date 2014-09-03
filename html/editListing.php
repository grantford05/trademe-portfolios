
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

	if (isset($_POST['editListing']))
	{
		editListingSubmit();
		$_SESSION['listingName'] = (strip_tags($_POST['listingName']));
	}
	elseif (isset($_POST['chooseListing']))
	{
		editListingForm();
	}
	else
	{
		chooseListing();
	}
}
			
	function chooseListing()
	{
		$self = htmlentities($_SERVER['PHP_SELF']);
		echo("<h3>Choose a listing to edit</h3>");
		echo("<form action = '$self' method = 'POST'>");

		$userName = $_SESSION['userName'];

		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}


	
		$selectString = "SELECT listingName FROM tblListing WHERE userID = '$userID' ORDER BY listingName ";
		$result = mysql_query($selectString);
		echo("<select name = 'listingName' id = 'inputDropDown'>");
			while($row  = mysql_fetch_row($result))
			{
				echo("<option value = '$row[0]'>$row[0]</option>");
			}
		echo("</select><br><br>");

		echo("<input type='submit' class = 'uploadButton' name='chooseListing' value = 'Edit Chosen Listing'>");
		echo("</form>");
	}


	function editListingForm()
	{
		$self = htmlentities($_SERVER['PHP_SELF']);

		echo("<h3>Make your changes to the listing</h3>");

		echo("<form action = '$self' method='POST'>");

		$listingNumber = $_POST['listingName'];

		$selectQuery = "SELECT categoryname FROM tblCategories ORDER BY categoryname";
		$selectResult = mysql_query($selectQuery);


		$queryString = "SELECT listingID, listingName, category, price, listingInfo FROM tblListing WHERE tblListing.listingName = '$listingNumber'";
		$result = mysql_query($queryString);

		while($edits = mysql_fetch_assoc($result))
		{
			foreach($edits as $field => $value)
			{
				if($field == 'listingName')
				{
					echo("<label for='$field'>Listing Name</label><br>");
					echo("<textarea id = 'smallTextAreas' name='$field' />$value</textarea><br>");
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
				elseif($field == 'price')
				{
					echo("<label for='$field'>Price</label><br>");
					echo("<textarea name='$field' id = 'smallTextAreas' />$value</textarea><br>");
				}
				elseif($field == 'listingInfo')
				{
					echo("<label for='$field'>Listing Information</label><br>");
					echo("<textarea name='$field' id = 'inputTextArea' />$value</textarea><br>");
				}
			}
		}
		

		echo("<br><input type='submit' class = 'uploadButton' name='editListing' value = 'Confirm Edit'>");

		echo("</form>");
	}

	function editListingSubmit()
	{
		$userName = $_SESSION['userName'];

		$getUserID = "SELECT userID FROM tblUser WHERE tblUser.userName = '$userName'";
		$ID = mysql_query($getUserID);
		while($row = mysql_fetch_array($ID))
		{
			$userID = $row[0];
		}

		$listingID = mysql_real_escape_string(strip_tags($_POST['listingID']));
		$listingName = mysql_real_escape_string(strip_tags($_POST['listingName']));
		$category = mysql_real_escape_string(strip_tags($_POST['category']));
		$price = mysql_real_escape_string(strip_tags($_POST['price']));
		$listingInfo = mysql_real_escape_string(strip_tags($_POST['listingInfo']));

		$updateString = "UPDATE tblListing SET listingName = '$listingName', category = '$category',
		price = '$price', listingInfo = '$listingInfo' WHERE listingID = '$listingID' && userID = '$userID'";

		$result = mysql_query($updateString);

		echo("<h3>Changes submitted</h3>");
		echo("Your changes to this listing have been saved");

	}

?>

			</div>

	</div>
	</body>

</html>