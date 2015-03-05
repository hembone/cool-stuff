<?php
$mysql = true;

switch($_SERVER['HTTP_HOST']) {
	case 'mini-site.com':
	case 'www.mini-site.com':
		if($mysql){
			define("MYSQL_HOST", "");
			define("MYSQL_NAME", "");
			define("MYSQL_USER", "");
			define("MYSQL_PASS", "");
			require_once 'libs/mysqlHelper_class.php';
			$db = new mysqlHelper();
		}
		break;
	default:
		if($mysql){
			define("MYSQL_HOST", "localhost");
			define("MYSQL_NAME", "mini_site");
			define("MYSQL_USER", "root");
			define("MYSQL_PASS", "root");
			require_once 'libs/mysqlHelper_class.php';
			$db = new mysqlHelper();
		}
}
?>