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

	function getActivityReport($begin, $end) {
		$this->db->select('vehicles.name ,time, velocity, bearing,  latitude, longitude');
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		$query = $this->db->get_where('packet', array(
				'create_at >=' => $begin . ' 09:00',
				'create_at <=' => $end . ' 23:00' 
		));
		return $query;
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