<?php

/**
 *
 * @author haidar & rizki
 *        
 */
class MMap extends CI_Model {

	function __construct() {
		parent::__construct();
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