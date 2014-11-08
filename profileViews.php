<!-- Adds one to a profile view count when a portfolio is looked at by a logged in user
     Authors: Grant Ford and Lucas Mills
     Project: Trade Me Portfolios
     Date: 28/10/2014 -->

<?php
//check to see if a logged in user is viewing another users account
if(isset($_SESSION['userName']) && ($_SESSION['userName'] != $userName)
{
	//if they are then add 1 to the profileView count of the user who's profile is being viewed in the database
	$updateQuery = "UPDATE tblUser SET profileViews = profileViews + 1 WHERE tblUser.userName = '$userName'";
	$result = mysql_query($updateQuery);
}
?>