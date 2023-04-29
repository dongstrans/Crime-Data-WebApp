<?php
// This php file connects the user to the database.

	// Create Variables
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "street_crime";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if($conn->connect_error)
	{
		die("The connection has failed" . $conn->connect_error);
	}
	echo "";

?>