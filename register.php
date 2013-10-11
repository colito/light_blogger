<!DOCTYPE HTML>
<html>
<?php
	require_once('fns/runner2.php');
	$blogger = new blogger();
?>
	<head lang="en">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Blogger Home</title>
		<link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	</head>
	
	<body>
		<div id="topper">
			<div id="title">
				<a href="../blogger"><h2>The Light Blogger</h2></a>
			</div>
			<div id="links" class="animated">
				<a href="#">Log in</a>
			</div>
		</div>
		
		<div class="container">
		
			<div class="grid_8">
				<h2>Get Registered</h2>
			</div>
			
			<div id="reg_form" class="grid_7 omega">
				<form action="registration_validation.php" method="post">
					<p>Please note that all fields are mandatory.</p>
					<?php 	
						if(!$_GET["registration"])
						{	
							//echo "no errors at the moment...";
						}
						else
						{
							if($_GET["registration"] == "success")
							{
								echo "<p class='success'>Registration Successful</p>";
							}
							
							$response = array();
							$response[] = unserialize($_GET["registration"]);
							
							$valid = array();
							$valid[] = $response[0]["valid"];
							
							$errors = array();
							$errors[] = $response[0]["errors"];
							
							//var_dump($response);
							
							if($_GET["registration"] == 'show_info')
							{
								echo "This is just some little info";
							}
						}
						
					?>
					<dl>
						<input type="hidden" name="errors" value="none" />
						<dt>
							<dd>
								<label for="name">Name:<i class="mandatory">*</i></label>
								<b class="error"><?php echo $errors[0]["name"];?></b>
							</dd>
							<dd>
								<input name="name" id="name" value="<?php echo $valid[0]['name'];?>" type="text">
								<span>Please enter your name</span>
							</dd>
						</dt>
						<dt>
							<dd>
								<label for="name">Surname:<i class="mandatory">*</i></label>
								<b class="error"><?php echo $errors[0]["surname"];?></b>
							</dd>
							<dd>
								<input name="surname" id="surname" type="text" value="<?php echo $valid[0]['surname'];?>">
								<span>Please enter your surname</span>
							</dd>
						</dt>
						<dt>
							<dd><label>Gender:<i class="mandatory">*</i></label></dd>
							<dd>
								<input type="radio" value="male" name="gender" checked="true" />Male
								<br/><br/>
								<input type="radio" value="female" name="gender" />Female
							</dd>
						</dt>
						<dt>
							<dd>
								<label for="dob">Date of birth:<i class="mandatory">*</i></label>
								<b class="error"><?php echo $errors[0]["dob"];?></b>
							</dd>
							<dd>
								<input name="dob" id="dob" type="date" value="<?php echo $valid[0]['dob'];?>">
								<span>Please enter your date of birth</span>
							</dd>
						</dt>
						<dt>
							<dd>
								<label for="email">Email:<i class="mandatory">*</i></label>
								<b class="error"><?php echo $errors[0]["email"];?></b>
							</dd>
							<dd>
								<input name="email" id="email" type="email" value="<?php echo $valid[0]['email'];?>" class="required">
								<span>Enter a valid email address</span>
							</dd>
						</dt>
						
						<dt>
							<dd><b class="error"><?php echo $errors[0]["mismatch"];?></b></dd>
						</dt>
						
						<dt>
							<dd>
								<label for="password">Password:<i class="mandatory">*</i></label>
								<b class="error"><?php echo $errors[0]["password"];?></b>
							</dd>
							<dd>
								<input type="password" id="password" name="password" />
							</dd>
							
							<dd>
								<label for="pword">Verify password:<i class="mandatory">*</i></label>
								<b class="error"><?php echo $errors[0]["pword"];?></b><br/>
							</dd>
							<dd>
								<input type="password" id="pword" name="pword" />
							</dd>
						</dt>
						
						<dt>
							<dd class="submit">
								<input type="submit" value="Submit" class="btn-submit">
								<input type="reset" value="Clear" class="btn-clear">
							</dd>
						</dt>
					</dl>
				
				</form>
			</div>
			
		</div>
		
	</body>
</html>