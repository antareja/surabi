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
		$query = $this->db->get_where('company_data', array(
				'id_company' => $id_company 
		));
		return $query->row();
	}
	
	function getAllCompany(){
		$query = $this->db->get('company_data');
		return $query->result();
	}

	function insertCompanyData($data) {
		$this->db->insert("company_data", $data);
		return $this->db->insert_id();
	}

	function editCompany($id_company, $data) {
		return $this->db->update('company_data', $data, array(
				"id_company" => $id_company 
		));
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

	function editIcon($data, $icon_id) {
		return $this->db->update("icon", $data, array(
				"icon_id" => $icon_id 
		));
	}

	function getAllIcon() {
		$query = $this->db->get('icon');
		return $query->result();
	}

	function getIcon($icon_id) {
		$query = $this->db->get_where('icon', array(
				'icon_id' => $icon_id 
		));
		return $query->row();
	}

	function getHardwareType($hardware_id) {
		$query = $this->db->get_where("hardware_type", array(
				'hardware_id' => $hardware_id 
		));
		return $query->row();
	}

	function getAllHardwareType() {
		$query = $this->db->get("hardware_type");
		return $query->result();
	}

	function insertHardwareType($data) {
		$this->db->insert("hardware_type", $data);
		return $this->db->insert_id();
	}

	function updateHardwareType($data, $hardware_id) {
		$this->db->update("hardware_type", $data, array(
				"hardware_id" => $hardware_id 
		));
	}

	function insertDriver($data) {
		$this->db->insert("driver", $data);
		return $this->db->insert_id();
	}

	function updateDriver($driver_id ,$data) {
		return $this->db->update('driver', $data, array(
				'driver_id' => $driver_id 
		));
	}

	function getAllDriver() {
		$query = $this->db->get('driver');
		return $query->result();
	}

	function getAllVehicle() {
		$query = $this->db->get('vehicles');
		return $query->result();
	}

	function getDriver($driver_id) {
		$query = $this->db->get_where('driver', array(
				'driver_id' => $driver_id 
		));
		return $query->row();
	}
}	