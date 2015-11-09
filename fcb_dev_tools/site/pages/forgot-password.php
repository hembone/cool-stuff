<?php
$this->title='Forgot Password';
$this->useTemplate('auth');
?>

<form id="forgot-form" method="post" action="#">
	<input type="text" name="email" placeholder="Email" value="<?php echo (isset($_SESSION[APP_KEY]['email'])?$_SESSION[APP_KEY]['email']:''); ?>"/>
	<button type="submit">Send</button>
</form>
