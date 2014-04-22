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
		$sql = "UPDATE tcm_packet
				SET latitude = (latitude / 60),
				longitude = (SUBSTR(longitude, 1,3) + (SUBSTR(longitude,4) / 60))
				WHERE mobile_address = '00000000000000000000000001'";
		$query = $this->db->query($sql);
		return $query;
	}
}