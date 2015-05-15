<?php
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['action'])) {
	switch($_POST['action']) {
		case 'add-user':
			if(!$AUTH->isLoggedIn()) {
				$form_data = format_data($_POST['data']);
				$user = $AUTH->getUserByEmail($form_data['email']);
				$results = NULL;
				if(!$user['id']) {
					$results = $AUTH->addUser($form_data);
					if($results['error']){
						exit( json_encode(array('success'=>false, 'error'=>$results['error'][2])) );
					}
					$user = $AUTH->getUserByEmail($form_data['email']);
					$AUTH->setSession($user);
				} else {
					exit( json_encode(array('success'=>false, 'message'=>'A profile exists with that email')) );
				}
				exit( json_encode(array('success'=>true, 'results'=>$results)) );
			} else {
				exit( json_encode(array('success'=>false, 'message'=>'Please log out to create new profile')) );
			}
			break;
		case 'login':
			if(!$AUTH->isLoggedIn()) {
				$form_data = format_data($_POST['data']);
				if($AUTH->checkCreds($form_data['email'], $form_data['password'])) {
					$user = $AUTH->getUserByEmail($form_data['email']);
					if(isset($form_data['remember'])) {
						$AUTH->setCookie($form_data['email']);
					}
					exit( json_encode(array('success'=>true, 'user'=>$user)) );
				} else {
					exit( json_encode(array('success'=>false, 'message'=>'Invalid email or password')) );
				}
			} else {
				exit( json_encode(array('success'=>false, 'message'=>'You are already logged in')) );
			}
			break;
		case 'logout':
			if($AUTH->logOut()) {
				exit( json_encode(array('success'=>true)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'is-logged-in':
			if($AUTH->isLoggedIn()) {
				exit( json_encode(array('success'=>true)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'forgot-password':
			$form_data = format_data($_POST['data']);
			if($AUTH->forgotPassword($form_data['email'])) {
				exit( json_encode(array('success'=>true)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'reset-password':
			$form_data = format_data($_POST['data']);
			if($AUTH->resetPassword($form_data)) {
				exit( json_encode(array('success'=>true)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
	}
} else {
	exit( json_encode(array('success'=>false, 'message'=>'this action is not supported')) );
}

function format_data($data) {
	$form_data = array();
	foreach($data as $v) {
		$form_data[$v['name']] = $v['value'];
	}
	return $form_data;
}

?>
