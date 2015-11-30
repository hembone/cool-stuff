<div class="container-fluid">
<?php if($AUTH->isLoggedIn()): ?>
<div class="pull-right">Hi <?php echo $_SESSION[APP_KEY]['fname']; ?>, <a id="logout" href="#">Logout</a></div>
<?php endif; ?>
<a id="site-logo" href="/">Campaign Manager</a>
</div>
