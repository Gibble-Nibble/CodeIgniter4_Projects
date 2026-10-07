<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title><?= esc($title) ?></title></head>
<body>
<h1><?= esc($title) ?></h1>
<?php if (isset($validation)): ?><p><?= esc($validation->listErrors()) ?></p><?php endif; ?>
<?php $task = $task ?? []; ?>
<form method="post" action="<?= esc($action) ?>">
    <label>Title <input type="text" name="title" value="<?= esc($task['title'] ?? '') ?>" required></label><br>
    <label>Status <input type="text" name="status" value="<?= esc($task['status'] ?? 'Pending') ?>"></label><br>
    <label>Task date <input type="date" name="task_date" value="<?= esc($task['task_date'] ?? '') ?>" required></label><br>
    <button type="submit">Save</button>
</form>
<p><a href="/TSA2/tasks">Cancel</a> | <a href="/">Get me out</a></p>
</body>
</html>
