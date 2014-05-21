<?php
/*
 * By Haidar Mar'ie Email = coder5@ymail.com Mpacket
 */
class MPacket extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertPacket($data) {
		$this->db->insert("packet", $data);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}

	function getUser() {
		$sql = "SELECT * FROM users";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getTrack() {
		$sql = "SELECT * FROM track";
		$query = $this->db->query($sql);
		return $query;
	}

	function getReplay($mobile_address) {
		$this->db->order_by("create_at", "ASC");
		$this->db->limit('10');
		$query = $this->db->get_where('packet', array(
				'mobile_address' => $mobile_address 
		));
		// echo $this->db->last_query();
		return $query;
	}
	
	function getReplayData($mobile_address,$tanggal) {
// 		$this->db->select('packet.*, vehicles.name');
		$this->db->order_by("packet.create_at", "ASC");
		$this->db->where("mobile_address", $mobile_address);
		$this->db->where("DATE({PRE}packet.create_at)", $tanggal);
		$this->db->join("vehicles","gps_mobile_address=mobile_address", 'inner');
		$this->db->join("icon","vehicles.icon_id=icon.icon_id",'left');
		$this->db->limit(50);
		$query = $this->db->get("packet");
		echo 'db'.$this->db->last_query();
		return $query->result();
	}
	
	/**
	 * Work on Postgres Postgis only
	 * return only 1
	 * @param POINT $lng
	 * @param POINT $lat
	 */
	function getLocationDistance($lng,$lat) {
		$sql = "SELECT label, CHAR_LENGTH(label),lng,lat, ST_Distance(geog_def, poi) AS distance_m
				FROM {PRE}road,
				  (select ST_MakePoint(115.71834017841,   -0.49391354590863)::geography as poi) as poi
				WHERE ST_DWithin(geog_def, poi, 100000)
				AND CHAR_LENGTH(label) >=6 AND label LIKE '%+%'
				ORDER BY ST_Distance(geog_def, poi)
				LIMIT 1;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	/**
	 * Work on Postgres Postgis only
	 * return 10
	 * @param POINT $lng
	 * @param POINT $lat
	 */
	function getAllLocationDistance($lng,$lat) {
		$sql = "SELECT label, CHAR_LENGTH(label),lng,lat, ST_Distance(geog_def, poi) AS distance_m
				FROM {PRE}road,
				  (select ST_MakePoint(115.71834017841,   -0.49391354590863)::geography as poi) as poi
				WHERE ST_DWithin(geog_def, poi, 100000)
				AND CHAR_LENGTH(label) >=6 AND label LIKE '%+%'
				ORDER BY ST_Distance(geog_def, poi)
				LIMIT 10;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getUTCTime(){
		$sql = "SELECT create_at, date,create_at AT TIME ZONE 'UTC', time , timetz,
				to_timestamp(concat_ws(' ', date, time), 'DD-MM-YY HH24:MI:SS')  AT TIME ZONE 'UTC+8' as WITA, 
				minutes_offset, velocity,knots,velocity_old latitude, longitude,satellite from tcm_packet
				ORDER BY time DESC;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getAllRegion() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getMobileAddress($vehicle_id){
		$query = $this->db->get_where('vehicles',array('vehicle_id'=>$vehicle_id));
		$data = $query->row();		
		return $data->gps_mobile_address;
	}
	
	function getVehicle($packet_id) {
		$this->db->join('vehicles', 'packet.mobile_address = vehicles.gps_mobile_address');
		$query = $this->db->get_where('packet', array('id_packet'=>$packet_id));
		$data = $query->row();
		//echo $this->db->last_query();
		return $data->vehicle_id;
	}
	
	function getRegion($vehicle_id){
// 		$sql = "SELECT * FROM {PRE}region_alert WHERE FIND_IN_SET('$vehicle_id', vehicle_id)";
// 		$query = $this->db->query($sql);
		$this->db->join('user', 'user.user_id = vehicles.user_id', 'inner');
		$this->db->join('region_alert','region_alert.user_id = user.admin_id', 'inner');
		$query = $this->db->get_where('vehicles', array('vehicles.vehicle_id'=>$vehicle_id));
		//$this->db->where_in('vehicle_id',$vehicle_id);
		//$query = $this->db->get('region_alert');
		//echo $this->db->last_query();exit;
		return $query->row();
	}

	function getDefaultSpeed($speed) {
		$query = $this->db->get_where('speed_alert', array(
				'max_speed <=' => $speed,
				'default' => 1 
		));
		if ($query->num_rows() >0){
			return true;
		} else {
			return false;
		}
	}

	function getSpeed($speed, $mobile_address) {
		$query = $this->db->get_where('speed_alert', array(
				'max_speed' => $speed,
				'mobile_address' => $mobile_address 
		));
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function insertSpeedAlert($data) {
		$this->db->insert('alert', $data);
		return $this->db->insert_id();
	}

	function getAlert() {
		$query = $this->db->get('region_alert');
		return $query->result();
	}
	
	function getAllEmailData() {
		$query = $this->db->get('email_data');
		return $query->result();
	}
	
	
	/**
	 * SELECT tcm_alert.*, tcm_vehicles."name" as vehicle, tcm_driver."name" as driver, 
	 * tcm_packet.velocity, tcm_packet.create_at, tcm_packet."location", tcm_packet.distance  FROM tcm_alert
INNER JOIN tcm_packet ON tcm_alert.packet_id = tcm_packet.id_packet
INNER JOIN tcm_vehicles ON tcm_vehicles.gps_mobile_address = tcm_packet.mobile_address
LEFT JOIN tcm_driver ON tcm_driver.vehicle_id = tcm_vehicles.vehicle_id
WHERE tcm_alert.type ='speed'
AND tcm_packet.id_packet = '36959';
	 */
	function getAlertDetail($packet_id){
		$this->db->select('tcm_alert.*, tcm_vehicles.name as vehicle, tcm_driver.name as driver, 
				tcm_packet.velocity as speed,tcm_packet.create_at, tcm_packet.location, 
				tcm_packet.distance');
		$this->db->join("packet", "alert.packet_id = packet.id_packet", "inner");	
		$this->db->join("vehicles", "vehicles.gps_mobile_address = packet.mobile_address", "inner");
		$this->db->join("driver", "driver.vehicle_id = vehicles.vehicle_id", "left");
		$query = $this->db->get_where('alert', array('packet.id_packet' => $packet_id, 
				'alert.type'=>'speed'));
		return $query->row();
	}

	function insertRegionAlert($data) {
		$this->db->insert('alert', $data);
		return $this->db->insert_id();
	}
}	