<?php
class appHelper {

	function __construct() {
		if(USE_DB) {
			$this->DB = $DB = new mysqlHelper();
			$this->conn = $DB->connect();
		}
    }

    public function sendLog($data) {
		$sql = "INSERT INTO Logs (type, message, timestamp) VALUES (:type, :message, :timestamp)";
		$params = array(
			array(':type', $data['type'])
			,array(':message', $data['message'])
			,array(':timestamp', date("Y-m-d H:i:s"))
		);
		$this->DB->query($this->conn, $sql, $params);
    }

	public function writeLog($data) {

    }

}
?>
