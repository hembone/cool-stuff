<div id="navigation">
	<a href="https://www.google.com/" target="_blank">Home</a>
<?php if($AUTH->isLoggedIn()): ?>
	<a href="/">Dashboard</a>
	<a href="/create-profile">Create Profile</a>
	<a href="#" onclick="app.global.sendToApi('logout','',app.logoutCallback);return false;">Logout</a>
<?php else: ?>
	<a href="/login">Login</a>
<?php endif; ?>
</div><!-- end #navigation -->