<?php
$this->title='Home';
$AUTH = new authHelper();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 home-links">

            <?php if($AUTH->allowedTypes('pm')): ?>
                <a href="/banner-tester"><i class="fa fa-bug"></i> Banner Tester</a>
                <a href="/download-center"><i class="fa fa-download"></i> Download Center</a>
            <?php endif; ?>

            <?php if($AUTH->allowedTypes('create')): ?>
                <a href="/banner-tester"><i class="fa fa-bug"></i> Banner Tester</a>
                <a href="/download-center"><i class="fa fa-download"></i> Download Center</a>
            <?php endif; ?>

            <?php if($AUTH->allowedTypes('dm')): ?>
                <a href="/email-builder"><i class="fa fa-puzzle-piece"></i> Email Builder</a>
                <a href="/email-manage"><i class="fa fa-cog"></i> Manage Email Builder</a>
                <a href="/banner-tester"><i class="fa fa-bug"></i> Banner Tester</a>
                <a href="/download-center"><i class="fa fa-download"></i> Download Center</a>
                <a href="/create-profile"><i class="fa fa-user"></i> Create a Profile</a>
            <?php endif; ?>

            <?php if($AUTH->allowedTypes('dev')): ?>
                <a href="/email-builder"><i class="fa fa-puzzle-piece"></i> Email Builder</a>
                <a href="/email-manage"><i class="fa fa-cog"></i> Manage Email Builder</a>
                <a href="/banner-tester"><i class="fa fa-bug"></i> Banner Tester</a>
                <a href="/download-center"><i class="fa fa-download"></i> Download Center</a>
            <?php endif; ?>

            <?php if($AUTH->allowedTypes('admin')): ?>
                <a href="/email-builder"><i class="fa fa-puzzle-piece"></i> Email Builder</a>
                <a href="/email-manage"><i class="fa fa-cog"></i> Manage Email Builder</a>
                <a href="/banner-tester"><i class="fa fa-bug"></i> Banner Tester</a>
                <a href="/download-center"><i class="fa fa-download"></i> Download Center</a>
                <a href="/create-profile"><i class="fa fa-user"></i> Create a Profile</a>
            <?php endif; ?>

        </div>
    </div>
</div>
