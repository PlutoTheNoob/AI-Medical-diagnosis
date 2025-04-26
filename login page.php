<?php
session_start(); 
$servername = "mysql-gradahmedrashad.alwaysdata.net";
$username = "405204_grad";
$password = "123ee123";
$dbname = "gradahmedrashad_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user = $_POST['Username'];
    $_SESSION['Username'] = $user;
    $pass = $_POST['password'];

    // Prepare and execute SQL statement
    $sql = "SELECT * FROM user_info WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($pass === $row['password']) { // Change to password_verify($pass, $row['password']) if using hashed passwords
            $_SESSION['user'] = $row['username']; // Store user session
            header("Location: https://d982-154-180-148-86.ngrok-free.app/first.php"); 
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .login-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #0056b3;
        }

        .links {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }

        .links a {
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form method="post">
        <div class="login-container">
            <h2>Login</h2>

            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <div class="input-group">
                <label for="Username">Username:</label>
                <input type="text" id="Username" name="Username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>

            <div class="links">
                <a href="https://d982-154-180-148-86.ngrok-free.app/register.php">Register</a>
                <a href="https://d982-154-180-148-86.ngrok-free.app/first.php"> <?php $_SESSION['Username'] = 'pass'; ?>Continue as a guest</a>
            </div>
        </div>
    </form> 
</body>
</html>
