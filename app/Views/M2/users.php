<!DOCTYPE html>
<html>
<head>
    <title>User Accounts - POS System</title>
</head>
<body>
    <h1>User Accounts</h1>

    <nav>
        <a href="/M2/index">Home</a> |
        <a href="/M2/about">About</a> |
        <a href="/M2/customers">Customers</a> |
        <a href="/M2/users">Users</a>
        <a href="/">Go back</a>
    </nav>

    <table border="1">
        <tr>
            <th>Username</th>
            <th>Full Name</th>
            <th>Created At</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td><?= esc($user['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>