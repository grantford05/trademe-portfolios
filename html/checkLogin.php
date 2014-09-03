<?php

	if (isset($_POST['userName']))
	{
		$userName = strip_tags($_POST['userName']);
	}
	else if (isset($_SESSION['userName']))
	{
		$userName = $_SESSION['userName'];
	}
	if (isset($_POST['password']))
	{
		$password = strip_tags($_POST['password']);
		$password = sha1($password);
	}
	else if (isset($_SESSION['password']))
	{
		$password = $_SESSION['password'];
	}

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
				  <input type='submit' name='login' class='uploadButton' value = 'Login'>");

		echo("</form>
			</div>");

		echo("<div id = 'rightContent'>

			<h2>Sign Up</h2>");

			if (isset($_POST['signUp']))
			{
				signUpSubmit();
			}
			else
			{
				signUpForm();
			}

	}
	else
	{
		$selectQuery = "SELECT * FROM tblUser WHERE (userName = '$userName' && password = '$password')";
		$result = mysql_query($selectQuery);

		if(mysql_num_rows($result)>0)
		{
			$_SESSION['userName'] = $userName;
			$_SESSION['password'] = $password;
		}

		else
		{
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

			if (isset($_POST['signUp']))
			{
				signUpSubmit();
			}
			else
			{
				signUpForm();
			}
		}
		mysql_free_result($result);

	}

		function signUpForm()
		{
			$self = htmlentities($_SERVER['PHP_SELF']);
			echo("<form action = '$self' method='POST'>
				<div id = 'formMargin'>

				<input type='text' name='firstName' id = 'inputBox' placeholder='First Name' required><br><br>
					
				<input type='text' name='lastName' id = 'inputBox' placeholder='Last Name' required><br><br>
					
				<input type='email' name='email' id = 'inputBox' placeholder='Email' required><br><br>
					
				<input type='text' name='userName' id = 'inputBox' placeholder='Username' required><br><br>
					
				<input type='password' name='password' id = 'inputBox' placeholder='Password' required><br><br>

				</div>

				<input type='submit' name='signUp' class='uploadButton' value = 'Sign Up'>
			</form>");
		}

		function signUpSubmit()
		{
			$firstName = mysql_real_escape_string(strip_tags($_POST['firstName']));
			$lastName = mysql_real_escape_string(strip_tags($_POST['lastName']));
			$email = mysql_real_escape_string(strip_tags($_POST['email']));
			$userName = mysql_real_escape_string(strip_tags($_POST['userName']));
			$password = mysql_real_escape_string(strip_tags($_POST['password']));
			$password = sha1($password);
			$insertQuery="INSERT INTO tblUser (firstName, lastName, email, userName, password) 
				VALUES('$firstName', '$lastName', '$email', '$userName', '$password')";
			$result = mysql_query($insertQuery);
			echo("Sign up complete. Welcome to Trade Me Portfolios.");
		}		

?>