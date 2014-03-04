<?php

/**
 *
 * @author haidar
 *        
 */
class MProfile extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getAllSpeedAlert() {
		$query = $this->db->get('speed_alert');
		return $query->result();
	}
	
	function getAllVehicle(){
		$query = $this->db->get('vehicles');
		return $query->result();
	}
	
	function getMobileAddress($vehicle_id) {
		
	}

	function getSpeedAlert($speed_id) {
		$query = $this->db->get_where('speed_alert', array(
				'speed_id' => $speed_id 
		));
		return $query->row();
	}

	function insertSpeedAlert($data) {
		$this->db->insert('speed_alert', $data);
		return $this->db->insert_id();
	}

	function updateSpeedAlert($data, $speed_id) {
		$this->db->update('speed_alert', $data, array(
				'speed_id' => $speed_id 
		));
		return $speed_id;
	}

	function deleteSpeedAlert($speed_id) {
		return $this->db->delete('speed_alert', array(
				'speed_id' => $speed_id 
		));
	}

	function insertRegion($data) {
		$this->db->insert("region_alert", $data);
		return $this->db->insert_id();
	}

	function updateRegion($data, $region_id) {
		return $this->db->update("region_alert", $data, array(
				"region_id" => $region_id 
		));
	}

	function deleteRegion($region_id) {
		return $this->db->delete('region_alert', array(
				'region_id' => $region_id 
		));
	}

	function getAllRegion() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}

	function getRegion($region_id) {
		$query = $this->db->get_where('region_alert', array(
				'region_id' => $region_id 
		));
		return $query->row();
	}
}