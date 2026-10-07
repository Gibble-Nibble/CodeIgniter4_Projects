<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <?php include APPPATH . 'Views/TSA2/_styles.php'; ?>
</head>
<body>
<main>
<h1>Profile</h1>
<?php if (session('success')): ?><p class="toast" role="status"><?= esc(session('success')) ?></p><?php endif; ?>
<?php if ($user): ?>
<p><strong>Username:</strong> <?= esc($user['username']) ?></p>
<p><strong>Full Name:</strong> <?= esc($user['full_name']) ?></p>
<p><strong>Email:</strong> <?= esc($user['email']) ?></p>
<?php else: ?><p>No user found.</p><?php endif; ?>
<p><a href="/TSA2/index">Today</a> | <a href="/TSA2/tasks">All Tasks</a> | <a href="/TSA2/about">About</a> | <a href="/TSA2/index">Back</a></p>
</main>
</body>
</html>
