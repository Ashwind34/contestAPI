<?php

$servername = "localhost";
$username = "root";
$password = "Awing22";
$dbname = "supertest";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed" . mysqli_error($conn)) ;

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

?>
