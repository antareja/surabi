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
	
	function getAllVehicles(){
		$query = $this->db->get("vehicles");
		return $query->result();
	}
	
	function getVehicle($vehicle_id){
		$query = $this->db->get_where("vehicles",array("vehicle_id"=>$vehicle_id));
		return $query->row();
	}
	
	function insertVehicle($data){
		$this->db->insert('vehicles',$data);
		return $this->db->insert_id();
	}
	
	function updateVehicle($data, $vehicle_id){
		return $this->db->update("vehicles",$data,array("vehicle_id"=>$vehicle_id));	
	}
	
	
}	