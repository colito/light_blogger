<!--
	PROGRAMMER	:	PRIDE MOKHELE
	SCRIPT NAME	:	photos.php
	DATE		:	14-02-2012
	DESCRIPTION	:	Contains function that partain to uploading photos,
					saving their names to databases and changing profile
					picture.
-->
<?php
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
?>