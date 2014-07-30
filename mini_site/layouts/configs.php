<?php
$mysql = true;

if($mysql){
	define("MYSQL_HOST", "localhost");
	define("MYSQL_NAME", "mini_site");
	define("MYSQL_USER", "root");
	define("MYSQL_PASS", "");
	require_once 'libs/mysqlHelper_class.php';
	$db = new mysqlHelper();
}
?>