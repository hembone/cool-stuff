<?php
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_REQUEST['key']) && $_REQUEST['key']==API_KEY) {
	switch($_REQUEST['action']) {
		case 'get-categories':
			$APP = new appHelper();
			$result = $APP->getCategories('');
			if($result) {
				exit(json_encode(array('success'=>true, 'categories'=>$result)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'new-category':
			$APP = new appHelper();
			$result = $APP->newCategory(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'get-lorem':
			$APP = new appHelper();
			$result = $APP->getLorem();
			if($result) {
				exit(json_encode(array('success'=>true, 'w'=>$_POST['data']['w'], 'h'=>$_POST['data']['h'], 'url'=>$_POST['data']['url'], 'lorem'=>$result)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'search-twitter':
			$APP = new appHelper();
			$result = $APP->searchTwitter(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true, 'result'=>$result)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
	}
} else {
	exit( json_encode(array('success'=>false, 'message'=>'this action is not supported')) );
}

// Format data from serializeArray()
function format_data($data) {
	$form_data = array();
	foreach($data as $v) {
		$form_data[$v['name']] = $v['value'];
	}
	return $form_data;
}
?>
