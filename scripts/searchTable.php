<?php
echo("<table class = 'searchTable'>
	<tr class = 'searchHeaders'>
		<td>Image</td>
		<td>Listing Name</td>
		<td>Category</td>
		<td>Description</td>
		<td>Artist</td>
	</tr>");
		while ($row = mysql_fetch_assoc($result))
		{
			echo("<tr class = 'searchContainers'>");
			foreach($row as $field => $value)
			{
				//Echos listing image
				if ($field == 'listingImage')
				{
					echo("<td><a href='viewListing.php?listingID=$listingID'><img src='$value' height='125px' width='150px' alt='listingImage' class='userImage'></a></td>");
				}
				//Echos 'click to view listing'
				elseif($field == 'listingID')
				{
					$listingID = $value;
				}
				elseif($field == 'listingName')
				{
					echo("<td class = 'searchResult'><a href='viewListing.php?listingID=$listingID'>$value</a></td>");
				}
				elseif($field == 'userName')
				{
					echo("<td class = 'searchResult'><a href='portfolio.php?userName=$value'>$value</a></td>");
				}
				else
				{
					echo("<td class = 'searchResult'>");
					if(strlen($value) > 100)
					{
						$strValue = substr($value, 0, 100) . "...";
						echo("$strValue");
					}
					else
					{
						echo("$value");
					}
					echo("</td>");
				}
			}
			echo("</tr>");
		}
	echo("</table>");
?>
