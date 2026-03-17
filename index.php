<?php
session_start(); // without this, php can't access the user's session data

if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}

?>