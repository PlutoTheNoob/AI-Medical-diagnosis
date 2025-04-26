<?php       
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['Username'] ?? null;
$diag = null;
$data = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['output'])) {
        $diag = $_POST['output'];
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {   
        $data = file_get_contents($_FILES['image']['tmp_name']);
    }

    if ($user && $diag && $data) {
        $servername = "mysql-gradahmedrashad.alwaysdata.net"; 
        $username = "405204_grad";
        $password = "123ee123";
        $dbname = "gradahmedrashad_database";
        
        $conn = new mysqli($servername, $username, $password, $dbname); 

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO imgreqq (user, diagnosis, image_data) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $diag, $data);
        $stmt->send_long_data(2, $data);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    } else {
        echo "Missing data. Check user, diagnosis, or image.";
    }
}

session_destroy();
?>
