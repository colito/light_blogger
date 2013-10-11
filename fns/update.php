<!--
	PROGRAMMER	:	PRIDE MOKHELE
	SCRIPT NAME	:	update.php
	DATE		:	06-02-2012
	DESCRIPTION	:	Functions used to update the users
					details
-->
<?php
	//Includes the connect function on the script.
	require_once("db_connect_fns.php");
	
	/************************************** UPDATE FUNCTIONS *******************************************/
	/*
	*	DESCRIPTION:
	*	The following blocks of functions are used to update
	*	different aspects of the users information
	*	including name, surname, gender, date of birth,
	*	contact and password.
	*/
	
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
?>