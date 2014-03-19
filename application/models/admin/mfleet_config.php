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

	function getAllCompany() {
		$query = $this->db->get('company_data');
		return $query->result();
	}

	function getAllBase() {
		$query = $this->db->get("base");
		return $query->result();
	}

	function getAllIcon() {
		$query = $this->db->get("icon");
		return $query->result();
	}

	function getAllHardware() {
		$query = $this->db->get("hardware_type");
		return $query->result();
	}

	function getAllUserByAdmin($admin_id) {
		$query = $this->db->get_where('user', array(
				'admin_id' => $admin_id 
		));
		return $query->result();
	}

	function getRegion() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getSpeed(){
		$query = $this->db->get('speed_alert');
		return $query;
	}
	
	function getAllUser() {
		$query = $this->db->get('user');
		return $query->result();
	}
	
	function getAllDriver(){
		if($_SESSION['gps_level'] == 'admin') {
			$query = $this->db->get('driver');
		} else {
			$query = $this->db->get_where('driver', array('company_id'=>$_SESSION['gps_company_id']));
		}
		return $query->result();
	}

	function getAllVehicles() {
		$query = $this->db->get("vehicles");
		return $query->result();
	}

	
	function getAllVehicleUser($user_id){
		$this->db->select("vehicles.name,gps_mobile_address,image_name,vehicles.icon_id,image_type");
		$this->db->join("icon","vehicles.icon_id=icon.icon_id", 'inner');
		$query=$this->db->get_where("vehicles", array('user_id' =>$user_id));
		return $query->result();
	}
	
	function getAllVehicleAdminVendor($company_id){
		$this->db->select("vehicles.name,gps_mobile_address,image_name,vehicles.icon_id,image_type");
		$this->db->join("icon","vehicles.icon_id=icon.icon_id", 'inner');
		$query=$this->db->get_where("vehicles", array('company_id' =>$company_id));
// 		echo $this->db->last_query();
		return $query->result();
	}
	
	function getAllVehicleAdmin(){
		$this->db->select("vehicles.name,gps_mobile_address,image_name,vehicles.icon_id,image_type");
		$this->db->join("icon","vehicles.icon_id=icon.icon_id" , 'inner');
		$query=$this->db->get("vehicles");
// 		echo $this->db->last_query();exit;
		return $query->result();
	}
	
	function getAllMobileAddress() {
		$this->db->group_by('mobile_address');
		$this->db->select("mobile_address");
		$query = $this->db->get("packet");
		return $query->result();
	}

	function getVehicle($vehicle_id) {
		$query = $this->db->get_where("vehicles", array(
				"vehicle_id" => $vehicle_id 
		));
		return $query->row();
	}

	function updateVehicleUser($data,$vehicle_id) {
		return $this->db->update("vehicles", $data, array('vehicle_id' => $vehicle_id));
	}
	
	function insertVehicle($data) {
		$this->db->insert('vehicles', $data);
		return $this->db->insert_id();
	}

	function updateVehicle($data, $vehicle_id) {
		return $this->db->update("vehicles", $data, array(
				"vehicle_id" => $vehicle_id 
		));
	}
}	