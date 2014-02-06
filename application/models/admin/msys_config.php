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

	function getCompany($id_company) {
		$query = $this->db->get_where('company_data', array('id_company' => $id_company));
		return $query->row();
	}
	
	function insertCompanyData($data) {
		$this->db->insert("company_data", $data);
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
		return $this->db->insert_id();
	}
	
	function editIcon($data,$icon_id) {
		return $this->db->update("icon",$data,array("icon_id"=>$icon_id));
	}

	function getAllIcon() {
		$query = $this->db->get('icon');
		return $query->result();
	}
	
	function getIcon($icon_id) {
		$query = $this->db->get_where('icon',array('icon_id'=>$icon_id));
		return $query->row();
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