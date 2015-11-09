<?php
$this->title='Reset Password';
$this->useTemplate('auth');
?>

<?php if(isset($_GET['key']) && $AUTH->resetKeyValid($_GET['key'])): ?>

<form id="reset-form" method="post" action="#">
	<input type="hidden" name="resetId" value="<?php echo $_GET['key']; ?>"/>
	<input type="text" name="password" placeholder="Password"/><br/>
	<input type="text" name="password2" placeholder="Re-type Password"/><br/>
	<button type="submit">Save</button>
</form>

<?php else: ?>

<h4>You're link has expired.</h4>
<a href="/forgot-password">Send another link</a>

<?php endif; ?>
