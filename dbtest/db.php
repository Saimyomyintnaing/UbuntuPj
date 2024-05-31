<?php
$servername = "localhost";
$username = "smnt2"; // Replace with your database username
$password = "MTG@dmin123"; // Replace with your database password
$dbname = "dbtest"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
