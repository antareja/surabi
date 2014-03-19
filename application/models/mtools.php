<?php

class Mtools extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertUser($data) {
		$this->db->insert("user", $data);
		return $this->db->insert_id();
	}
	
	function insertVehicle($data){
		$this->db->insert("vehicles",$data);
		return $this->db->insert_id();
	}
}