<!DOCTYPE html>
<html>
<head>
    <title>Tasks for Today</title>
</head>
<body>

    <h1>Tasks for Today</h1>

    <?php if (empty($tasks)): ?>
        <p>No tasks for today.</p>
    <?php else: ?>

        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?= esc($task['title']) ?></strong>
                    — <?= esc($task['status']) ?>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

    <hr>

    <nav>
        <a href="/tasks">All Tasks</a> |
        <a href="/profile">Profile</a> |
        <a href="/about">About</a>
    </nav>

</body>
</html>