<?php
require_once 'includes/auth.php'; // Include the authentication script to protect this page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>
    <p>You're logged in.</p>

    <a href="actions/logout.php">Logout</a>
</body>
</html>