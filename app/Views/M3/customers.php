<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts</title>
</head>
<body>
    <nav>
        <a href="/M3/index">Module 3</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a> |
        <a href="/customers/new">Add customer</a>
    </nav>

    <h1>Customer Accounts</h1>

    <?php if ($message !== null): ?>
        <p><?= esc($message) ?></p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr><th>Full name</th><th>Email</th><th>Phone</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone'] ?? '') ?></td>
                    <td><a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
