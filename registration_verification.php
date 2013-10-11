<?php
	/* Password Validation*/
	if(isset($_POST['password']))
	{
		$password = $_POST['password'];
		
		if(isset($_POST['pword']))
		{
			$pword = $_POST['pword'];
			$compare = strcmp ($password , $pword);
			
			if($compare == 0)
			{
				
			}
			else
			{
				$feedback = "Passwords don't match";
			}
		}
		else
		{
			$feedback = "Please verify your password";
		}
	}
	else
	{
		$feedback = "Please enter password";
	}
?>