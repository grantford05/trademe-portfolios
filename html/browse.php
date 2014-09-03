<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>

	</head>

	<body>

<?php
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php

		echo("<div id = 'container'>

			<h3>Browse</h3><br>");

			$self = htmlentities($_SERVER['PHP_SELF']);
		
				echo("<form action = '$self' method='POST'>

					<p>I am looking for a 

					<select name = 'listingType'>
						<option value = 'tblUser'>User</option>
						<option value = 'tblListing'>Listing</option>
						<option value = 'tblGallery'>Gallery</option>
					</select>

					under the category ");

					$selectQuery = "SELECT categoryname FROM tblCategories ORDER BY categoryname";
					$result = mysql_query($selectQuery);

					echo("<select name = 'categoryType'>
						<option value = 'all'>All Art Categories</option>");
						while($row  = mysql_fetch_row($result))
						{
							echo("<option value = '$row[0]'>$row[0]</option>");
						}

					echo("</select> sorted by ____ </p>

					<input type='submit' name='refreshSearch' value = 'Search'>

				</form>");

				if(isset($_POST['refreshSearch']))
				{
					browse();
				}


				function browse()
				{
					$listingType = $_POST['listingType'];
					$categoryType = $_POST['categoryType'];

					$selectString = "SELECT * FROM $listingType WHERE category = $categoryType";
					$result = mysql_query($selectString);

					echo("<table>");

						while ($row = mysql_fetch_assoc($result))
						{
							echo("<tr>");
							foreach($row as $field => $value)
							{
								if(($field != 'userID') && ($field != 'listingID'))
								{
									echo("<td>$value</td>");
								}
								else
								{
									echo("<input type='hidden' name='$field' value='$value'");
								}
							}
							echo("</tr>");
						}

					echo("</table>");
		
					mysql_free_result($result);
				}

?>

			</div>

	</div>

	</body>

</html>