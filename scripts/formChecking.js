/* 	Used for live checking on forms to display if a user has correct information
    Authors: Grant Ford and Lucas Mills
    Project: Trade Me Portfolios
    Date: 28/10/2014 */
$(document).ready(function() {
	//create variables and assign them value of 0
	var listingNameCheck = 0;
	var imageCheck = 0;

	//check when a user is entering information in the username text box
	$("#userName").keyup(function (e) {

		//set the regex for the username
		var usernameReg = /^[A-Za-z0-9]{5,16}$/;	
		//assign the entered value to username variable
		var username = $(this).val();

		//check that if the username passes the regex test
		if(!usernameReg.test(username))
		{
			//if it fails then display a red cross to the user to let them know what they've entered so far is incorrect
			$("#user-result").html('<img src="/images/not-available.png" />');
		}
		else
		{
			//display loading icon while the ajax runs a check on username
			$("#user-result").html('<img src="/images/ajax-loader.gif" />');
			//send information to the check username file that will check to see if username is available in the database
			$.post('check_username.php', {'userName':username}, function(data) {
				if(data == 1){
					//if it is available display a green tick
					$("#user-result").html('<img src="/images/available.png" />');
				}
				else
				{
					//if not available then display red cross
					$("#user-result").html('<img src="/images/not-available.png" />');
				}
		
		});
		}
	});	

	//check when a user is entering information in the email text box
	$("#email").keyup(function (e) {
		
		//assign the entered value to email variable
		var email = $(this).val();
		//set the regex for the uemail
		var emailReg = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

		//check that the length of email is greater than 0
		if(email.length > 0){
			//display loading icon while the ajax runs a check on uemail
			$("#email-result").html('<img src="/images/ajax-loader.gif" />');
			//send information to the check username file that will check to see if email is available in the database
			$.post('check_username.php', {'email':email}, function(data) {
			  	if(data == 1){
			  		//check if the email fails the regex test after being found available in database
			  		if(!emailReg.test(email))
			  		{
			  			//if it fails display red cross
						$("#email-result").html('<img src="/images/not-available.png" />');
			  		}
			  		else
			  		{
			  			//if it is available and passes regex display a green tick
						$("#email-result").html('<img src="/images/available.png" />');			  			
			  		}
				}
				else
				{
					//if not available then display red cross
					$("#email-result").html('<img src="/images/not-available.png" />');
				}

			});
		}
	});	

	//check when a user is entering information in the listing name text box
	$("#listingName").keyup(function (e) {
		
		//assign the entered value to listing name variable
		var listingName = $(this).val();

		//check that the length of elisting name is greater than 0
		if(listingName.length > 0){
			//display loading icon while the ajax runs a check on uemail
			$("#listingName-result").html('<img src="/images/ajax-loader.gif" />');
			//send information to the check username file that will check to see if listing name is available in the database
			$.post('check_username.php', {'listingName':listingName}, function(data) {
			  	if(data == 1)
			  	{
			  		//if available then change listingNmaeCheck to 1 to acknowledge it passing
			  		listingNameCheck = 1;
			  		//display green tick
					$("#listingName-result").html('<img src="/images/available.png" />');			  			
				}
				else
				{
					//if unavailable then make sure listingNameCheck  is 0 to acknowledge it failing
					listingNameCheck = 0;
					//display red cross
					$("#listingName-result").html('<img src="/images/not-available.png" />');
				}

				//check to see if both listingNameCheck and imageCheck pass
				if( listingNameCheck != 1 || imageCheck != 1)
				{
					//if not then the submit button is disabled
					$("#uploadButton").attr("disabled", true);
				}
				else
				{
					//if both checks pass then set the button disable to false
					$("#uploadButton").attr("disabled", false);
				}

			});
		}
	});	

	//check when a user is entering information in the password text box
	$("#password").keyup(function (e) {
		
		//set the regex for the password
		var passwordReg = /^.{7,}$/;
		//assign the entered value to listing name variable
		var password = $(this).val();

		//check to see if password being entered passes regex
		if(!passwordReg.test(password))
		{
			//if it fails then display red cross
			$("#password-result").html('<img src="/images/not-available.png" />');
		}
		else
		{
			//if it passes then display green tick
			$("#password-result").html('<img src="/images/available.png" />');
		}
	});	

	//check when a user is entering information in the second password text box used for change password page
	$("#password2").keyup(function (e) {
		
		//set the regex for the password
		var passwordReg = /^.{7,}$/;
		//assign the entered value to listing name variable
		var password = $(this).val();

		//check to see if password being entered passes regex
		if(!passwordReg.test(password))
		{
			//if it fails then display red cross
			$("#password2-result").html('<img src="/images/not-available.png" />');
		}
		else
		{
			//if it passes then display green tick
			$("#password2-result").html('<img src="/images/available.png" />');
		}
	});	

	//check when a change is made to the file input field
	$("#image").change(function(){
	
		//find the size of the image
	    var imageSize = ($("#image")[0].files[0].size / 1024);
	    //assign the chosen image to a variable
		var image = $(this).val();
		//set the regex for the allowed file types
		var imageRegex = /^.*\.(jpg|gif|png|jpeg|pjpeg|x-png|JPG|JPEG|GIF|PNG|X-PNG|PJPEG)$/;

		//check the file size is less than 10mb
		if(imageSize / 1024 < 10)
		{
			//check to see if file is correct type
			if(!imageRegex.test(image))
			{
				//make sure imageCheck is 0 to acknowledge it failing
				imageCheck == 0;
				//display red cross
				$("#image-result").html('<img src="/images/not-available.png" />');
			}
			else
			{
				//if it passes then change imageCheck to 1 to acknowledge it passing
				imageCheck = 1;
				//display green tick
				$("#image-result").html('<img src="/images/available.png" />');			  			
			}
	
			//check to see if both listingNameCheck and imageCheck pass
			if( listingNameCheck != 1 || imageCheck != 1)
			{
				//if not then the submit button is disabled
				$("#uploadButton").attr("disabled", true);
			}
			else
			{
				//if both checks pass then set the button disable to false
				$("#uploadButton").attr("disabled", false);
			}
		}
		else
		{
			//if image too large then imageCheck gets set to 0
			imageCheck = 0;
			//display red cross
			$("#image-result").html('<img src="/images/not-available.png" />');
		}
	});

	//check when a change is made to the file input field
	$("#profileImage").change(function(){

		//find the size of the image
		var imageSize = ($("#profileImage")[0].files[0].size / 1024);
		//assign the chosen image to a variable
		var image = $(this).val();
		//set the regex for the allowed file types
		var imageRegex = /^.*\.(jpg|gif|png|jpeg|pjpeg|x-png|JPG|JPEG|GIF|PNG|X-PNG|PJPEG)$/;

		//check the file size is less than 10mb
		if(imageSize / 1024 < 10)
		{
			//check to see if file is correct type
			if(!imageRegex.test(image))
			{
				//disable the submit button if the file type is incorrect
				$("#uploadButton").attr("disabled", true);
				//display red cross
				$("#image-result").html('<img src="/images/not-available.png" />');
			}
			else
			{
				//enable the submit button if filetype correct
				$("#uploadButton").attr("disabled", false);
				//display green tick
				$("#image-result").html('<img src="/images/available.png" />');			  			
			}
		}
		else
		{
			//if image too large then imageCheck gets set to 0
			imageCheck = 0;
			//display red cross
			$("#image-result").html('<img src="/images/not-available.png" />');
		}
	});
});

