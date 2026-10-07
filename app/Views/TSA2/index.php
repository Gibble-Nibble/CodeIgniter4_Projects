<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Tasks for Today</title></head>
<body>
<h1>Tasks for Today</h1>
<?php if (empty($tasks)): ?>
    <p>No tasks for today.</p>
<?php else: ?>
    <ul><?php foreach ($tasks as $task): ?>
        <li><strong><?= esc($task['title']) ?></strong> — <?= esc($task['status']) ?></li>
    <?php endforeach; ?></ul>
<?php endif; ?>
<hr>
<nav>
    <a href="/TSA2/tasks">All Tasks</a> |
    <a href="/TSA2/profile">Profile</a> |
    <a href="/TSA2/about">About</a> |
    <?php if (session('tsa2_user_id')): ?><a href="/TSA2/logout">Logout</a><?php else: ?><a href="/TSA2/login">Login</a> | <a href="/TSA2/register">Register</a><?php endif; ?>
</nav>
</body>
</html>