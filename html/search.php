<?php
	session_start();
?>
<!DOCTYPE html>

<html>

	<head>

		<link rel = "stylesheet" href="../styles/searchStyle.css"/>
		<link rel = "stylesheet" href="../styles/resultsStyle.css"/>

	</head>

	<body>

<?php
	include 'searchBar.php'; 
	include 'connect.inc.php';
?>

<?php

$searchValue = (strip_tags($_POST['searchValue']));
echo("<div id = 'container'>");

if(!empty($searchValue))
{
		$selectString = "SELECT listingImage, listingName, category, listingInfo, listingID  FROM tblListing WHERE listingName LIKE '%$searchValue%' 
						OR category LIKE '%$searchValue%' OR listingInfo LIKE '%$searchValue%'";
		$result = mysql_query($selectString);
		if(mysql_num_rows($result)==0)
		{
				echo("<div id = 'emptySearch'>
					No results found. :(
				</div>");
		}
		else
		{
			echo("<h3>Search Results:</h3><br><br>
			<table id = 'searchTable'>");
				while ($row = mysql_fetch_assoc($result))
				{
					echo("<tr id = 'searchContainers'>");
					foreach($row as $field => $value)
					{
						if ($field == 'listingImage')
						{
							echo("<td><img src='../images/art.jpg' height='125px' width='150px' alt='userImage' id='userImage'></td>");
						}
						elseif($field == 'listingID')
						{
							echo("<td id = 'searchResult'><a href='viewListing.php?listingID=$value'>Click to view listing</a></td>");
						}
						else
						{
							echo("<td id = 'searchResult'>$value</td>");
						}
					}
					echo("</tr>");
				}
			echo("</table>");

			mysql_free_result($result);
		}


}
else
{
		echo("<div id = 'emptySearch'>
			Oops, It looks like you didn't actually search for anything. :(
		</div>");
}

?>

			</div>

		</div>

	</body>

</html>