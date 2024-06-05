<?php
// Database connection
$servername = "localhost";
$username = "smmn";
$password = "Smmn@123";
$dbname = "smmn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


