<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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

        .register-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        .register-container h2 {
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

    <form method="POST">
        <div class="register-container">
            <h2>Register</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $servername = "mysql-gradahmedrashad.alwaysdata.net"; 
                $username = "405204_grad";
                $password = "123ee123";
                $dbname = "gradahmedrashad_database";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
                }

                $user = $_POST['Username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'] ?? '';  // Optional field
                $pass = $_POST['password'];

                $sql = "INSERT INTO user_info (username, password, email, phone) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $user, $pass, $email, $phone);

                if ($stmt->execute()) {
                    echo "<p style='color:green;'>User registered successfully!</p>";
                    header('Location: https://d982-154-180-148-86.ngrok-free.app/login%20page.php');
                } else {
                    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>

            <div class="input-group">
                <label for="Username">Username:</label>
                <input type="text" id="Username" name="Username" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="phone">Phone (optional):</label>
                <input type="number" id="phone" name="phone">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>

            <div class="links">
                <a href="https://d982-154-180-148-86.ngrok-free.app/login%20page.php">Already have an account? Login</a>
            </div>
        </div>
    </form> 

</body>
</html>
