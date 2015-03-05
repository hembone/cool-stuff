<?php
class mysqlHelper {

	function __construct() {
		$this->dbhost = MYSQL_HOST;
		$this->dbname = MYSQL_NAME;
		$this->dbuser = MYSQL_USER;
		$this->dbpass = MYSQL_PASS;
    }
	
	private function connect() {
		try {
			return new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		} catch (PDOException $e) {
			return false;
			//return 'Connection failed: ' . $e->getMessage();
		}
	}

	/*//////////////////////////////////
	//// Example Query
	////////////////////////////////////

	$sql = "SELECT * FROM users WHERE Email = :email";
	$params = array(
		array(':email', $email)
	);
	$results = $db->query($sql, $params);

	////////////////////////////////////
	//////////////////////////////////*/

	public function query($sql, $params=array(), $type='num') {
		$result = array('error'=>false);
		$conn = $this->connect();
		if($conn) {
			$stmt = $conn->prepare($sql);
			if(!empty($params)) {
				foreach($params as $p) {
					$stmt->bindParam($p[0], $p[1]);
				}
			}
			if($stmt->execute()) {
				$array_type['num'] = PDO::FETCH_NUM;
				$array_type['assoc'] = PDO::FETCH_ASSOC;
				$res = $stmt->fetchAll($array_type[$type]);
				if(!empty($res)) {
					if(count($res)>1) {
						$result['results'] = $res;
					} else {
						$result['results'] = $res[0];
					}
				}
			} else {
				$result['error'] = $stmt->errorInfo();
			}
		} else {
			$result['error'] = $conn->errorInfo();
		}
		return $result;
    }

}
?>
