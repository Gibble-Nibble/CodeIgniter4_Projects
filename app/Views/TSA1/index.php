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
        <a href="/TSA1/tasks">All Tasks</a> |
        <a href="/TSA1/profile">Profile</a> |
        <a href="/TSA1/about">About</a>
        <a href="/">get me out</a>
    </nav>

</body>
</html>