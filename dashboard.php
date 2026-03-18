<?php
require_once 'includes/auth.php'; // Include the authentication script to protect this page
require_once 'includes/header.php'; // Include the header
require_once 'config/db.php'; // Include the database connection script

$user_id = $_SESSION['user_id']; // Get the user ID from the session
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all tasks for the logged-in user
?>

<section class="dashboard-intro">
    <p class="eyebrow">Dashboard</p>
    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
    <p class="intro-copy">Organize your day, priorize tasks and keep momentum.</p>
</section>

<section class="task-composer">
    <div class="task-composer__header">
        <div>
            <p class="eyebrow">Create task</p>
            <h2>Add a new to-do</h2>
        </div>
        <p class="task-composer__helper">Give your task a clear title and, if needed, describe the next steps or useful context.</p>
    </div>

    <form class="task-form" action="actions/create_task_action.php" method="POST">
        <div class="form-row">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="e.g. Prepare sprint demo" required>
        </div>

        <div class="form-row">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Add details, links or next actions"></textarea>
        </div>

        <div class="form-row form-row--actions">
            <button class="btn-primary" type="submit">Create Task</button>
            <a class="btn-secondary" href="actions/logout.php">Log out</a>
        </div>
    </form>
</section>

<?php require_once 'includes/footer.php';?>
