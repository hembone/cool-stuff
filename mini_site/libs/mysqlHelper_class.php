<?php
class mysqlHelper {

	function __construct() {
		$dbhost = MYSQL_HOST;
		$dbname = MYSQL_NAME;
		$dbuser = MYSQL_USER;
		$dbpass = MYSQL_PASS;

		$this->db = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
	}

	public function get() {

	}

	public function get_by_id($table, $id) {

	}

	public function insert() {

	}

	public function update() {

	}

	public function update_by_id() {

	}

	public function query($query) {

	}

}
?>
