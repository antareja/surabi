<?php

/**
 *
 * @author haidar & rizki
 *        
 */
class MFleet_config extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertBase($data) {
		$this->db->insert("base", $data);
		return $this->db->insert_id();
	}

	function editBase($base_id, $data) {
		return $this->db->update("base", $data, array(
				"base_id" => $base_id 
		));
	}

	function getBase($base_id) {
		$query = $this->db->get_where("base", array(
				"base_id" => $base_id 
		));
		return $query->row();
	}
	
	function getAllBase(){
		$query = $this->db->get("base");
		return $query->result();
	}
}	