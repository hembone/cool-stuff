<?php
session_start();
require_once('includes/configs.php');
if(isset($_GET['page']) && $_GET['page']!='') {
	$get_page = explode('.', $_GET['page']);
	$page = $get_page[0];
} else {
	$page = 'home';
}

$the_page = 'pages/'.$page.'.php';

// 404 page
if(!file_exists($the_page)) {
	exit(require('pages/404.php'));
}

// age gate router
if(USE_AGEGATE) {
	require_once('includes/routers/agegate.php');
}

// site status router
if(USE_SITESTATUS) {
	require_once('includes/routers/sitestatus.php');
}

// authorization router
if(USE_AUTH) {
	require_once('includes/routers/auth.php');
}

// stateless loading
if(USE_STATELESS) {
	if(isset($_GET['ajax'])) {
		ob_start();
		require($the_page);
		$page = ob_get_clean();
		$ajax = new stdClass();
		$ajax->title = $title;
		$ajax->classes = $body_class;
		$ajax->page = $page;
		if(isset($scripts)) {
			$ajax->scripts = $scripts;
		}
		echo json_encode($ajax);
	} else {
		require($the_page);
	}
} else {
	require($the_page);
}

?>