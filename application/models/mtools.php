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
	
	function getClosestDistance($lng,$lat) {
		$sql = "SELECT label, CHAR_LENGTH(label),lng,lat, ST_Distance(geog_def, poi) AS distance_m 
                FROM {PRE}road,
                (select ST_MakePoint(".$lng.", ".$lat.")::geography as poi) as poi 
                WHERE ST_DWithin(geog_def, poi, 100000)
                AND CHAR_LENGTH(label) >=6 
                AND label LIKE '%+%' 
                ORDER BY ST_Distance(geog_def, poi)
                LIMIT 10;";
		//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->result();		
	}
	
// 	function containPoly()
	
	function getRegion(){
		$this->db->join('user', 'user.user_id = vehicles.user_id', 'inner');
		$this->db->join('region_alert','region_alert.user_id = user.admin_id', 'inner');
		$this->db->order_by("region_id", "desc");		
		$this->db->limit(1);
		$query = $this->db->get_where('vehicles');
		return $query->row();
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