<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "portfolio_db"; // Double check that this is exactly what you named it in phpMyAdmin!

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
