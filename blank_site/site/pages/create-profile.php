<?php
$title = 'Create Profile';
$body_class = 'create-profile';

if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
	require('includes/navigation.php');
}
?>

<form id="create_form" method="post" action="/">

	<div><input name="fname" type="text" placeholder="First Name*"/></div>
	<div><input name="lname" type="text" placeholder="Last Name*"/></div>
	<div><input name="email" type="text" placeholder="Email*"/></div>
	<div><input name="password" type="password" placeholder="Password"/></div>
	<div><input name="password2" type="password" placeholder="Re-type Password"/></div>

	<button type="submit">Create Profile</button>
	<div class="error-message"></div>

</form>

<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
	require('includes/bottom.php');
}
?>