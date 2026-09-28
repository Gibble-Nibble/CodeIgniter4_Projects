<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($heading) ?></title>
</head>
<body>
    <p><a href="<?= site_url('customers') ?>">Customer Accounts</a> | <a href="<?= site_url('users') ?>">User Accounts</a></p>
    <h1><?= esc($heading) ?></h1>

    <?php if ($errors !== []): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= esc($formAction) ?>" method="post">
        <?= csrf_field() ?>

        <label for="full_name">Full name</label>
        <input id="full_name" name="full_name" type="text" value="<?= esc($customer['full_name'] ?? '') ?>" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?= esc($customer['email'] ?? '') ?>" required>

        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="text" value="<?= esc($customer['phone'] ?? '') ?>">

        <button type="submit">Save customer</button>
    </form>
</body>
</html>
