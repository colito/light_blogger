<?php
    require_once('../config.php');
    $config = new Config();

	$hostadress = $config->hostadress;
    echo $hostadress;
	$username = $config->username;
	$password = $config->password;
	$my_sql_db = $config->my_sql_db;
	
	$connect = mysql_connect($hostadress, $username, $password);
	
	if (!$connect)
	{
	  die('Could not connect: ' . mysql_error());
	}
	else	
	{
		echo "Successful connection";
		mysql_select_db($my_sql_db, $connect);
	}
?>
