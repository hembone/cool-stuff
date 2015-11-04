<?php
class authHelper {

	function __construct() {
		$this->DB = $DB = new mysqlHelper();
		$this->conn = $DB->connect();
	}

	public function isLoggedIn() {
		if(isset($_SESSION[APP_KEY])) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserById($id=false) {
		if($id) {
			$sql = "SELECT id, firstName, lastName, email FROM users WHERE id=:id";
			$params = array(
				array(':id', $id)
			);
			$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
			if($res['error']===false && !empty($res['results'])) {
				return $res['results'];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getUserByCookieId($cookieId=false) {
		if($cookieId) {
			$sql = "SELECT id, firstName, lastName, email FROM users WHERE cookieId=:cookieId";
			$params = array(
				array(':cookieId', $cookieId)
			);
			$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
			if($res['error']===false && !empty($res['results'])) {
				return $res['results'];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getUserByEmail($email=false) {
		if($email) {
			$sql = "SELECT id, firstName, lastName, email FROM users WHERE email=:email";
			$params = array(
				array(':email', $email)
			);
			$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
			if($res['error']===false && !empty($res['results']) && isset($res['results']['id'])) {
				return $res['results'];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function setSession($user=false) {
		if($user) {
			$_SESSION[APP_KEY] = array(
				'id' => $user['id']
				,'fname' => $user['firstName']
				,'lname' => $user['lastName']
				,'email' => $user['email']
			);
		}
	}

	public function setCookie($email=false) {
		if($email) {
			$expire = mktime(0, 0, 0, date('m'), date('d'), date('Y')+1);
			$auth_id = hash('sha256', $email.mt_rand(10,1000));
			setcookie('auth_id', $auth_id, $expire, '/');
			$sql = "UPDATE users SET cookieId=:cookieId WHERE email=:email";
			$params = array(
				array(':cookieId', $auth_id)
				,array(':email', $email)
			);
			$this->DB->query($this->conn, $sql, $params);
		}
	}

	public function generateCookie($salt) {
		return hash('sha256', $salt.mt_rand(10,100000));
	}

	public function addUser($data=false) {
		if($data) {
			$sql = "INSERT INTO users (password, firstName, lastName, email, phone, zip, dob) VALUES (:password, :firstName, :lastName, :email, :phone, :zip, :dob)";
			$params = array(
				array(':password', hash('sha256', $data['password'].APP_KEY))
				,array(':firstName', $data['fname'])
				,array(':lastName', $data['lname'])
				,array(':email', $data['email'])
				,array(':phone', $data['phone'])
				,array(':zip', $data['zip'])
				,array(':dob', $data['dob'])
			);
			$result = $this->DB->query($this->conn, $sql, $params);
			return $result;
		}
	}

	public function checkCreds($email, $password) {
		$pass = hash('sha256', $password.APP_KEY);
		$sql = "SELECT id, firstName, lastName, email FROM users WHERE email=:email AND password=:password";
		$params = array(
			array(':email', $email)
			,array(':password', $pass)
		);
		$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
		if($res['error']===false && !empty($res['results'])) {
			$this->setSession($res['results']);
			return true;
		} else {
			return false;
		}
	}

	public function forgotPassword($email=false) {
		if($email) {
			$sql = "SELECT id FROM users WHERE email=:email";
			$params = array(
				array(':email', $email)
			);
			$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
			if($res['error']===false && !empty($res['results']) && isset($res['results']['id'])) {
				$resetId = hash('sha256', $email.mt_rand(10,100000));
				$sql = "UPDATE users SET resetId=:resetId, resetExpire=:resetExpire WHERE email=:email";
				$params = array(
					array(':resetId', $resetId)
					,array(':resetExpire', time()+7200)
					,array(':email', $email)
				);
				$this->DB->query($this->conn, $sql, $params);
				$to = $email;
				$subject = "Summer Swarm Password Reset";
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$headers .= "From: " . "support@".preg_replace('/^www./','',$_SERVER['HTTP_HOST']) . "\r\n";
				$message = '<html><body>';
				$message .= '<div>Click the link below to reset your password.</div>';
				$message .= '<a href="http://'.$_SERVER['HTTP_HOST'].'/forgot-password-reset?key='.$resetId.'">Reset my password</a>';
				$message .= '</body></html>';
				mail($to, $subject, $message, $headers);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function resetKeyValid($key=false) {
		if($key) {
			$sql = "SELECT id, resetExpire FROM users WHERE resetId=:resetId";
			$params = array(
				array(':resetId', $key)
			);
			$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
			if($res['error']===false && !empty($res['results'])) {
				if($res['results']['resetExpire']>time()) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function resetPassword($data=false) {
		if($data) {
			$sql = "UPDATE users SET password=:password, resetId=:resetIdClear, resetExpire=:resetExpire WHERE resetId=:resetId";
			$params = array(
				array(':password', hash('sha256', $data['password'].APP_KEY))
				,array(':resetIdClear', '')
				,array(':resetExpire', '')
				,array(':resetId', $data['resetId'])
			);
			$this->DB->query($this->conn, $sql, $params);
			return true;
		} else {
			return false;
		}
	}

	public function logOut() {
		setcookie('cookie_id', '', time()-3600);
		unset($_SESSION[APP_KEY]);
		return true;
	}

}
?>
