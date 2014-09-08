<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/resultsStyle.css"/>
		<link rel = "stylesheet" href="../styles/mainStyle.css"/>
		<link rel = "stylesheet" href="../styles/buttons.css"/>		

	</head>

	<body>

<?php
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php

		echo("<div id = 'browseContainer'>

			<div id = 'browse'>
			<div id = 'browseBorder'>
			<h3>Browse</h3>
			<p>Want to refine your search? Browse below.</p>");

			$self = htmlentities($_SERVER['PHP_SELF']);
		
				echo("<form action = '$self' method='POST'>

					<p>I am looking for a 

					<select name = 'listingType' id = 'smallDropDown'>
						<option value = 'tblListing'>Listing</option>
					</select>

					under the category ");

					$selectQuery = "SELECT categoryname FROM tblCategories ORDER BY categoryname";
					$result = mysql_query($selectQuery);

					echo("<select name = 'categoryType' id = 'smallDropDown'>
						<option value = 'all'>All Art Categories</option>");
						while($row  = mysql_fetch_row($result))
						{
							echo("<option value = '$row[0]'>$row[0]</option>");
						}

					echo("</select> sorted by  

						<select name = 'listingOrder' id = 'smallDropDown'>
							<option value = 'ASC'>Ascending</option>
							<option value = 'DESC'>Descending</option>
							<option value = 'DATE'>Date Created</option>
						</select>

					</p>

					<div id = 'browseButton'>

						<input type='submit' class = 'uploadButton' name='refreshSearch' value = 'Browse'>

					</div>
					</div>

				</form>");

				if(isset($_POST['refreshSearch']))
				{
					browse();
				}


				function browse()
				{
					$listingType = $_POST['listingType'];
					$categoryType = $_POST['categoryType'];
					$listingOrder = $_POST['listingOrder'];

					if($categoryType == 'all')
					{
						$selectString = "SELECT listingImage, listingName, category, price, listingID FROM $listingType 
						ORDER BY listingID $listingOrder";
						$result = mysql_query($selectString);
					}
					else
					{
						$selectString = "SELECT listingImage, listingName, category, price, listingID FROM $listingType 
						WHERE category = '$categoryType' ORDER BY listingID $listingOrder";
						$result = mysql_query($selectString);	
					}

					if(mysql_num_rows($result)==0)
					{
							echo("<div id = 'emptySearch'>
								<br>No results found. :(
							</div>");
					}
					else
					{
						echo("<table id = 'searchTable'>");

							while ($row = mysql_fetch_assoc($result))
							{
								echo("<tr>");
								echo("<tr id = 'searchContainers'>");
								foreach($row as $field => $value)
								{
									if ($field == 'listingImage')
									{
										echo("<td><img src='$value' height='125px' width='150px' alt='listingImage' id='listingImage'></td>");
									}
									elseif($field == 'listingID')
									{						
										echo("<td id = 'searchResult'><a href='viewListing.php?listingID=$value'>Click to view listing</a></td>");
									}
									elseif($field == 'price')
									{
										echo("<td id = 'searchResult'>$$value</td>");
									}
									else
									{
										echo("<td id = 'searchResult'>$value</td>");
									}
								}
								echo("</div>");
								echo("</tr>");
							}

						echo("</table>");
					}
				}

?>

			</div>

	</div>

	</body>

</html>