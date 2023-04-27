<?php
session_start();
include "config/app.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "user_signup_db";

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("location:" . APP_URL . "/dashboard.php");
            exit;
        } else {
            $_SESSION["failed"]="Invalid email or password";
            header("location:" . APP_URL . "/index.php");
        }
    } else {
        $_SESSION["failed"] = "Invalid email or password";
        header("location:" . APP_URL . "/index.php");
    }
}
?>

