<!DOCTYPE html>
<html>
<head>
    <title>PHP in HTML</title>
</head>
<body>
    <h1>Welcome to My Website</h1>
    
    <?php
$servername = "mysql-gradahmedrashad.alwaysdata.net"; // Example: mysql5.freehostia.com
$username = "405204_grad";
$password = "123ee123";
$dbname = "gradahmedrashad_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully!";
?>

    
</body>
</html>
