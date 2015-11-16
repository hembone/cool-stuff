<?php
$this->title='Home';
$AUTH = new authHelper();
?>

<?php if($AUTH->allowedTypes('pm')): ?>
    Project Manager
<?php endif; ?>

<?php if($AUTH->allowedTypes('create')): ?>
    Creative
<?php endif; ?>

<?php if($AUTH->allowedTypes('dm')): ?>
    Development Manager
<?php endif; ?>

<?php if($AUTH->allowedTypes('dev')): ?>
    Developer
<?php endif; ?>

<?php if($AUTH->allowedTypes('admin')): ?>
    Administrator
<?php endif; ?>
