<?php
$host = 'localhost'; //your server host
$user = 'root'; //database username
$pass = ''; //database password
$dbname = 'crud'; //database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>