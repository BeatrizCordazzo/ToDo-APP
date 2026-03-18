<?php
require_once '../includes/auth.php'; // Include the authentication script to protect this page
require_once '../config/db.php'; // Include the database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = !empty($_POST['description']) ? trim($_POST['description']) : null;

    if (empty($title)) {
        die("Title is required.");
    }

    $user_id = $_SESSION['user_id']; // Get the user ID from the session

    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $title, $description]);

    header("Location: ../dashboard.php"); // Redirect to the dashboard after creating the task
    exit();
}

header("Location: ../dashboard.php"); // Redirect to the dashboard if accessed directly
exit();