<?php
require "libs/twitteroauth-0.5.4/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class appHelper {

	function __construct() {
		if(USE_DB) {
			$this->DB = $DB = new mysqlHelper();
			$this->conn = $DB->connect();
		}
    }

	public function getBlocks($data) {
		$where = '';
		$trim_it = false;
		if(!empty($data['name']) || !empty($data['category']) || !empty($data['client'])) {
			$where .= 'WHERE ';
			$trim_it = true;
		}
		if(!empty($data['name'])) {
			$where .= 'name LIKE \'%'.$data['name'].'%\' AND ';
		}
		if(!empty($data['category'])) {
			$where .= 'category_id='.$data['category'].' AND ';
		}
		if(!empty($data['client'])) {
			$where .= 'client_id='.$data['client'].' AND ';
		}
		if($trim_it) {
			$where = substr($where, 0, -5);
		}
		$sql = "SELECT id, category_id, client_id, name, css, html FROM blocks ".$where." ORDER BY name";
		$params = array();
		$res = $this->DB->query($this->conn, $sql, $params, 'assoc', true);
		if($res['error']) {
			$blocks = false;
		} else {
			$blocks = $res['results'];
		}
		$global_css = $this->getGlobalCss();
		if(!$blocks || !$global_css) {
			return false;
		} else {
			return ['blocks'=>$blocks, 'global_css'=>$global_css];
		}
	}

	public function getBlock($block_id) {
		$sql = "SELECT id, category_id, client_id, name, css, html FROM blocks WHERE id=:id";
		$params = array(
			array(':id', $block_id)
		);
		$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
		if($res['error']) {
			return false;
		} else {
			return $res['results'];
		}
	}

	public function editBlock($data) {
		if(isset($data['block_id']) && !empty($data['block_id'])) {
			$sql = "UPDATE blocks SET category_id=:category_id, client_id=:client_id, name=:name, css=:css, html=:html, updated_on=:updated_on WHERE id=:id";
			$params = array(
				array(':category_id', $data['category_id'])
				,array(':client_id', $data['client_id'])
				,array(':name', $data['name'])
				,array(':css', $data['css'])
				,array(':html', $data['html'])
				,array(':updated_on', date("Y-m-d H:i:s"))
				,array(':id', $data['block_id'])
			);
			$this->DB->query($this->conn, $sql, $params);
		} else {
			$sql = "INSERT INTO blocks (category_id, client_id, name, css, html, updated_on, created_on) VALUES (:category_id, :client_id, :name, :css, :html, :updated_on, :created_on)";
			$params = array(
				array(':category_id', $data['category_id'])
				,array(':client_id', $data['client_id'])
				,array(':name', $data['name'])
				,array(':css', $data['css'])
				,array(':html', $data['html'])
				,array(':updated_on', date("Y-m-d H:i:s"))
				,array(':created_on', date("Y-m-d H:i:s"))
			);
			$this->DB->query($this->conn, $sql, $params);
		}
		return true;
	}

	public function deleteBlock($block_id) {
		$sql = "DELETE FROM blocks WHERE id=:id";
		$params = array(
			array(':id', $block_id)
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function getCategories() {
		$sql = "SELECT id, name FROM categories ORDER BY name";
		$params = array();
		$res = $this->DB->query($this->conn, $sql, $params, 'assoc', true);
		if($res['error']) {
			return false;
		} else {
			return $res['results'];
		}
	}

	public function newCategory($data) {
		$sql = "INSERT INTO categories (name, updated_on, created_on) VALUES (:name, :updated_on, :created_on)";
		$params = array(
			array(':name', $data['cat_name'])
			,array(':updated_on', date("Y-m-d H:i:s"))
			,array(':created_on', date("Y-m-d H:i:s"))
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function editCategory($data) {
		$sql = "UPDATE categories SET name=:name, updated_on=:updated_on WHERE id=:id";
		$params = array(
			array(':name', $data['edit_cat_name'])
			,array(':updated_on', date("Y-m-d H:i:s"))
			,array(':id', $data['category_id'])
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function deleteCategory($category_id) {
		$sql = "DELETE FROM categories WHERE id=:id";
		$params = array(
			array(':id', $category_id)
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function getClients() {
		$sql = "SELECT id, name FROM clients ORDER BY name";
		$params = array();
		$res = $this->DB->query($this->conn, $sql, $params, 'assoc', true);
		if($res['error']) {
			return false;
		} else {
			return $res['results'];
		}
	}

	public function newClient($data) {
		$sql = "INSERT INTO clients (name, updated_on, created_on) VALUES (:name, :updated_on, :created_on)";
		$params = array(
			array(':name', $data['client_name'])
			,array(':updated_on', date("Y-m-d H:i:s"))
			,array(':created_on', date("Y-m-d H:i:s"))
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function editClient($data) {
		$sql = "UPDATE clients SET name=:name, updated_on=:updated_on WHERE id=:id";
		$params = array(
			array(':name', $data['edit_client_name'])
			,array(':updated_on', date("Y-m-d H:i:s"))
			,array(':id', $data['client_id'])
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function deleteClient($client_id) {
		$sql = "DELETE FROM clients WHERE id=:id";
		$params = array(
			array(':id', $client_id)
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function getGlobalCss() {
		$sql = "SELECT id, name, css FROM global_css WHERE id=:id";
		$params = array(
			array(':id', 1)
		);
		$res = $this->DB->query($this->conn, $sql, $params, 'assoc');
		if($res['error']) {
			return false;
		} else {
			return $res['results'];
		}
	}

	public function editGlobalCss($data) {
		$sql = "UPDATE global_css SET name=:name, css=:css, updated_on=:updated_on WHERE id=:id";
		$params = array(
			array(':name', 'Default Global CSS')
			,array(':css', $data['global_css'])
			,array(':updated_on', date("Y-m-d H:i:s"))
			,array(':id', 1)
		);
		$this->DB->query($this->conn, $sql, $params);
		return true;
	}

	public function download($data) {
		// add clean up here
		$global_css = $data['globalCSS'];
		$html = '';
		foreach($data['blocks'] as $id) {
			$block = $this->getBlock($id);
			$html .= $block['html'];
		}
		$filename = substr(str_shuffle(MD5(microtime())), 0, 10).'.html';
		file_put_contents('downloads/'.$filename, $html);
		return $filename;
	}

	public function getLorem() {
		$lorem_url = 'http://loripsum.net/api/'.rand(2,4).'/medium';
		$html = file_get_contents($lorem_url);
		return $html;
    }

	public function searchTwitter($data) {
		$consumer_key = 'sHKgGxRkfIM6fOjjYOf2RdWXg';
		$consumer_secret = 'nyUXG6Ep2JRaDTo3ipg4Kp1ZhVCfWsGsN5UR3jN9g0DhdcVMoi';
		$access_token = '1300600722-6fl0kqTJ3uqWJiXMtCFBB5wBuUXBYf1jJ7KDN8A';
		$access_token_secret = 'htDVCUCQer5E5kjSZNtvgkGXaaONWXHI83wktHWa17GIh';
		$TW = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

		$search_data = $TW->get("search/tweets", array("q" => $data['search'], "count" => 100));
		$total_hits = count($search_data->statuses);

		return array('data'=>$search_data->statuses, 'total'=>$total_hits);
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
