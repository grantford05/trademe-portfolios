<!-- Used to upload the images to the server
   Authors: Grant Ford and Lucas Mills
   Project: Trade Me Portfolios
   Date: 28/10/2014 -->
   
<?php
  //declare the allowed extensions in an array
  $allowedExts = array("gif", "jpeg", "jpg", "png", "x-png", "pjpeg");
  //break the file name up into parts
  $temp = explode(".", $_FILES["image"]["name"]);
  //assign extension string to variable
  $extString = end($temp);
  //convert extension to lowercase
  $extension = strtolower($extString);
  //declare characters used to create random filename
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    //iterate through 10 times and assign random character each time to the random string to create filename
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

  //declare the target that the image will be saved to
  $target = "images/" . $randomString . "." . $extension;

  //check that everything for the file is correct
  if ((($_FILES["image"]["type"] == "image/gif")
  || ($_FILES["image"]["type"] == "image/jpeg")
  || ($_FILES["image"]["type"] == "image/jpg")
  || ($_FILES["image"]["type"] == "image/pjpeg")
  || ($_FILES["image"]["type"] == "image/x-png")
  || ($_FILES["image"]["type"] == "image/png"))
  && ($_FILES["image"]["size"] < 10000000)
  && in_array($extension, $allowedExts)) {

      if ($_FILES["image"]["error"] > 0) {
        //return error code if something is wrong with file
        echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
      } 

      if (file_exists($target)) {
        //let the user know if a file already exists
        echo $randFileName . " already exists. ";
      } else {
        //move the file to the correct destination on the server
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
      }
    
  } 
?>