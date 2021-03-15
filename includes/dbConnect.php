<?php
// Variable Defenition

	$hostname= '198.71.228.68';
	$username= 'W918ajh';
	$dbname= 'rStorage';
	$password= '4uq%E5DR6QkpYTe6XncmBLl2WxOML25B3iSfPBgGHRPKT5jXhsq';
	$usertable= 'Reminder';
	
// Create connection

$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
	
?>