<?php
// require_once("db_connect_fns.php");

class db_interactor
{	
	/****************************** ADD STATUS FUNCTION ******************************************/
	/*
	*	DESCRIPTION:
	*	Adds a status to the status table in the databnase
	*/
	
	function addStatus($user_id, $status) {
		//$mysqli = connect();
		
		$mysqli = connect();
		
		date_default_timezone_set('Africa/Harare');
		$date = date("Y-m-d");
		$time = date("H:i:s");
        if(!$status)    {
            echo "<p>Can't update empty status</p>";
        }
        else{
    		$stmt = $mysqli->prepare("INSERT INTO ustatus VALUES('NULL',?,?,?,?,?,?)");
            $stmt->bind_param('isssss', $userID, $name, $surname, $date, $time, $status);
            $stmt->execute();
        }
		
		/*******/
        //$query = "INSERT INTO ustatus(user_id, date, status) VALUES($user_id, $status)";
		//$result = mysql_query($query);
		
		$query2 = "SELECT * FROM ustatus";
		$result2 = mysql_query($query2, $conn);
		
		var_dump($result2);
		
		if($result)
		{
			return true;
			echo "Successful: " . $result;
		}
		else
		{
			return mysql_error($mysqli);
			//echo $result;
		}
        mysql_close($mysqli);
	}
	
	/************************************** SHOW USER STATUS *****************************************/
	/*
	*	DESCRIPTION:
	*	Shows the most recent status of the current user
	*/
	function showUserStatus($id)	{
		//$mysqli = connect();
		
		
		$hostname = "localhost"; //The hostname
		$username = "root"; //user name
		$password = ""; //password
		$database = "bloggers_db"; //database name
		
		/** Connects to database **/
		$mysqli = @new mysqli($hostname, $username, $password, $database);
		
		if (mysqli_connect_errno()) {
			echo "Unsuccessful connection to database server.";
		}
		else {
			return $mysqli;
		}
		
		
		$sql = "SELECT * FROM ustatus WHERE userID = '$id' ORDER BY ustatusID DESC LIMIT 0, 1";
		
		if($stmt = $mysqli->prepare($sql))	{
			$stmt->execute();
			$stmt->bind_result($id, $userID, $userName, $surname, $date, $time, $status);
			
			$entries = array();
			
			while ($stmt->fetch())	{
				/*$userStatus = $status;
				$dt = $date;
				$tm = $time;
				echo $userStatus . "<br>" . "<i>".$date . "&nbsp;&nbsp;" . $time."</i>";*/
				
				
			}
		}
		$mysqli->close();
	}
	
	/*********************************** SHOW STATUS FUNCTION ********************************************/
	public function showStatuses()	{
		$mysqli = connect();
		$sql = "SELECT * FROM ustatus
				ORDER BY ustatusID DESC";
						
		if($stmt = $mysqli->prepare($sql))	{
			$stmt->execute();
			$stmt->bind_result($id, $userID, $userName, $surname, $date, $time, $status);
			
			while ($stmt->fetch())	{
			
				$uID = $userID;
				$statuses = $status;
				$uname = $userName;
				$dt = $date;
				$tm = $time;
				$ustatusID = $id; 
				
				//get_propic($uID);
				//$propic;
				//echo $propic;
				
				//echo "<img src='userpics/".$propic."' width='60' height='60' />";
				echo "<label>" .$uname. " " .$surname. "</label><br/>";
				echo "<p>" . $statuses . "<br>" . "<i>".$date . "&nbsp;&nbsp;" . $time."</i>&nbsp;&nbsp;";
                echo "<form action='comments.php' method='get'>
						<input type='hidden' value=".$ustatusID." id='cmtBtn' name='cmtBtn'>
						<input type='submit' value='comments' />
					  </form>";
				echo "<hr/>";
			}
		}
		$mysqli->close();
	}
	
	/********************************************* GET STATUS **********************************************************/
	function getStatus($id)	{
		$mysqli = connect();
		
		global $uID;
		
		$sql = "SELECT * FROM ustatus WHERE ustatusID = '$id'";
		
		if($stmt = $mysqli->prepare($sql))	{
			$stmt->execute();
			$stmt->bind_result($ustatusID, $userID, $userName, $surname, $date, $time, $status);
			
			$uID = $ustatusID;
			while ($stmt->fetch())	{
				
				echo "<label>" .$userName. " " .$surname. "</label><br/>";
				echo "<p>" . $status . "<br>" . "<i style='color:987654;'>".$date . "&nbsp;&nbsp;" . $time."</i>&nbsp;&nbsp;";
			}
		}
		$mysqli->close();
	}
	
