<?php

/**
 *
 * @author haidar & rizki
 *        
 */
class MReport extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function getVehicleReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getEmployeeReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getActivityReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getAlertReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getSpeedReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getTimeClockReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getStatusReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getStatusDurationReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getStopIdlingReport() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
}	