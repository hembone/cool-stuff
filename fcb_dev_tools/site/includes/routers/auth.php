<?php
//unset($_SESSION[APP_KEY]);

// Options
$exceptions = array(
	'404'
	,'api'
	,'login'
	,'create-profile'
	,'forgot-password'
	,'forgot-password-reset'
	,'age-gate'
	,'age-gate-fail'
);
$allow_trust = false;
$allow_bots = false;
$valid_bots = [];

// Logic
if(!in_array($this->page, $exceptions)) {
	$goto_login = true;

	// Allow Trust
	if($allow_trust) {
		if(isset($_GET['trust']) && $_GET['trust']=='yes') {
			$goto_login = false;
		}
	}

	// Allow Bots
	if($allow_bots) {
		$valid_bot = false;
		foreach($valid_bots as $bot) {
			if(stristr($_SERVER['HTTP_USER_AGENT'], $bot)) {
				$valid_bot = true;
			}
		}
		if($valid_bot) {
			$goto_login = false;
		}
	}

	// Check for Cookie
	if(isset($_COOKIE['cookie_id'])) {
		$user = $AUTH->getUserByCookieId($_COOKIE['cookie_id']);
		if($user) {
			$AUTH->setSession($user);
		}
	}

	// Check for Session
	if(isset($_SESSION[APP_KEY])) {
		$goto_login = false;
	}

	// Redirect
	if($goto_login) {
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/login");exit;
	}
}
?>
