<?php
session_start();
include "config/app.php";

unset($_SESSION['user_id']);

header("Location: " . APP_URL . "/index.php");
exit;
?>