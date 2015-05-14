<?php
//unset($_SESSION['age_gate']);
//unset($_SESSION['intended']);
if(isset($_POST['age']) && !empty($_POST['age']['month']) && !empty($_POST['age']['day']) && !empty($_POST['age']['year'])) {
	$birthdate = mktime(0,0,0,$_POST['age']['month'],$_POST['age']['day'],$_POST['age']['year']);
	$check_date = mktime(0,0,0,date('n'),date('j'),date('Y')-21);
	if($birthdate <= $check_date) {
		$time = 0;
		if(isset($_POST['remember'])) {
			$time = mktime(0, 0, 0, date('m'), date('d'), date('Y')+1);
		}
		setcookie('age_gate', 1, $time);
		if(isset($_SESSION['intended'])) {
			$intended = $_SESSION['intended'];
			unset($_SESSION['intended']);
			header("Location: " . "http://" . $intended);exit;
		} else {
			header("Location: " . "http://" . $_SERVER['HTTP_HOST']);exit;
		}
	} else {
		setcookie('age_failed', 1, time()+3600);
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/age-gate-fail");exit;
	}
}
if($page != 'age-gate-fail' && isset($_COOKIE['age_failed'])) {
	header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/age-gate-fail");exit;
}
if(isset($_COOKIE['age_gate'])) {
	$_SESSION['age_gate'] = 1;
}
if(ALLOW_TRUST) {
	if(isset($_GET['trust']) && $_GET['trust']=='yes') {
		$_SESSION['age_gate'] = 1;
	}
}
if(ALLOW_BOTS) {
	$valid_bot = false;
	foreach(VALID_BOTS as $bot) {
		if(stristr($_SERVER['HTTP_USER_AGENT'], $bot)) {
			$valid_bot = true;
		}
	}
	if($valid_bot) {
		$_SESSION['age_gate'] = 1;
	}
}
if($page != 'age-gate-fail' && $page != 'age-gate') {
	if(!isset($_SESSION['age_gate'])) {
		if(!isset($_SESSION['intended'])) {
			$_SESSION['intended'] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/age-gate");exit;
	}
}
?>