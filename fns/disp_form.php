<!--
	PROGRAMMER	:	PRIDE MOKHELE
	SCRIPT NAME	:	disp_form.php
	DATE		:	24-01-2012
	DESCRIPTION	:	Displays a form containing
					user details on edit_profile.php
-->
<?php
	/************************ DISPLAY FORM FUNCTION ************************************/
	/*
	* This function displays a form on the edit_profile.php page
	* It diplays the the users details in textboxes so that the user
	* can make the changes to their profile that they desire.
	*/
	function dispForm($name, $surname, $dob, $email, $contact) {
	
		global $newName;
		global $newSurname;
		global $newGen;
		global $newDob;
		global $newContact;
		
				echo "
						<table cellspacing='30px' cellpadding='20px'>
							<tr>
								<td>Name: </td>
								<td><input type='text' value='$name' name='txtName'/></td>
							</tr>
							<tr>
								<td>Surname: </td>
								<td><input type='text' value='$surname' name='txtSurname'/></td>
							</tr>
							<tr>
								<td>Gender: </td>
								<td>
									<select name='gen'>
										<option />Male
										<option />Female
									</select>	
								</td>
							</tr>
							<tr>
								<td>Date of Birth: </td>
								<td><input type='text' value='$dob' name='txtDob' /></td>
							</tr>
							<tr>
								<td>Email: </td>
								<td>$email</td>
							</tr>
							<tr>
								<td>Contact: </td>
								<td><input type='text' value='$contact' name'txtContact' /></td>
							</tr>
						</table>
				";
				
				if (isset($_REQUEST['txtName'])) {
					$newName = $_REQUEST['txtName']; //sets the $newName
				}
				if (isset($_REQUEST['txtSurname'])) {
					$newSurname = $_REQUEST['txtSurname']; //sets the $newSurname if it is set
				}
				if (isset($_REQUEST['gen'])) {
					$newGen = $_REQUEST['gen']; //sets the gender if it is set
				}
				if (isset($_REQUEST['txtDob'])) {
					$newDob = $_REQUEST['txtDob']; //sets the date of birth if set 
				}
				if (isset($_REQUEST['txtContact'])) {
					$newContact = $_REQUEST['txtContact']; //sets the contact number if set
				}
	}
?>