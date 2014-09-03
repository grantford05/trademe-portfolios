<?php
  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES["image"]["name"]);
  $extension = end($temp);

  if ((($_FILES["image"]["type"] == "image/gif")
  || ($_FILES["image"]["type"] == "image/jpeg")
  || ($_FILES["image"]["type"] == "image/jpg")
  || ($_FILES["image"]["type"] == "image/pjpeg")
  || ($_FILES["image"]["type"] == "image/x-png")
  || ($_FILES["image"]["type"] == "image/png"))
  && ($_FILES["image"]["size"] < 2000000)
  && in_array($extension, $allowedExts)) {
    if ($_FILES["image"]["error"] > 0) {
      echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
    } 

    if (file_exists("../images/" . $_FILES["image"]["name"])) {
      echo $_FILES["image"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["image"]["tmp_name"],
      "../images/" . $_FILES["image"]["name"]);
    }
    
  } else {
    echo "Invalid file";
  }
?>