<?php

/*
 * By Haidar Mar'ie Email = coder5@ymail.com MGps
 */
class Sys_config extends CI_Model {
	function __construct() {
		parent::__construct();
	}
//--------------------------------------base----------------------------	
	function insertIcon($data) {
		$this->db->insert("{PRE}base", $data);
	}
	function getIcon() {
		$sql = "SELECT * FROM {PRE}base";
		$query = $this->db->query($sql);
		return $query->result();
	}
}	