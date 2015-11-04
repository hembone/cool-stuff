<?php
session_start();
date_default_timezone_set('America/Chicago');

// Define Globals
define("USE_DB", true);
define("USE_AUTH", true);
$protocol = (strpos($_SERVER['SERVER_PROTOCOL'],'https')?'https://':'http://');
define("BASE_URL", $protocol.$_SERVER['HTTP_HOST']);
define("APP_KEY", "RHS5KTe3Ywa8WRUg");
define("API_KEY", "mACRQX6bPvw26xqm");

// Environment Globals
switch($_SERVER['HTTP_HOST']) {
	case "fcb-dev-tools.dev":
		define("ENV", "dev");
		define("DEBUG_MODE", true);
		if(USE_DB) {
			define("MYSQL_HOST", "localhost");
			define("MYSQL_NAME", "fcb_tools_db");
			define("MYSQL_USER", "root");
			define("MYSQL_PASS", "root");
		}
		break;
	default:
		define("ENV", "prod");
		define("DEBUG_MODE", false);
		if(USE_DB) {
			define("MYSQL_HOST", "");
			define("MYSQL_NAME", "");
			define("MYSQL_USER", "");
			define("MYSQL_PASS", "");
		}
}

// Debug Mode
if(DEBUG_MODE) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
} else {
	error_reporting(0);
	ini_set('display_errors', '0');
}

// Use Database
if(USE_DB) {
	require_once 'libs/mysqlHelper_class.php';
}

// Initiate the APP Helper
require_once 'libs/appHelper_class.php';

// Initiate the Framework
require_once 'libs/theFramework_class.php';
$TFW = new theFramework();
$TFW->init();
?>
