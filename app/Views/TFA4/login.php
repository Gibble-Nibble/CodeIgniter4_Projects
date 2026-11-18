<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TFA4 POS Login</title>
    <?php include APPPATH . 'Views/_styles.php'; ?>
</head>
<body>
    <h1>TFA4 POS Staff Login</h1>

    <?php if (session('error')): ?>
        <p role="alert"><?= esc(session('error')) ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p role="alert"><?= esc($error) ?></p>
    <?php endif; ?>
    <?php if (isset($errors) && $errors !== []): ?>
        <ul>
            <?php foreach ($errors as $message): ?>
                <li><?= esc($message) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= site_url('TFA4/login') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="<?= esc(old('username')) ?>" autocomplete="username" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>

        <button type="submit">Log in</button>
    </form>
    <p><a href="<?= site_url('TFA4/index') ?>">Back to POS</a></p>
</body>
</html>
