<?php

/**
 *
 * @author haidar
 *        
 */
class MDriver extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertDriver($data) {
		$this->db->insert("driver", $data);
		return $this->db->insert_id();
	}
	
	function updateDriver($data,$driver_id){
		return $this->db->update('driver',$data, array('driver_id'=> $driver_id));
	}
	function getAllDriver() {
		$query = $this->db->get('driver');
		return $query->result();
	}
	
	function getAllVehicle(){
		$query = $this->db->get('vehicles');
		return $query->result();
	}
	
	function getDriver($driver_id){
		$query = $this->db->get_where('driver',array('driver_id'=> $driver_id));
		return $query->row();
	}
	
	
}