<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
</head>
<body>

    <h1>Task List</h1>

    <?php if (empty($tasks)): ?>

        <p>No tasks found.</p>

    <?php else: ?>

        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?= esc($task['title']) ?></strong>
                    — <?= esc($task['status']) ?>
                    — <?= esc($task['task_date']) ?>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

    <hr>

    <nav>
        <a href="/TSA1/index">Today</a> |
        <a href="/TSA1/profile">Profile</a> |
        <a href="/TSA1/about">About</a>
        <a href="/">get me out</a>
    </nav>

</body>
</html>