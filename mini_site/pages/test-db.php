<?php
$title = $_SERVER['HTTP_HOST'].' | MySQL Test';
$body_class = '';
require('layouts/top.php');
require('layouts/header.php');
require('layouts/nav.php');
?>

<?php
if(isset($_POST['name']) && isset($_POST['color'])) {
	$sql = "INSERT INTO test (name, color) VALUES (:name, :color)";
	$params = array(
		array(':name', $_POST['name'])
		,array(':color', $_POST['color'])
	);
	$results = $db->query($sql, $params);
	if($results['error']) {
		echo'<pre>'.print_r($results,true).'</pre>';
	} else {
		echo 'Success';
	}
}
?>

<h2>MySQL Test</h2>
<form id="mysql_form" method="post" action="test-db">
	<input type="text" name="name" placeholder="Name" /><br/>
	<input type="text" name="color" placeholder="Color" /><br/>
	<button type="submit">Save</button>
</form>


<?php
require('layouts/footer.php');
require('layouts/scripts.php');
require('layouts/bottom.php');
?>