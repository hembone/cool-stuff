<?php
$title = 'Login';
$body_class = 'login';

if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
	require('includes/navigation.php');
}
?>

<form id="login_form" method="post" action="/">

	<div><input name="email" type="text" placeholder="Email"/></div>
	<div><input name="password" type="password" placeholder="Password"/></div>
	<div><a href="/forgot-password">Forgot Password?</a></div>
	<div><input id="remember" name="remember" type="checkbox" value="1"/> Remember Me</div>

	<button type="submit">Login</button>
	<div class="error-message"></div>

</form>

<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
	require('includes/bottom.php');
}
?>