<?php

$getGalleryName = "SELECT galleryID, galleryName FROM tblGallery WHERE tblGallery.galleryID = tblUser.userGallery";
$gallery = mysql_query($getGalleryName);

while($galleryRow = mysql_fetch_array($gallery))
			{
				$galleryID = $galleryRow[0];
				$galleryName = $galleryRow[1];
			}

?>