<?php
require_once '../config/db.php'; // Include the database connection

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($name) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->execute([$email]);

    if($checkStmt->fetch()) {
        die("Email is already registered.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $hashedPassword]);

    header("Location: ../login.php");
    exit();
} else {
    header("Location: ../register.php");
    exit();
}