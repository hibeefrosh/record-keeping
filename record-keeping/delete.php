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
$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM records WHERE id=$id");

header("location:" . APP_URL . "/view-all.php");
?>