<?php
$servername = "mysql5.freehostia.com"; // Example: mysql5.freehostia.com
$username = "ahmras88_grad";
$password = "123ee123";
$dbname = "ahmras88_grad";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully!";
?>
