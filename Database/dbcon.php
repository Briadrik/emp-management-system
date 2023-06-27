<?php
	// First connect to the database via your connection insert file
$host = "localhost";
$user = "root";
$pass = "";
$db = "ncemsdb";

$conn = mysqli_connect($host, $user, $pass, $db);
if(mysqli_connect_errno()){
	echo mysqli_connect_error();
	exit();
} 
?>