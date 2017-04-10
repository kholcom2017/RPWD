<?php 
	require('constants.php');
	$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_SERVER;
	$uname = DB_USER;
	$pass = DB_PASSWORD;

	// Create the Connection
	$con = new PDO($dsn, $uname, $pass);
	if(!$con){
		die("Unable to connect to page.");
	}
?>