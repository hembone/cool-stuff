<?php
if($page != 'age-gate-fail' && $page != 'age-gate') {
	switch(SITE_STATUS) {
		case "pre":
			if($page != 'home-pre') {
				header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/home-pre");exit;
			}
			$the_page = 'pages/home-pre.php';
			break;
		case "post":
			if($page != 'home-post') {
				header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/home-post");exit;
			}
			$the_page = 'pages/home-post.php';
			break;
	}
}
?>