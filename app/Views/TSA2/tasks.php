<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Task List</title><?php include APPPATH . 'Views/TSA2/_styles.php'; ?></head>
<body>
<main>
<h1>Task List</h1>
<?php if (session('tsa2_user_id')): ?><p><a href="/TSA2/tasks/new">New Task</a></p><?php endif; ?>
<?php if (empty($tasks)): ?>
    <p>No tasks found.</p>
<?php else: ?>
    <ul><?php foreach ($tasks as $task): ?>
        <li>
            <strong><?= esc($task['title']) ?></strong> — <?= esc($task['status']) ?> — <?= esc($task['task_date']) ?>
            <?php if (session('tsa2_user_id')): ?>
                <a href="/TSA2/tasks/<?= $task['id'] ?>/edit">Edit</a>
                <form class="task-actions" method="post" action="/TSA2/tasks/<?= $task['id'] ?>/delete">
                    <button type="submit">Delete</button>
                </form>
            <?php endif; ?>
        </li>
    <?php endforeach; ?></ul>
<?php endif; ?>
<hr>
<nav><a href="/TSA2/index">Today</a> | <a href="/TSA2/profile">Profile</a> | <a href="/TSA2/about">About</a> | <a href="/TSA2/index">Back</a> |
<?php if (session('tsa2_user_id')): ?><a href="/TSA2/logout">Logout</a><?php else: ?><a href="/TSA2/login">Login</a> | <a href="/TSA2/register">Register</a><?php endif; ?></nav>
</main>
</body>
</html>
