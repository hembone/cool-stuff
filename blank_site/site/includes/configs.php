<?php

// Define Globals
define("USE_DB", true);
define("USE_AGEGATE", false);
define("USE_SITESTATUS", false);
define("USE_AUTH", true);
define("USE_STATELESS", false);
define("APP_KEY", "4c33b2c71f4356bf9b8c9d8b2e9d25ba0a8d0a67");
define("ALLOW_BOTS", true);
$valid_bot_list = array(
	'googlebot'
	,'facebot'
	,'facebookexternalhit'
	,'twitterbot'
);
define("VALID_BOTS", $valid_bot_list);

// Environment Globals
switch($_SERVER['HTTP_HOST']) {
	case "blank-site.dev":
		define("ENV", "staging");

		define("MYSQL_HOST", "localhost");
		define("MYSQL_NAME", "swarm_db");
		define("MYSQL_USER", "root");
		define("MYSQL_PASS", "root");
		break;

	case "jdswarmdev.fcbchicago.net":
		define("ENV", "staging");

		define("MYSQL_HOST", "127.0.0.1");
		define("MYSQL_NAME", "swarmdev_db");
		define("MYSQL_USER", "root");
		define("MYSQL_PASS", "fcbdev123");
		break;

	case "jdswarm.fcbchicago.net":
		define("ENV", "staging");

		define("MYSQL_HOST", "127.0.0.1");
		define("MYSQL_NAME", "swarm_db");
		define("MYSQL_USER", "root");
		define("MYSQL_PASS", "fcbdev123");
		break;

	default:
		if(getenv('APPLICATION_ENV') == 'staging') {
			define("ENV", "staging");

			define("MYSQL_HOST", "");
			define("MYSQL_NAME", "");
			define("MYSQL_USER", "");
			define("MYSQL_PASS", "");
		} else {
			define("ENV", "production");

			define("MYSQL_HOST", "");
			define("MYSQL_NAME", "");
			define("MYSQL_USER", "");
			define("MYSQL_PASS", "");
		}

}

// MySQL Helper
if(USE_DB) {
	require_once 'libs/mysqlHelper_class.php';
	$DB = new mysqlHelper();
	$conn = $DB->connect();
}

// Auth Helper
if(USE_AUTH) {
	require_once 'libs/authHelper_class.php';
	$AUTH = new authHelper();
}

// Get SITE_STATUS
if(USE_DB && USE_SITESTATUS) {
	$sql = "SELECT value FROM settings WHERE name = :name";
	$params = array(
		array(':name', 'status')
	);
	$status = $DB->query($conn, $sql, $params);
	define("SITE_STATUS", $status['results'][0]);
}

?>
