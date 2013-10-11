<?php
	$errors = array();
	$valid = array();
	$response = array();
	
	/* Name validation*/
	if(!$_POST['name'])
	{
		$errors['name'] = "Please enter your name";
	}
	else
	{
		$name = $_POST['name'];
		echo $name;
		$valid["name"] = $name;
	}
	
	if(!$_POST['surname'])
	{
		$errors['surname'] = "Please enter your surname";
	}
	else
	{
		$surname = $_POST['surname'];
		echo $surname;
		$valid["surname"] = $surname;
	}
	
	/* Gender*/
	if(!$_POST["gender"])
	{	
		echo "no gender <br/>";
	}
	else
	{
		$gender = $_POST["gender"];
		$valid["gender"] = $gender;
	}
	
	/*DOB*/
	if(!$_POST["dob"])
	{	
		//echo "Please enter your date of birth <br/>";
		$errors['dob'] = "Please enter your date of birth";
	}
	else
	{
		$dob = $_POST["dob"];
		$valid["dob"] = $dob;
	}
	
	/* Email */
	if(!$_POST["email"])
	{	
		//echo "Please enter your date of birth <br/>";
		$errors['email'] = "Please enter your email.";
	}
	else
	{
		$email = $_POST["email"];
		$valid["email"] = $email;
	}
	
	/* Password Validation*/
	if(!$_POST['password'])
	{
		$errors['password'] = "Please enter password";
	}
	else
	{
		$password = $_POST['password'];
		echo $password;
		//$valid[] = "valid password";
		
		if(!$_POST['pword'])
		{
			$errors['pword'] = "Please verify your password";
		}
		else
		{
			$pword = $_POST['pword'];
			$compare = strcmp ($password , $pword);
			
			if($compare == 0) # if the strings match
			{
				$password = $_POST['password'];
				$valid[] = "valid pword";
			}
			else
			{
				$errors['mismatch'] = "Passwords don't match";
			}
		}
	}
	
	echo "<br/> <b>This is the POST count: ". count($_POST) ."</b><br/>";
	
	$response["valid"] = $valid;
	$response["errors"] = $errors;
	
	if(count($errors) == 0)
	{
		# save newly registered user
		
		echo "<b>CONGRATS! NO ERRORS</b>";
		
		$feedback = "success";
		$url = "register.php?registration=" . urlencode($feedback);
	}
	else
	{
		echo "<b>THERE ARE ERRORS</b><br/>";
		echo "<b>Error count: ". count($errors) ."</b>";
		
		$url = "register.php?registration=" . urlencode(serialize($response));
	}
	
	header("Location: ". $url);
?>