<?php
session_start(); // without this, php can't access the user's session data
require_once '../config/db.php'; // Include the database connection

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)) {
        die("Email and password are required.");
    }

    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: ../dashboard.php");
        exit();
    } else {
        die("Invalid email or password.");
    }
} else {
    header("Location: ../login.php");
    exit();
}