<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Register</title></head>
<body>
<h1>Create an Account</h1>
<?php if (isset($error)): ?><p role="alert"><?= esc($error) ?></p><?php endif; ?>
<?php if (isset($validation)): ?><p><?= esc($validation->listErrors()) ?></p><?php endif; ?>
<form method="post" action="/TSA2/register">
    <label>Username <input type="text" name="username" value="<?= esc(old('username')) ?>" required></label><br>
    <label>Full name <input type="text" name="full_name" value="<?= esc(old('full_name')) ?>" required></label><br>
    <label>Email <input type="email" name="email" value="<?= esc(old('email')) ?>" required></label><br>
    <label>Password <input type="password" name="password" required></label><br>
    <label>Confirm password <input type="password" name="password_confirm" required></label><br>
    <button type="submit">Register</button>
</form>
<p><a href="/TSA2/login">Already have an account? Log in</a></p>
<p><a href="/TSA2/index">Back</a></p>
</body>
</html>
