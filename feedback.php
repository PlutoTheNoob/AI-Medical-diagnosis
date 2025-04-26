<html>
<title>Feedback System</title>
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

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-top: 10px;
            display: block;
            text-align: left;
        }

        select {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            width: 100%;
            font-size: 14px;
            color: #333;
            cursor: pointer;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
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

    <?php 
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_SESSION['Username'])){
        header('Location: https://d982-154-180-148-86.ngrok-free.app/login%20page.php');
    }
    if($_SESSION['Username'] == 'pass'){
        header('Location: https://d982-154-180-148-86.ngrok-free.app/first.php');
    }

    $user=$_SESSION['Username'];
    $servername = "mysql-gradahmedrashad.alwaysdata.net"; 
    $username = "405204_grad";
    $password = "123ee123";
    $dbname = "gradahmedrashad_database";

    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM imgreqq WHERE user = ?");
    $stmt->bind_param("s", $user);

    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
            echo '<form method="POST" action="">';
            echo '<div class="container"><h2>Feedback System</h2>';
            echo '<label>Which diagnosis are you giving us feedback about?</lable>';
            echo '<select name="user_list">';
    
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['req_np'] . '">' . $row['user'] . ' - ' . $row['diagnosis'] . '</option>';
            }
    
            echo '</select>';
            echo '<div class="input-group" style="margin-top: 15px;">';
            echo '<label for="pred">What was the actual diagnosis?</label>';
            echo '<select name="real">';
            echo '<option value="covid">Covid</option>';
            echo '<option value="Normal">Normal</option>';
            echo '</select>';
            echo '</div>';
            echo '<button type="submit" name="submit">Submit Feedback</button>';
            echo '</div>';
            echo '</form>';

        } else {
            echo "<p>No results found for the username: " . htmlspecialchars($user) . "</p>";
        }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $new=$_POST['real'];
        $search=$_POST['user_list'];
        $stmt= $conn->prepare("UPDATE imgreqq SET realdiag = ? WHERE req_np = ?");
        $stmt->bind_param("ss", $new, $search );
        $stmt->execute();
     
        header('Location: https://d982-154-180-148-86.ngrok-free.app/first.php');
        exit();

    }

    $stmt->close();
    $conn->close();
    session_destroy();
    ?>


</html>
