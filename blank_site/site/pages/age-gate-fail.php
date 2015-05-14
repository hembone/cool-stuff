<?php
$title = 'Straight Shot | Age Gate';
$body_class = 'age-gate-fail';
if(!isset($_GET['ajax'])) {
	require('includes/top.php');
	require('includes/header.php');
}
?>

<div class="outer-wrapper">
	<div class="page-wrapper">
		<div class="blackbg">
			<div class="sitewidth">
			
				<br/><br/><br/>
				<h1>DOESN’T ADD UP TO 21+</h1>
				<br/><br/><br/>
			
			</div>
		</div>
	</div>
</div>


<?php
if(!isset($_GET['ajax'])) {
	require('includes/footer.php');
	require('includes/scripts.php');
	/* additional Scripts go here */
	require('includes/bottom.php');
}
?>