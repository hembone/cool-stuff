<?php
$title = 'Test';
require('layouts/header.php');
?>

<div class="row">
	<div class="small-12 columns">
		<h2>MySQL Test</h2>
		<form id="mysql_form" method="post" action="/mini_site/test">
			<input type="text" name="name" placeholder="Name" /><br/>
			<input type="text" name="color" placeholder="Color" /><br/>
			<button type="submit"><i class="fa fa-lock"></i>&nbsp;&nbsp;Save</button>
		</form>
	</div>
</div>


<?php
require('layouts/footer.php');
?>