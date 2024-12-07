<?php 
$serverName = "localhost";
$dbname = "barangay731db";
$username = "root";
$password = "";

$conn = mysqli_connect($serverName,$username,$password,$dbname);

if(!$conn)
{
	die("Cant connect to the database");
}


?>