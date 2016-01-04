<div class="container-fluid">
<?php if($AUTH->isLoggedIn()): ?>
<div class="pull-right">Hi <?php echo $_SESSION[APP_KEY]['fname']; ?>, <a id="logout" href="#">Logout</a></div>
<?php endif; ?>
<div class="nav-wrap">
    <a id="site-logo" href="/"><img src="/img/main-logo.jpg"/></a>
</div>
</div>
