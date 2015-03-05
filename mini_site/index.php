<?php
require_once('layouts/configs.php');
if(isset($_GET['page']) && $_GET['page']!='') {
	$get_page = explode('.', $_GET['page']);
	$page = $get_page[0];
} else {
	$page = 'home';
}
$the_page = 'pages/'.$page.'.php';
require($the_page);
?>