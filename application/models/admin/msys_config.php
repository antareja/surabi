<?php

/**
 *
 * @author haidar & rizki
 *        
 */
class MSys_config extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertCompanyData($data) {
		$this->db->insert("company_data", $data);
	}

	function getCompany($id_company) {
		// $sql = "SELECT * FROM {PRE}company_data WHERE id_company=".$id_user;
		$query = $this->db->get_where('company_data', array('id_company' => $id_company));
		// $query = $this->db->query($sql);
		return $query->row();
	}
	
	function editCompany($id_company,$data) {
		return $this->db->update('company_data',$data,array("id_company"=>$id_company));
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
		$sql = "SELECT * FROM {PRE}users";
		$query = $this->db->query($sql);
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