	/************************************************ ADD COMMENT *******************************************************/
	/*
	*	DESCRIPTION:
	*	Adds a comment to the comment table in the database
	*/
	function addComment($ustatusID, $name, $surname, $comment)	{
		$mysqli = connect();
		
		date_default_timezone_set('Africa/Harare');
		$date = date("Y-m-d");
		$time = date("H:i:s");
        if(!$comment)    {
            echo "<p>Can't add an empty comment</p>";
        }
        else{
    		$stmt = $mysqli->prepare("INSERT INTO comments VALUES(NULL, ?,?,?,?,?,?)");
            $stmt->bind_param('isssss', $ustatusID, $name, $surname, $date, $time, $comment);
            $stmt->execute();
			
			echo "<p> Comment added </p>";
			$comment = null;
        }
		$mysqli->close();
	}
	
	/***************************************** SHOW COMMENTS ************************************************/
	/*
	*	DESCRIPTION:
	*	Shows all the comments of a specific status
	*/
	function showComments($id)	{
	
		$mysqli = connect();
		
		$sql = "SELECT * FROM comments WHERE ustatusID = '$id'";
		
		if($stmt = $mysqli->prepare($sql))	{
			$stmt->execute();
			$stmt->bind_result($id, $userID, $userName, $surname, $date, $time, $comment);
			
			while ($stmt->fetch())	{
				
				echo "<label>" .$userName. " " .$surname. "</label><br/>";
				echo "<p>" . $comment . "<br>" . "<i>".$date . "&nbsp;&nbsp;" . $time."</i>&nbsp;&nbsp;";
				echo "<hr/>";
			}
			$mysqli->close();
		}
	}
	function updateName($newName, $email) {
		$mysqli = connect();
		$sql = "UPDATE users SET name = ? WHERE email = ?";
		
		$stmt = $mysqli->prepare($sql);
		
		if($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("ss", $newName, $email);
			$stmt->execute();
			
			$stmt->close();
		}
		$mysqli->close();
	}
			/********* upadte name **********/
	function updateSname($newSurname, $email) {
		$mysqli = connect();
		$sql = "UPDATE users SET surname = ? WHERE email = ?";
		
		$stmt = $mysqli->prepare($sql);
		
		if($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("ss", $newSurname, $email);
			$stmt->execute();
			
			$stmt->close();
		}
		$mysqli->close();
	}
		/********* updatate gender ***********/
	function updateGender($newGen, $email)	{
		$mysqli = connect();
		$sql = "UPDATE users SET gender = ? WHERE email = ?";
		
		$stmt = $mysqli->prepare($sql);
		
		if($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("ss", $newGen, $email);
			$stmt->execute();
			
			$stmt->close();
		}
		$mysqli->close();
	}
		
		/****** update date of birth ******/
	function updateDob($newDob, $email) {
		$mysqli = connect();
		$sql = "UPDATE users SET dob = ? WHERE email = ?";
		
		$stmt = $mysqli->prepare($sql);
		
		if($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("ss", $newDob, $email);
			$stmt->execute();
			
			$stmt->close();
		}
		$mysqli->close();
	}
	
		/****** update contact ******/
	function updateContact($newContact, $email) {
		$mysqli = connect();
		$sql = "UPDATE users SET contact = ? WHERE email = ?";
		
		$stmt = $mysqli->prepare($sql);
		
		if($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("ss", $newContact, $email);
			$stmt->execute();
			
			$stmt->close();
		}
		$mysqli->close();
	}
    
