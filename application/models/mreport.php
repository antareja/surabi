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

	function getAllVehicles() {
		$query = $this->db->get('vehicles');
		return $query->result();
	}

	function getMobileAddress($vehicle) {
		$this->db->get("vehicle");
	}

	function getActivityReport($begin, $end, $vehicles) {
		$this->db->select('vehicles.name ,time, velocity, bearing,  latitude, longitude, location');
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		$this->db->where_in('vehicle_id', $vehicles);
		$query = $this->db->get_where('packet', array(
				'create_at >=' => $begin . ' 09:00',
				'create_at <=' => $end . ' 23:00' 
		));
		//echo $this->db->last_query();exit;
		return $query;
	}
	
	function getStopReportGroup($begin, $end,$vehicles) {
		$this->db->group_by('latitude, longitude, mobile_address');
		$this->db->select('vehicle.name, time, mobile_address, latitude,longitude, location');
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		$this->db->where_in('vehicle_id', $vehicles);
		$query = $this->db->get_where('packet', array(
				'create_at >=' => $begin . ' 08:00',
				'create_at <=' => $end . ' 23:00'
		));
		$this->db->last_query();
		return $query;
	}
	
	function getStopReport($begin,$end, $lat, $lng , $mobile_address) {
// 		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		$this->db->select('TIMEDIFF(MAX(time),MIN(time)) AS duration,vehicle.name, time, mobile_address, latitude,longitude, location', false);
		$query = $this->db->get_where('packet', array(
				'create_at >=' => $begin . $this->getWorkingHour()->start_working_hour,
				'create_at <=' => $end . $this->getWorkingHour()->end_working_hour
		));
		$this->db->where_in('mobile_address', $mobile_address);
		$this->db->last_query();
		return $query;
	}

	function getWorkingHour(){
		$query = $this->db->get_where('default_profile', array('default'=>1));
		return $query->row();
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
	
	function getIdling() {
		
	}
}	