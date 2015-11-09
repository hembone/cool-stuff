<?php
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_REQUEST['key']) && $_REQUEST['key']==API_KEY) {
	switch($_REQUEST['action']) {
		case 'add-user':
            $AUTH = new authHelper();
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
            $AUTH = new authHelper();
    		if(!$AUTH->isLoggedIn()) {
    			$form_data = format_data($_REQUEST['data']);
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
        case 'forgot-password':
            $AUTH = new authHelper();
    		$form_data = format_data($_POST['data']);
    		if($AUTH->forgotPassword($form_data['email'])) {
    			exit( json_encode(array('success'=>true)) );
    		} else {
    			exit( json_encode(array('success'=>false)) );
    		}
    		break;
    	case 'reset-password':
            $AUTH = new authHelper();
    		$form_data = format_data($_POST['data']);
    		if($AUTH->resetPassword($form_data)) {
    			exit( json_encode(array('success'=>true)) );
    		} else {
    			exit( json_encode(array('success'=>false)) );
    		}
    		break;
		case 'logout':
			$AUTH = new authHelper();
			$result = $AUTH->logOut();
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'get-blocks':
			$APP = new appHelper();
			$result = $APP->getBlocks(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true, 'blocks'=>$result)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'get-block':
			$APP = new appHelper();
			$result = $APP->getBlock($_REQUEST['data']);
			if($result) {
				exit(json_encode(array('success'=>true, 'block'=>$result)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'edit-block':
			$APP = new appHelper();
			$result = $APP->editBlock(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'delete-block':
			$APP = new appHelper();
			$result = $APP->deleteBlock($_REQUEST['data']);
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'get-categories':
			$APP = new appHelper();
			$result = $APP->getCategories();
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
		case 'edit-category':
			$APP = new appHelper();
			$result = $APP->editCategory(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'delete-category':
			$APP = new appHelper();
			$result = $APP->deleteCategory($_REQUEST['data']);
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'get-clients':
			$APP = new appHelper();
			$result = $APP->getClients();
			if($result) {
				exit(json_encode(array('success'=>true, 'clients'=>$result)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'new-client':
			$APP = new appHelper();
			$result = $APP->newClient(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'edit-client':
			$APP = new appHelper();
			$result = $APP->editClient(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'delete-client':
			$APP = new appHelper();
			$result = $APP->deleteClient($_REQUEST['data']);
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'get-global-css':
			$APP = new appHelper();
			$result = $APP->getGlobalCss();
			if($result) {
				exit(json_encode(array('success'=>true, 'result'=>$result)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'edit-global-css':
			$APP = new appHelper();
			$result = $APP->editGlobalCss(format_data($_REQUEST['data']));
			if($result) {
				exit(json_encode(array('success'=>true)));
			} else {
				exit(json_encode(array('success'=>false)));
			}
			break;
		case 'download':
			$APP = new appHelper();
			$result = $APP->download($_REQUEST['data']);
			if($result) {
				exit(json_encode(array('success'=>true, 'filename'=>$result)));
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
