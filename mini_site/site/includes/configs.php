<?php
session_start();

// Define Globals
$protocol = (strpos($_SERVER['SERVER_PROTOCOL'],'https')?'https://':'http://');
define("BASE_URL", $protocol.$_SERVER['HTTP_HOST']);

// Environment Globals
switch($_SERVER['HTTP_HOST']) {
	case "mini-site.dev":
		define("ENV", "dev");
		define("DEBUG_MODE", true);
		break;
	default:
		define("ENV", "prod");
		define("DEBUG_MODE", false);
}

// Debug Mode
if(DEBUG_MODE) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
} else {
	error_reporting(0);
	ini_set('display_errors', '0');
}

require_once 'libs/theFramework_class.php';
$TFW = new theFramework();
$TFW->init();

?>