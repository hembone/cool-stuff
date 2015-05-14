<?php
class mysqlHelper {

	function __construct() {
		$this->dbhost = MYSQL_HOST;
		$this->dbname = MYSQL_NAME;
		$this->dbuser = MYSQL_USER;
		$this->dbpass = MYSQL_PASS;
    }

    public function connect() {
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
	$results = $db->query($conn, $sql, $params [,'assoc']);

	////////////////////////////////////
	//////////////////////////////////*/

	public function query($conn, $sql, $params=array(), $type='num', $returnArray=false) {
		$result = array('error'=>false, 'results'=>false);
		if($conn) {
			$stmt = $conn->prepare($sql);
			if(!empty($params)) {
				foreach($params as $p) {
					(gettype($p[1])=='integer')? 
						$stmt->bindParam($p[0], $p[1], PDO::PARAM_INT) :
						$stmt->bindParam($p[0], $p[1]);
				}
			}
			if($stmt->execute()) {
				$array_type['num'] = PDO::FETCH_NUM;
				$array_type['assoc'] = PDO::FETCH_ASSOC;
				$res = $stmt->fetchAll($array_type[$type]);
				if(!empty($res)) {
					if(count($res)>1 || $returnArray) {
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
