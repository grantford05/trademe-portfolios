<!-- Checks if user is logged in. Displays login and register page if they are not logged in.
	 Authors: Grant Ford and Lucas Mills
	 Project: Trade Me Portfolios
	 Date: 28/10/2014 -->
	 
<?php
	//include the file that contains the method to encrypt the password	
	include 'pwdCrypt.php';
	//check to see if user input a username or if the user is already logged in
	if (isset($_POST['userName']))
	{
		//give the entered username to the username variable
		$userName = mysql_real_escape_string(strip_tags($_POST['userName']));
	}
	else if (isset($_SESSION['userName']))
	{
		//if user is already logged in, assign to username variable
		$userName = $_SESSION['userName'];
	}
	//check to see the user entered a password, or if the user is already logged in
	if (isset($_POST['password']))
	{
		//fetch the password from the database 
		$selectQuery = "SELECT password FROM tblUser WHERE (userName = '$userName')";
		$result = mysql_query($selectQuery);
		while($row = mysql_fetch_array($result))
		{
			$password_hash = $row[0];
		}
		//give the entered password to a variable
		$password_entered = mysql_real_escape_string(strip_tags($_POST['password']));

		//check the entered password againt that from the database using the crypt function
		if (crypt($password_entered, $password_hash) == $password_hash)
		{
			//if passwords match the assign it to the password variable
			$password = $password_hash;
		}
	}
	else if (isset($_SESSION['password']))
	{
		//if user is already logged in, assign to password variable
		$password = $_SESSION['password'];
	}

	//check that the user is not already logged in, then display the appropriate content
	if(!isset($userName))
	{
		$self = htmlentities($_SERVER['PHP_SELF']);
		
		echo("<div id = 'container'>

				<div id = 'leftContent'>

					<h2>Login</h2>");

		echo("<form action = '$self' method='POST'>");

			echo("<div id = 'formMargin'>
				  <input type='text' name='userName' id = 'inputBox' placeholder='Username'><br><br>
				  <input type='password' name='password' id = 'inputBox' placeholder='Password'><br><br>
				  </div>
				  <input type='submit' name='login' class='uploadButton' value = 'Login' >");

		echo("</form>
			</div>");

		echo("<div id = 'rightContent'>

			<h2>Sign Up</h2>");

			//check to see if the sign up submit button has been clicked
			if (isset($_POST['signUp']))
			{
				//if sign up button clicked, run the submit function
				signUpSubmit();
			}
			else
			{
				//if button not clicked then run the form function
				signUpForm();
			}

	}
	else
	{
		//query to select user from the database
		$selectQuery = "SELECT * FROM tblUser WHERE (userName = '$userName' && password = '$password')";
		$result = mysql_query($selectQuery);

		//check that query returns a results to see if a users login details were correct
		if(mysql_num_rows($result)>0)
		{
			//assign username and password to the sessions to keep user logged in
			$_SESSION['userName'] = $userName;
			$_SESSION['password'] = $password;
		}
		else
		{
			//display the login form again with feedback on the login failure 
			echo("<div id = 'container'>

				<div id = 'leftContent'>

					<h2>Login</h2>
					Incorrect username and/or password");

				$self = htmlentities($_SERVER['PHP_SELF']);

				echo("<form action = '$self' method='POST'>");

					echo("<div id ='formMargin'>
						  <input type='text' name='userName' id = 'inputBox' placeholder='Username'><br><br>
						  <input type='password' name='password' id = 'inputBox' placeholder='Password'><br><br>

						  </div>
						  <input type='submit' name='login' class='uploadButton' value = 'Login'>");

				echo("</form>
			
				</div>

			<div id = 'rightContent'>

			<h2>Sign Up</h2>");

			//check to see if the sign up submit button has been clicked
			if (isset($_POST['signUp']))
			{
				//if sign up button clicked, run the submit function
				signUpSubmit();
			}
			else
			{
				//if button not clicked then run the form function
				signUpForm();
			}
		}
		mysql_free_result($result);

	}

		//sign up form function that displays the form to the user if they are not logged in
		function signUpForm()
		{
			$self = htmlentities($_SERVER['PHP_SELF']);
			//display the registration form to the user. spans included next to textboxes to display feedback on certain parts of the form
			echo("<form action = '$self' method='POST'>

				<div id = 'formMargin'>

				<input type='text' name='firstName' id = 'inputBox' placeholder='First Name' required><br><br>
					
				<input type='text' name='lastName' id = 'inputBox' placeholder='Last Name' required><br><br>
					
				<input type='email' name='email' id = 'email' class='masterTooltip'  title='Must be unique and correct email format' placeholder='Email' required pattern = \"^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$\">
				<span id='email-result'></span><br><br>
					
				<input type='text' title='Must be unique, 6-16 characters, letters and numbers only.' class='masterTooltip' name='userName' id = 'userName' placeholder='Username' required pattern = \"^[A-Za-z0-9]{5,16}$\"/>
				<span id='user-result'></span><br><br>
					
				<input type='password' name='password' title='Minimum 8 characters.' class='masterTooltip' id = 'password' placeholder='Password' required pattern = \"^.{7,}$\">
				<span id='password-result'></span><br><br>

				</div>

				<input type='submit' name='signUp' id ='uploadButton' value = 'Sign Up'>
			</form>");
		}

		//function that runrs once the sign up submit button has been pushed. Adds user to the database
		function signUpSubmit()
		{
			//assign all the entered values to variables
			$firstName = mysql_real_escape_string(strip_tags($_POST['firstName']));
			$lastName = mysql_real_escape_string(strip_tags($_POST['lastName']));
			$email = mysql_real_escape_string(strip_tags($_POST['email']));
			$userName = mysql_real_escape_string(strip_tags($_POST['userName']));
			$password = mysql_real_escape_string(strip_tags($_POST['password']));
			//run the entered password through the pwdCrypt function to be encrypted
			$password_hash = pwdCrypt($password);

			//give the user a generic placeholder image 
			$userImage = '/images/defaultUser.jpg';
			//query to add the user to the database
			$insertQuery="INSERT INTO tblUser (firstName, lastName, email, userName, password, userImage) 
				VALUES('$firstName', '$lastName', '$email', '$userName', '$password_hash', '$userImage')";
			$result = mysql_query($insertQuery);
			//give the user feedback on a successful sign up
			echo("Sign up complete. Welcome to Trade Me Portfolios.");
			//assign the username and password to the session to log the user in
			$_SESSION['userName'] = $userName;
			$_SESSION['password'] = $password_hash;
			//redirect the user to the account page
			header('Location: account.php');
		}		

?>