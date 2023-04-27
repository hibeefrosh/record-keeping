<?php
session_start();
include "config/app.php";

$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "user_signup_db";

$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        exit;
    }
    

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id= $user_id");
    $row = mysqli_fetch_array($result);

    if (password_verify($current_password, $row["password"])) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        mysqli_query($conn, "UPDATE users SET password='$hashed_password' WHERE id=$user_id ");
        header("location:" . APP_URL . "/profile.php");
    }else {
        echo "Error: Current password is incorrect.";
        exit;
    }

    
}

?>