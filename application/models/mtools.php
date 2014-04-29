<?php

class Mtools extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertUser($data) {
		$this->db->insert("user", $data);
		return $this->db->insert_id();
	}
	
	function insertVehicle($data){
		$this->db->insert("vehicles",$data);
		return $this->db->insert_id();
	}
	
	function convert_nmea_fleet() { 
		$sql = "UPDATE {PRE}packet
				SET latitude = (latitude / 60),
				longitude = (SUBSTR(longitude, 1,3) + (SUBSTR(longitude,4) / 60))
				WHERE mobile_address = '00000000000000000000000001'";
		$query = $this->db->query($sql);
		return $query;
	}
	
	function getXYroad(){
		$this->db->limit(10);
		$this->db->like('label', '26+');
		$query = $this->db->get('road');
		return $query->result();
	}
	
	function getAllXYroad(){
		$this->db->order_by('road_id', 'asc');
		$query = $this->db->get('road');
		return $query;
	}
	
	function updateLatLngRoad($data,$road_id) {
		return $this->db->update('road', $data, array('road_id'=>$road_id));
	}
	
}