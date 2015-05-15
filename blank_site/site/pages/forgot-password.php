<?php
$title = 'Forgot Password';
$body_class = 'forgot-password';
if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
}
?>

<div class="outer-wrapper">
	<div class="page-wrapper">
		<div class="blackbg">
			<div class="sitewidth">
				<h5>Forgot password?</h5>
				<br/><br/><br/>
<form id="forgot_form" method="post" action="/">
	<input type="text" name="email" placeholder="Email" value="<?php echo (isset($_SESSION[APP_KEY]['email'])?$_SESSION[APP_KEY]['email']:''); ?>"/>
	<br/><br/><br/>
	<div class="buttoncontainer overlaybutton middle">
		<button type="submit">Send<span class="icon-arrowR4 ico-after"></span></button>
	</div>
</form>
			</div>
		</div>
	</div>
</div>

<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
}
?>
<script type="text/javascript">
$(function() {
	$('#forgot_form').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			method: "POST"
			,url: "/api"
			,data: { action: "forgot-password", data: $(this).serializeArray() }
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
if(!isset($_GET['ajax'])) {
	require('includes/bottom.php');
}
?>