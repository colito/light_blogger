<!--
	PROGRAMMER	:	PRIDE MOKHELE
	SCRIPT NAME	:	header.php
	DATE		:	28-02-2012
	DESCRIPTION	:	This is the header that will be diplayed throughout
					the website.
-->
<style>
	<!--
		em	{
			color:#987654;
		}
	-->
</style>

<link rel="stylesheet" type="text/css" href="style.css" />

<?php
	/*************************** TOPPER: THE HEADER FUNCTION ****************************************/
	/*
	*	DESCRIOTION:
	*	Displays the website name, links, search facility
	*	and the logout button throughout the website.
	*/
	function topper() {
		echo "
			<h2>
				<img src='sishebo.jpg' />
				<a href='home.php'>Home</a>&nbsp;&nbsp;<em>|</em>&nbsp;
				<a href='profile.php'>Profile</a>&nbsp;&nbsp;<em>|</em>&nbsp;
				<a href='friends.php'>Friends</a>
				
				<div id='sea'>
					<form method='post' action='search.php'>
						<input type='text' name='searchbox' />
						<input type='submit' value='Search' />
		";
						
		echo "
					</form>
				</div>
				<div id='btn'>
					<form action='Login.php'>
		";
						//session_start();
						unset($_REQUEST['username']); //Destroying cookie
		echo "
						<input type='submit' value='Logout' action='Login.php' />
					</form>	
				</div>
			</h2>
		";
	}
?>