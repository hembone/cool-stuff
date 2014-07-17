<?php
class mongoHelper {

/*
	The first parameter in most of these functions is the name of the collection that
you want to access.  Second one is probaby the query parameters you want to use, this 
should be in the form of an array/nested array of some sort depending on what you are 
trying to find/update/insert.
*/
    function __construct() {
        $dbhost = MONGO_DBHOST;
        $dbname = MONGO_DBNAME;
        $dbuser = MONGO_DBUSER;
        $dbpass = MONGO_DBPASS;
        //$conn = new MongoClient("mongodb://".$dbhost, array("username"=>$dbuser, "password"=>$dbpass));
        $conn = new MongoClient("mongodb://".$dbhost);
        $this->db = $conn->$dbname;
		$this->dbname = $dbname;
		$this->admin = $conn->admin;
    }

    private function parse_cursor($cursor) {
        $count = $cursor->count();
        $result = [];
        if($count > 0) {
            foreach($cursor as $id=>$value) {
                $result[] = $value;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    public function get($col, $filter=array(), $fields=array()) {
        $col = $this->db->$col;
        $cursor = $col->find($filter, $fields);
        return $this->parse_cursor($cursor);
    }

    public function get_by_id($col, $id, $fields=array()) {
        $col = $this->db->$col;
        $item = $col->findOne(array('_id' => new MongoId($id)), $fields);
        return $item;
    }

    public function insert($col, $data=array()) {
        $col = $this->db->$col;
        return $col->insert($data);
    }

    public function update($col, $filter=array(), $update=array()) {
        $col = $this->db->$col;
        return $col->update($filter, $update);
    }

    public function update_by_id($col, $id, $update=array()) {
        $col = $this->db->$col;
        return $col->update(array('_id' => new MongoId($id)), $update);
    }

    public function upsert($col, $filter=array(), $update=array()) {
        $col = $this->db->$col;
        return $col->update($filter, $update, array("upsert" => true));
    }

	public function rename_table($old_name, $new_name) {
		$query = array('renameCollection'=>"{$this->dbname}.$old_name",'to'=>"{$this->dbname}.$new_name",'dropTarget'=>"true");
		return $this->admin->command($query);
	}

	public function create_index($col, $index) {
		$col = $this->db->$col;
		return $col->createIndex($index);
	}

}
?>
