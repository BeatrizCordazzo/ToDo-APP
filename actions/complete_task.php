<?php
require_once '../includes/auth.php';
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $taskId = (int) $_POST['task_id'];
    $userId = $_SESSION['user_id'];

    if ($taskId > 0) {
        $stmt = $pdo->prepare("UPDATE tasks SET status = 'completed' WHERE id = ? AND user_id = ?");
        $stmt->execute([$taskId, $userId]);
    }
}

header('Location: ../dashboard.php');
exit();
