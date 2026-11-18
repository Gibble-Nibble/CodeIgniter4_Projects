<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts</title>
    <?php include APPPATH . 'Views/_styles.php'; ?>
</head>
<body>
    <?php include APPPATH . 'Views/TFA4/_nav.php'; ?>
    <p><a href="/customers/new">Add customer</a></p>

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
