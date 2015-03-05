<?php
$title = $_SERVER['HTTP_HOST'].' | MySQL Test';
$body_class = '';
require('includes/top.php');
require('includes/header.php');
require('includes/nav.php');
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
require('includes/footer.php');
require('includes/scripts.php');
require('includes/bottom.php');
?>