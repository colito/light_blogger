<!--
	PROGRAMMER	:	PRIDE MOKHELE
	DATE		:	13-02-2012
	SCRIPT NAME	:	status.php
	DESCRIPTION	:	Page conatains functions to add status to database
					as well as retrieving them as well
-->
<style>
	<!--
		i	{
			color:#654321;
			font-size:12px;
		}
	-->
</style>

<?php
	require_once('web_fns.php');
	
	/****************************** ADD STATUS FUNCTION ******************************************/
	/*
	*	DESCRIPTION:
	*	Adds a status to the status table in the databnase
	*/
	function addStatus($userID, $name, $surname, $status) {
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
        $mysqli->close();
	}
	
	/************************************** SHOW USER STATUS *****************************************/
	/*
	*	DESCRIPTION:
	*	Shows the most recent status of the current user
	*/
	function showUserStatus($id)	{
		$mysqli = connect();
		$sql = "SELECT * FROM ustatus WHERE userID = '$id' ORDER BY ustatusID DESC LIMIT 0, 1";
		
		if($stmt = $mysqli->prepare($sql))	{
			$stmt->execute();
			$stmt->bind_result($id, $userID, $userName, $surname, $date, $time, $status);
			
			while ($stmt->fetch())	{
				$userStatus = $status;
				$dt = $date;
				$tm = $time;
				echo $userStatus . "<br>" . "<i>".$date . "&nbsp;&nbsp;" . $time."</i>";
			}
		}
		$mysqli->close();
	}
	
	/*********************************** SHOW STATUS FUNCTION ********************************************/
	function showStatuses()	{
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
?>