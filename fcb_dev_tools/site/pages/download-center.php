<?php
$this->title='Downloads';
$AUTH = new authHelper();
?>

<?php if($AUTH->allowedTypes('pm')): ?>
    Project manager
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
    <a href="[download me]" target="_blank">Item 1</a></br>
    <a href="[download me]" target="_blank">Item 2</a></br>
    <a href="[download me]" target="_blank">Item 3</a></br>
    <a href="[download me]" target="_blank">Item 4</a></br>
    <a href="[download me]" target="_blank">Item 5</a></br>
<?php endif; ?>