		/******** update password **********/
    function updatePassword($newPassword, $email)    {
        $mysqli = connect();
        $sql = "UPDATE users SET psswd = ? WHERE email = ?";
        
        $stmt = $mysqli->prepare($sql);
        
        if($stmt = $mysqli->prepare($sql))    {
            $stmt->bind_param("ss", $newPassword, $email);
            $stmt->execute();
            
            $stmt->close();
        }
        
        $mysqli->close();
    }
	/************************************ GET DETAILS FUNCTION *************************************/
	/*
	*	DESCRIPTION:
	*	Attains different parts of a users information
	*	It only uses one parameter which is an email,
	*	and uses it to get all the users information
	*	from the user table in the database
	*/
	function getDetails($email) {
		//includes a list of functions into the script
		require_once("db_connect_fns.php");
		
		$mysqli = connect(); //conneting to database
		
		/*
		*Variables declare as global so that they can
		*also be used from outside the function.
		*/
		global $userID;	
		global $name;
		global $surname;
		global $gender;
		global $dob;
		global $contact;
        global $password;
		
		$sql = "SELECT * FROM users WHERE email = '$email' ";
			
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->execute();
			$stmt->bind_result($sqid, $sqname, $sqsurname, $sqgender, $sqdob, $sqemail, $sqcontact, $sqpsswd);
			
			//assigning values to the global variables
			while ($stmt->fetch())	{
				$userID = $sqid;
				$name = $sqname;
				$surname = $sqsurname;
				$gender = $sqgender;
				$dob =  $sqdob;
				$contact = $sqcontact;
                $password = $sqpsswd;
			}
		}
		$mysqli->close();
	}
	/******************************************************  UPLOAD IMAGE  ****************************************************************/
	/* This function uploads the users image into a folder where 
	*  all images are stored and saves the image name to the database
	*/
    function upload_image($id, $pname) {
        require_once('web_fns.php');
        $mysqli = connect();
		
		if(!isset($_FILES['myfile']))	{
			echo "no image";
			exit;
		}
        
        if($_FILES['myfile']['type'] != 'image/jpeg') {
            echo "This file is not a JPEG image";
            exit;
        }
        
        $FILES['myfile']['name'] = $pname . ".jpg"; //assigns the random name to the file
        $picname = $FILES['myfile']['name']; //assigns short variable name to the new file name
        
        //saves the file to the userpics directory
        $upimage = 'userpics/' . $FILES['myfile']['name'];
        
        //The following section of code checks if the file was successfully uploaded to the designated folder
        if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {
    				
    	       if(!move_uploaded_file($_FILES['myfile']['tmp_name'], $upimage)) {
    					echo "Problem: Could not move file to destinamtion directory";
    					exit;
                }
    	}
    	else {
            echo "Problem: Possible file upload attack. Filename: ";
            echo $_FILES['myfile']['name'];
            exit;
        }
    			
		//echo "File uploaded successfully<br/>";
			
		//remove possible HTML and PHP tags from the file's contents
		$contents = file_get_contents($upimage);
		$contents = strip_tags($contents);
		file_put_contents($picname, $contents);
			
			
		//Adding the new picture name to the database
		if($stmt = $mysqli->prepare("INSERT INTO pictures VALUES(NULL,?,?)"))	{
			$stmt->bind_param('is', $id, $picname);
			$stmt->execute();
			echo "File uploaded successfully<br/>";
			$stmt->close();
		}
		unset($_FILES['myfile']['name']);
		
        $mysqli->close();
    }
	
	/******************************** REMOVE EPROFILE PICTURE FUNCTION **********************************************/
	/*
	*	DESCRIPTION:
	*	Removes the old profile picture of the user by deleting the
	*	current record from the propics table in the database
	*/
	function rem_propic($id)	{
		$mysqli = connect();
		
		$stmt = $mysqli->prepare("DELETE FROM propics WHERE userID = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		//echo "<br/> Old picture removed <br/>";
        $stmt->close();
	}
	
	/*************************************** NEW PROFILE PICTURE FUNCTION ******************************************/
	/*
	*	DESCRIPTION:
	*	Saves the newly selected profile picture name
	*	to the propics table in the database
	*/
	function new_propic($id, $picname)	{
		$mysqli = connect();
		
		$stmt = $mysqli->prepare("INSERT INTO propics VALUES (?, ?)");
		$stmt->bind_param('is', $id, $picname);
		$stmt->execute();
		echo "<br/> Your profile picture has been successfully saved <br/>";
        $stmt->close();
		
        $mysqli->close();
	}
	
	/************************************* SHOW PROFILE PICTURES FUNCTION **********************************************/
	/*
	*	DESCRIPTION:
	*	Retrieves and displays the users profile picture
	*/
	function showpics($id)	{
		$mysqli = connect(); //opens connection to database
		
		$sql = "SELECT * FROM pictures WHERE userID = '$id' ORDER BY pictureID DESC";
		
		if($stmt = $mysqli->prepare($sql))	{
			$stmt->execute();
			$stmt->bind_result($pid, $userID, $pic);
			
			//the output is displayed in a form format
			echo "
				<form method='post' action='change_pic.php'>
					<table>
			";
			
			while($stmt->fetch())	{
				$pName = $pic;
				
				echo "
						<tr>
							<td><img src='userpics/".$pName."' width='100px' height='100px' name = 'selected_picture'/></td>
							<td><input type='hidden' value='$pName' name='selected_picture' /></td>
							<td><input type='submit' value='select for profile' /></td>
						</tr>
				";
			}
		}
		echo "
				</table>
			</form>
		";
		
        $stmt->close(); //closing prepared statement
		
		$mysqli->close(); //Closing connection to database
	}
	
	/*******************************************************  GET PROFILE PICTURE  *****************************************************************/
	/* This function is used to get the name of the users profile picture*/
	function get_propic($id)	{								
		$mysqli = connect();
		
		global $propic; //this variable is set as global so that it can be accessed once the function is called
		
		$sql = "SELECT * FROM propics WHERE userID = '$id' ";
		
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->execute();
			$stmt->bind_result($sqid, $pict);
		
			while ($stmt->fetch())	{
				$propic = $pict;
			}
		}
		$mysqli->close();
	}
}
?>