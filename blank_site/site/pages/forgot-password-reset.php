<?php
$title = 'Summer Swarm | Reset Password';
$body_class = 'reset-password';
if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
}
?>

<div class="outer-wrapper">
	<div class="page-wrapper">
		<div class="blackbg">
			<div class="sitewidth">
			<br /><br /><br />
			<?php if(isset($_GET['key']) && $AUTH->resetKeyValid($_GET['key'])): ?>
	
			<form id="reset_form" method="post" action="/">
				<input type="hidden" name="resetId" value="<?php echo $_GET['key']; ?>"/>
				<input type="text" name="password" placeholder="Password"/><br/>
				<input type="text" name="password2" placeholder="Re-type Password"/><br/>
				<button type="submit">Save</button>
			</form>
	
			<?php else: ?>
	
			<h4>You're link has expired.</h4>
			<div class="buttoncontainer middle overlaybutton">
				<a href="/forgot-password">Send another link</a>
			</div>
	
			<?php endif; ?>
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
	$('#reset_form').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			method: "POST"
			,url: "/api"
			,data: { action: "reset-password", data: $(this).serializeArray() }
			,dataType: "json"
		})
		.done(function(res) {
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