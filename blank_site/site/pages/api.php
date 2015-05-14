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
				$results = null;
				
				if(!$user['id']) {
					$results = $AUTH->addUser($form_data);
					if($results['error']){
						exit( json_encode(array('success'=>false, 'error'=>'Unable to create profile')) );
					}
					$user = $AUTH->getUserByEmail($form_data['email']);
					$AUTH->setSession($user);
				} else {
					exit( json_encode(array('success'=>false, 'message'=>'A profile exists with that email')) );
				}
				
				//update votes if necessary
				if(isset($_SESSION['vote_id'])) {
					$cookie = $_SESSION['vote_id'];
					$SWARM->updateVoteCred($user['id'], $cookie);
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
					if(isset($_SESSION['vote_id'])) {
						$cookie = $_SESSION['vote_id'];
						$SWARM->updateVoteCred($user['id'], $cookie);
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
				$info = $SWARM->getUserInfo( $_SESSION['user_data']['id'] );
				exit( json_encode(array('success'=>true,'user'=>$info),JSON_NUMERIC_CHECK) );
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
		case 'get-popular':
			$images = $SWARM->getPopular(intval($_POST['data']['offset']));
			if($images) {
				exit( json_encode(array('success'=>true, 'images'=>$images), JSON_NUMERIC_CHECK) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-choice':
			$images = $SWARM->getChoice(intval($_POST['data']['offset']));
			if($images) {
				exit( json_encode(array('success'=>true, 'images'=>$images), JSON_NUMERIC_CHECK) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-recent':
			$images = $SWARM->getRecent(intval($_POST['data']['offset']));
			if($images) {
				exit( json_encode(array('success'=>true, 'images'=>$images), JSON_NUMERIC_CHECK) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-theme-name':
			$name = $SWARM->getThemeName($_POST['albumId']);
			if($name) {
				exit( json_encode(array('success'=>true, 'name'=>$name)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-all-theme-names':
			$names = $SWARM->getAllThemeNames();
			if($names) {
				exit( json_encode(array('success'=>true, 'names'=>$names)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-theme-album':
			$images = $SWARM->getThemeAlbum((int)$_POST['data']['albumId'], (int)$_POST['data']['offset']);
			if($images) {
				exit( json_encode(array('success'=>true, 'images'=>$images), JSON_NUMERIC_CHECK) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-theme-album-all':
			$images = $SWARM->getThemeAlbumAll($_POST['albumId'], $_POST['offset']);
			if($images) {
				exit( json_encode(array('success'=>true, 'images'=>$images)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-user-album':
			$images = $SWARM->getUserAlbum($_POST['data']['userId']);
			if($images) {
				exit( json_encode(array('success'=>true, 'images'=>$images), JSON_NUMERIC_CHECK) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-user-info':
			$info = $SWARM->getUserInfo($_POST['data']['userId']);
			if($info) {
				exit( json_encode(array('success'=>true, 'info'=>$info)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'get-my-votes':
			$votes = $SWARM->getMyVotes();
			if($votes) {
				exit( json_encode(array('success'=>true, 'votes'=>$votes)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'send-vote':
			$res = $SWARM->sendVote($_POST['data']['photoId']);
			if($res) {
				exit( json_encode(array('success'=>true, 'votes'=>$res)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'send-moderation':
			$res = $SWARM->sendModeration($_POST['photoId'], $_POST['moderation']);
			if($res) {
				exit( json_encode(array('success'=>true)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
		case 'image-upload':
			$res = $SWARM->imageUpload($_POST['crop_src'], $_POST['crop_data'], $_FILES['crop_file'], $_POST['album_id'], $_POST['img_caption']);
			if($res) {
				exit( json_encode(array('success'=>true, 'result'=>$res)) );
			} else {
				exit( json_encode(array('success'=>false)) );
			}
			break;
	}
} else {
	exit( json_encode(array('success'=>false,'message'=>'this action is not supported')) );
}

function format_data($data) {
	$form_data = array();
	foreach($data as $v) {
		$form_data[$v['name']] = $v['value'];
	}
	return $form_data;
}

?>
