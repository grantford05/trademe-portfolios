<?php

	$getUserDetails = "SELECT * FROM tblUser WHERE tblUser.userName = '$userName'";
	$user = mysql_query($getUserDetails);

	while($row = mysql_fetch_array($user))
	{
		$userID = $row[0];
		$username = $row[1];
		$firstName = $row[2];
		$lastName = $row[3];
		$image = $row[4];
		$email = $row[5];
		$bio = $row[7];
		$userAddress = $row[8];
		$phone = $row[9];
	}
	
?>