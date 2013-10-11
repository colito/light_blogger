<!--
	PROGRAMMER	:	PRIDE MOKHELE
	SCRIPT NAME	:	friends.php
	DATE		:	24-02-2012
	DESCRIPTION	:	Consists of the different functions
					that deal with manipulating friend information.
-->
<?php
	require_once('web_fns.php');
	
	/********************************** ADD FRIEND FUNCTION ************************************/
	/*
	* This function adds a selected user as a friend to another user by
	* storing the two different userID's together in a table.
	*/
	function addFriend($myID, $frID)	{
		$mysqli = connect(); //Connecting to database
		
		/*
		* This part of the program is used to check if
		* if a particular user has been added as a friend
		* or not.
		*/
		$sql = "SELECT * FROM friends WHERE userID = '$myID'";
		
		if($stmt = $mysqli->prepare($sql))	{
			$stmt->execute();
			$stmt->bind_result($sqid, $sqfrID);
			
			while($stmt->fetch())	{
				$fID = $sqfrID;
				//echo $fID;
				
				if($frID == $fID)	{
					echo "<br/> This person is already added as your friend.";
					exit; //exits if the individual has already been added as the users friend
				}
			}
			/****************************************/
			
			//Inserts the friendID into the friends table along with the users userID
			$stmt = $mysqli->prepare("INSERT INTO friends VALUES(?,?)"); //Creating prepared statement
			$stmt->bind_param('ii', $myID, $frID);
			$stmt->execute();
			$stmt->close(); //Closing prepared statement
			
			//Inserts the userID as the friendID and the friendID as the userID
			$stmt = $mysqli->prepare("INSERT INTO friends VALUES(?,?)");
			$stmt->bind_param('ii', $frID, $myID);
			$stmt->execute();
			$stmt->close();
						
			echo "Friend added successfully";
		}
		$mysqli->close(); //Closing connection to database
	}
    
	/***************************** SHOW FRIENDS FUNCTION ******************************************/
	/*
	*	DESCRIPTION:
	*	Shows all the people that the user has added as their
	*	friends.
	*/
    function showFriends($id)  {
        
        $mysqli = connect(); //Connecting to database.
		
		//This array will be used to store all the users different friendID's
        $fids = array();
        
        $sql = "SELECT * FROM friends WHERE userID = '$id' ";
        
        if($stmt = $mysqli->prepare($sql))  {
            $stmt->execute();
            $stmt->bind_result($id, $frID);
            
            while($stmt->fetch()) {
                $fID = $frID;
                //echo $fID . "<br/>";
                $fids[] = $fID;
            }
        }
        $stmt->close();
        
		//The output is displayed in a table format
        echo "
		<form method='post' action='remove_friend.php'>
            <table cellspacing='5px' cellpadding='15px' border='1px' frame='box' >
                <tr style='background-color:#654321; text-color:yellow;'>
                    <td>Name</td> <td>Surname</td> <td>Gender</td>
                    <td>Date of Birth</td> <td>Email</td> <td>Contact</td>
					<td>Remove</td>
                </tr>
        ";
        
		//The foreach statement is used to get each friends details using the friendID's stored in the $fids[] array.
        foreach($fids as $frnd)   {
            $sql = "SELECT * FROM users WHERE userID = ".$frnd." ";
            
            if($stmt = $mysqli->prepare($sql))  {
                $stmt->execute();
                $stmt->bind_result($id, $name, $surname, $gender, $dob, $email, $contact, $password);
                
                while($stmt->fetch()) {
                    echo "
						<tr>
							<input type='hidden' value='$email' name='rem' />
						</tr>
						
						<tr>
							<td>".$name."</td> <td>".$surname."</td> <td>".$gender."</td>
							<td>".$dob."</td> <td>".$email."</td> <td>".$contact."</td>
							<td><input type='submit' value='Remove' /></td>
						</tr>
                    ";
                }
            }
			
        }
		echo "
             </table>
		</form>
            ";
        $mysqli->close();
 }
 
 /******************************** REMOVE FRIEND FUNCTION *********************************************/
 /*
 *	DESCRIPTION:
 *	Removes specific user-friend combinations
 *	from the friends table in the database.
 *	It makes use of two SQL query statements.
 */
 function removeFriend($uID, $fID, $name)	{
	$mysqli = connect();
 
	if($stmt = $mysqli->prepare("DELETE FROM friends WHERE userID = ? AND friendID = ? "))	{
		$stmt->bind_param("ii", $uID, $fID);
		$stmt->execute();
		$stmt->close(); //Closing prepared statement
		
		$sql = "DELETE FROM friends WHERE userID = ? AND friendID = ? "; //Creating a prepared statement
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ii", $fID, $uID);
		$stmt->execute();
		
		echo $name . " has been removed from your list of friends.";
		
		$stmt->close(); //Closing prepared statement
	}
	else	{
		echo "Currently unable to remove friend. Please try again later.";
	}
	$mysqli->close(); //Closing connection to database.
 }
?>