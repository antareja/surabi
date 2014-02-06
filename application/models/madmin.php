<?php
/*
 * By Haidar Mar'ie Email = coder5@ymail.com MGps
 */
class Madmin extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertCompanyData($data) {
		$this->db->insert("users", $data);
	}

	function getUser() {
		$sql = "SELECT * FROM users";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getTrack() {
		$sql = "SELECT * FROM track";
		$query = $this->db->query($sql);
		return $query;
	}

	function insertIcon($data) {
		$this->db->insert("icon", $data);
	}

	function getIcon() {
		$query = $this->db->get("icon");
		return $query->result();
	}

	function insertHardwareType($data) {
		$this->db->insert("hardware_type", $data);
	}

	function getHardwareType() {
		$sql = "SELECT * FROM {PRE}hardware_type";
		$query = $this->db->query($sql);
		return $query->result();
	}
}	