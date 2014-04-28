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
	
	function getByOperator() {
		if($_SESSION['gps_status'] == 'operator') {
			return array('user_id'=> $_SESSION['gps_user_id']);
		} else {
			return FALSE;
		}
	}

	function getEmployeeReport() {
		$this->db->select('user.*, user.user_id user_id, MAX(login) as login');
		if($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('user.admin_id', $_SESSION['gps_user_id']);
		} 
		$this->db->join('user_log', 'user_log.user_id = user.user_id', 'left');
		# unsopported PostGres
		$this->db->group_by('user.user_id');
		$this->db->order_by('user.user_id','desc');
		$query = $this->db->get('user');
// 		echo $this->db->last_query();exit;
		return $query->result();
	}

	function getAllVehicles() {
// 		$userid = $this->getByOperator() ? $this->getByOperator() : '' ;
// 		print_r($userid);exit;
		if($_SESSION['gps_level'] == 'operator') {
			$this->db->where('vehicles.user_id', $_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('vehicles.company_id', $_SESSION['gps_company_id']);
		}
		$query = $this->db->get('vehicles');
		return $query->result();
	}
	
	function getAllVehiclesComplete(){
		$this->db->select("MAX({PRE}vehicles.name) as alias ,MAX({PRE}hardware_type.name) as hw, vehicle_id as unit,
				MAX({PRE}company_data.name) as company_name, gps_mobile_address as gps, 
				MAX({PRE}packet.create_at) as last_update ");
		$this->db->join("packet", 'vehicles.gps_mobile_address = packet.mobile_address','left');
		$this->db->join("company_data", "vehicles.company_id = company_data.id_company", 'inner');
		$this->db->join("hardware_type", 'vehicles.hardware_id = hardware_type.hardware_id', 'left');
		$this->db->group_by('vehicles.vehicle_id');
		if($_SESSION['gps_level'] == 'operator') {
			$this->db->where('vehicles.user_id', $_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('vehicles.company_id', $_SESSION['gps_company_id']);
		}
		$query = $this->db->get('vehicles');
		return $query->result();
	}

	function getMobileAddress($vehicle) {
		$this->db->get("vehicle");
	}

	function getActivityReport($begin, $end, $vehicles) {
		$this->db->select('vehicles.name ,time, velocity, bearing,  latitude, longitude, location');
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		if ($vehicles != '') {
			$this->db->where_in('vehicle_id', $vehicles);
		}
		if($_SESSION['gps_level'] == 'operator') {
			$this->db->where('vehicles.user_id', $_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('vehicles.company_id', $_SESSION['gps_company_id']);
		}
		$query = $this->db->get_where('packet', array(
				'create_at >=' => $begin . ' 09:00',
				'create_at <=' => $end . ' 23:00' 
		));
// 		echo $this->db->last_query();exit;
		return $query;
	}
	
	function getSpeedReport($begin, $end, $vehicles) {
		$this->db->select('vehicles.name, velocity, create_at, location, bearing, latitude, longitude');
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		if ($vehicles != '') {
			$this->db->where_in('vehicle_id', $vehicles);
		}
		if($_SESSION['gps_level'] == 'operator') {
			$this->db->where('vehicles.user_id', $_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('vehicles.company_id', $_SESSION['gps_company_id']);
		}
		$query = $this->db->get_where('packet' , array(
			'create_at >=' => $begin . ' 09:00',
			'create_at <=' => $end . ' 23:00'
		));
		return $query->result();
	}
	
	function getAlertReport($begin, $end, $vehicle) {
		$this->db->select('vehicles.name, driver.name as driver_name,  
				alert.type, velocity, alert.create_at as create_at, latitude, longitude,  location, bearing');
		$this->db->join('packet', 'alert.packet_id = packet.id_packet','inner');
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address','inner');
		$this->db->join('driver', 'driver.vehicle_id = vehicles.vehicle_id','left');
		if ($vehicle != '') {
			$this->db->where_in('vehicles.vehicle_id', $vehicle);
		}
		if($_SESSION['gps_level'] == 'operator') {	
			$this->db->where('vehicles.user_id', $_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('vehicles.company_id', $_SESSION['gps_company_id']);
		}
		$query = $this->db->get_where('alert' , array(
				'alert.create_at >=' => $begin . ' 09:00',
				'alert.create_at <=' => $end . ' 23:00'
		));
// 		echo $this->db->last_query();exit;
		return $query->result();
	}
	
	function getStopReportGroup($begin, $end,$vehicles) {
		$this->db->group_by('latitude, longitude, mobile_address,DATE(create_at)');
		$this->db->select('vehicles.name, vehicles.vehicle_id, MIN(time) start_time, MAX(time) end_time, mobile_address, latitude,longitude
				, location,TIMEDIFF(MAX(time),MIN(time)) AS duration, MAX(DATE(create_at)) date');
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		$this->db->where_in('vehicle_id', $vehicles);
		$this->db->order_by('DATE(create_at), mobile_address','DESC');
		if($_SESSION['gps_level'] == 'operator') {
			$this->db->where('vehicles.user_id', $_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('vehicles.company_id', $_SESSION['gps_company_id']);
		}
		$query = $this->db->get_where('packet', array(
				'create_at >=' => $begin . ' 08:00',
				'create_at <=' => $end . ' 23:00'
		));
		return $query;
	}
	
	function getStopReport($begin,$end, $lat, $lng , $mobile_address) {
		$this->db->join('vehicles', 'vehicles.gps_mobile_address = packet.mobile_address');
		$this->db->select('TIMEDIFF(MAX(time),MIN(time)) AS duration,vehicle.name, time, mobile_address, latitude,longitude, location', false);
		if($_SESSION['gps_level'] == 'operator') {
			$this->db->where('vehicles.user_id', $_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$this->db->where('vehicles.company_id', $_SESSION['gps_company_id']);
		}
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