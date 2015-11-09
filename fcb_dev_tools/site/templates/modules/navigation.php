<div class="container-fluid">
<?php if($AUTH->isLoggedIn()): ?>
<div class="pull-right">Hi <?php echo $_SESSION[APP_KEY]['fname']; ?>, <a id="logout" href="#">Logout</a></div>
<?php endif; ?>
<ul class="nav nav-pills main-nav">
    <li class="<?php echo (empty($_GET['page'])?'active':''); ?>"><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="dropdown <?php echo ((isset($_GET['page'])&&$_GET['page']=='email-builder')||(isset($_GET['page'])&&$_GET['page']=='email-manage')?'active':''); ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-puzzle-piece"></i> Email Builder <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='email-builder'?'active':''); ?>"><a href="/email-builder"><i class="fa fa-puzzle-piece"></i> Build</a></li>
            <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='email-manage'?'active':''); ?>"><a href="/email-manage"><i class="fa fa-cog"></i> Manage</a></li>
        </ul>
    </li>
    <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='banner-tester'?'active':''); ?>"><a href="/banner-tester"><i class="fa fa-bug"></i> Banner Tester</a></li>
    <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='download-center'?'active':''); ?>"><a href="/download-center"><i class="fa fa-download"></i> Download Center</a></li>
    <?php if($AUTH->allowedTypes('admin')): ?>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> Settings <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='create-profile'?'active':''); ?>"><a href="/create-profile"><i class="fa fa-user"></i> Create Profile</a></li>
        </ul>
    </li>
    <?php endif; ?>
</ul>
</div>
