<?php
session_start(); // without this, php can't access the user's session data

if(isset($_SESSION['user_id'])) { // if the user is logged in, send them to the dashboard
    header("Location: dashboard.php");
    exit();
} else { // if the user is not logged in, send them to the login page
    header("Location: login.php");
    exit();
}
?>