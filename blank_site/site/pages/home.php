<?php
$title = 'Page Title';
$body_class = 'home';

if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
	require('includes/navigation.php');
}
?>

Home


<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
	/* additional Scripts go here */
	require('includes/bottom.php');
}
?>