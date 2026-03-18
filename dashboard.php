<?php
require_once 'includes/auth.php'; // Include the authentication script to protect this page
require_once 'includes/header.php'; // Include the header
require_once 'config/db.php'; // Include the database connection script

$user_id = $_SESSION['user_id']; // Get the user ID from the session
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at ASC");
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
        </div>
    </form>
</section>

<section class="task-list">
    <div class="task-list-header">
        <div>
            <p class="eyebrow">Your Tasks</p>
            <h2>Current tasks</h2>
        </div>
        <p class="task-list-helper">Track what is pending and complete tasks as you finish them</p>
    </div>

    <?php if(count($tasks)> 0): ?>
        <div class="tasks-grid">
            <?php foreach($tasks as $task): ?>
                <div class="task-card">
                    <span class="task-status <?php echo $task['status'] === 'completed' ? 'task-status--done' : 'task-status--pending'; ?>">
                        <?php echo htmlspecialchars($task['status']); ?>
                    </span>
                    <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                

                    <p class="task-card-description">
                        <?php echo !empty($task['description']) ? htmlspecialchars($task['description']) : "No description provided."; ?>
                    </p>

                    <small class="task-card-date">
                        Created: <?php echo htmlspecialchars($task['created_at']); ?>
                    </small>

                    <div class="task-card__actions">
                        <?php if ($task['status'] === 'pending'): ?>
                            <form action="actions/complete_task.php" method="POST">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button class="btn-primary" type="submit">Complete</button>
                            </form>
                        <?php endif; ?>

                        <form action="actions/delete_task.php" method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button class="btn-secondary" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>You have no tasks yet. Start by creating your first task above!</p>
    <?php endif; ?>
</section>

<a class="btn-secondary" href="actions/logout.php">Log out</a>

<script>
(function() {
    const KEY = 'todo_scroll_y';
    const forms = document.querySelectorAll('.task-card__actions form, .task-form');
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    const saved = sessionStorage.getItem(KEY);
    if (saved !== null) {
        const y = parseInt(saved, 10);
        if (!Number.isNaN(y)) window.scrollTo(0, y);
    }
    const saveScroll = () => sessionStorage.setItem(KEY, String(window.scrollY));
    forms.forEach(form => form.addEventListener('submit', saveScroll));
    window.addEventListener('beforeunload', saveScroll);
})();
</script>

<?php require_once 'includes/footer.php';?>
