<?php
  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES["image"]["name"]);
  $extension = end($temp);
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
  $target = "../images/" . $randomString . "." . $extension;

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

      if (file_exists($target)) {
        echo $randFileName . " already exists. ";
      } else {
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
        echo("$target");
      }
    
  } else {
    echo "Invalid file";
  }
?>