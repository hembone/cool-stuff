<?php

header('HTTP/1.0 404 Not Found');

$title = 'Summer Swarm | 404';

$body_class = 'error-404';

if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
}

?>

<div class="outer-wrapper">
	<div class="page-wrapper">
		
		<div class="bt tbg"></div>
		
		<div class="blackbg">
		
			<div id="error-404">
				<h1>404</h1>
				<h4>Bummer In the Summer</h4>
				<p>Something went wrong. Go back or refresh to keep swarmin'.</p>
				
				<div class="buttoncontainer middle overlaybutton small">
					<a href="/">back home <span class="icon-arrowR4 ico-after"></span></a>
				</div>
			</div>
			
		</div><!--/.yellowbg-->
		

	</div><!--/.outer-wrapper-->
</div><!--/.page-wrapper-->

<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	//require('includes/scripts.php');
	/* additional Scripts go here */
	require('includes/bottom.php');
}
?>