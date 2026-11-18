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

    <form action="<?= esc($formAction) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="<?= esc($user['username'] ?? '') ?>" required>

        <label for="full_name">Full name</label>
        <input id="full_name" name="full_name" type="text" value="<?= esc($user['full_name'] ?? '') ?>" required>

        <label for="avatar">Profile picture (JPG or PNG, maximum 2MB)</label>
        <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png">

        <?php if (! empty($user['avatar'])): ?>
            <p>Current avatar:</p>
            <img src="<?= base_url('uploads/' . rawurlencode($user['avatar'])) ?>" alt="Current avatar" width="120" height="120">
        <?php endif; ?>

        <button type="submit">Save user</button>
    </form>
</body>
</html>
