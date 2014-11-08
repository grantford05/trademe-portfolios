<?php
if($_SESSION['userName'] != $userName)
{
	$updateQuery = "UPDATE tblUser SET profileViews = profileViews + 1 WHERE tblUser.userName = '$userName'";
	$result = mysql_query($updateQuery);
}
?>