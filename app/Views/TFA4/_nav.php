<nav>
    <a href="/">Project archive</a> |
    <a href="/TFA4/index">TFA4 POS</a> |
    <a href="<?= site_url('TFA4/customers') ?>">Customer Accounts</a> |
    <a href="<?= site_url('TFA4/users') ?>">User Accounts</a>
    <?php if (session()->has('tfa4_user_id')): ?>
        | Signed in as <?= esc(session('tfa4_username')) ?>
        <form action="<?= site_url('TFA4/logout') ?>" method="post" style="display:inline">
            <?= csrf_field() ?>
            <button type="submit">Log out</button>
        </form>
    <?php else: ?>
        | <a href="/TFA4/login">Staff login</a>
    <?php endif; ?>
</nav>
