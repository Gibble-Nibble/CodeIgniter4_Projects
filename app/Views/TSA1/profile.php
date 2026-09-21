<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>

    <h1>Profile</h1>

    <?php if ($user): ?>

        <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
        <p><strong>Full Name:</strong> <?= esc($user['full_name']) ?></p>
        <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
        <p><strong>Created At:</strong> <?= esc($user['created_at']) ?></p>

    <?php else: ?>

        <p>No user found.</p>

    <?php endif; ?>

    <hr>

    <nav>
        <a href="/TSA1/index">Today</a> |
        <a href="/TSA1/tasks">All Tasks</a> |
        <a href="/TSA1/about">About</a>
    </nav>

</body>
</html>