<?php

$dsn = getenv('DB_DSN') ?: "mysql:host=localhost;dbname=todo_app";
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '1234';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
