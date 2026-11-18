<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($heading) ?></title>
    <?php include APPPATH . 'Views/_styles.php'; ?>
</head>
<body>
    <nav>
        <a href="/M3/index">Module 3</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a>
    </nav>

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
