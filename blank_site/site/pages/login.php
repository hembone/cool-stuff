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
	<input name="email" type="text" placeholder="Email"/>
	<input name="password" type="password" placeholder="Password"/>
	<a href="/forgot-password">Forgot Password?</a>
	<input id="remember" name="remember" type="checkbox" value="1"/> Remember Me
	<button type="submit">Login</button>
</form>

<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
?>
<script type="text/javascript">
$(function() {
	$('#login_form').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			method: "POST"
			,url: "/api"
			,data: { action: "login", data: $(this).serializeArray() }
			,dataType: "json"
		})
		.done(function(res) {
			console.log(res);
			if(res.success) {
				
			} else {
				
			}
		});
	});
});
</script>
<?php
	require('includes/bottom.php');
}
?>