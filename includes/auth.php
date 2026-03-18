<?php
session_start(); // Start the session to access session variables

if(!isset($_SESSION['user_id'])) { // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}