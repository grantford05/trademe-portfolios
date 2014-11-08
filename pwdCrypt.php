<!-- Used for password encryption
   Authors: Grant Ford and Lucas Mills
   Project: Trade Me Portfolios
   Date: 28/10/2014 -->

<?php
  //function used to encrypt the passwords
  function pwdCrypt($input, $rounds = 7)
  {
    //create a randomly generated salt to be added in front of the encrypted password
    $salt = "";
    $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 22; $i++) {
      $salt .= $salt_chars[array_rand($salt_chars)];
    }
    //encrypt the password and add the salt to it
    return crypt($input, sprintf('$2y$%02d$', $rounds).$salt);
  }
?>