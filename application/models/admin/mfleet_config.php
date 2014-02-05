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
		return $this->db->insert("base", $data);
	}

	function getBase() {
		$sql = "SELECT * FROM {PRE}base";
		$query = $this->db->query($sql);
		return $query->result();
	}
}	