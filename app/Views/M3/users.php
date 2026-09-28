<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
</head>
<body>
    <nav>
        <a href="/M3/index">Module 3</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a> |
        <a href="/users/new">Add user</a>
    </nav>

    <h1>User Accounts</h1>

    <?php if ($message !== null): ?>
        <p><?= esc($message) ?></p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr><th>Avatar</th><th>Username</th><th>Full name</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <img src="<?= base_url('uploads/' . rawurlencode($user['avatar'] ?? 'avatar-placeholder.svg')) ?>"
                            alt="<?= esc($user['full_name']) ?> avatar" width="80" height="80">
                    </td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
