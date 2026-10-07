<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php include APPPATH . 'Views/TSA2/_styles.php'; ?>
</head>
<body>
<main>
<h1>Login</h1>
<?php if (isset($error)): ?><p class="error"><?= esc($error) ?></p><?php endif; ?>
<?php if (session('success')): ?><p class="toast" role="status"><?= esc(session('success')) ?></p><?php endif; ?>
<?php if (isset($validation)): ?><p><?= esc($validation->listErrors()) ?></p><?php endif; ?>
<form method="post" action="/TSA2/login">
    <label>Username <input type="text" name="username" value="<?= esc(old('username')) ?>" required></label><br>
    <label>Password <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>
<p><a href="/TSA2/register">Create an account</a></p>
<p><a href="/TSA2/index">Back</a></p>
</main>
</body>
</html>
