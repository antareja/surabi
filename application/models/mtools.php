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
                -- AND label LIKE '%+%' 
                ORDER BY ST_Distance(geog_def, poi)
                LIMIT 10;";
		//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->result();		
	}
	
	/**
	 * USING Postgis Extension
	 * @param unknown $lng
	 * @param unknown $lat
	 */
	function pointContainPolygon($lng, $lat) {
		$sql = "SELECT ST_Contains(
				ST_GeomFromText('POLYGON((115.66707935239 -0.57043896996875,115.68964623419 -0.58305510073695,
				115.72678385857 -0.57772434125743,115.72891616236 -0.55551284342609,115.6690339642 -0.56244283074947,115.66707935239 -0.57043896996875))',4326)
				,
				ST_SetSRID(ST_MakePoint(115.72752185633,-0.56729841977699),4326)
				)";
		$query  = $this->db->query($sql);
		return $query->result();
	}
	
	/**
	 * USING Postgres Only
	 * @param unknown $lng
	 * @param unknown $lat
	 */
	function pointContainPolygonPg($lng, $lat) {
		$sql = "SELECT polygon '((115.66707935239,-0.57043896996875),(115.68964623419,-0.58305510073695),(115.72678385857,-0.57772434125743),
				(115.72891616236,-0.55551284342609),(115.6690339642,-0.56244283074947))' @> 
				point '(115.66759523518,-0.57027476048639)';";
		$query  = $this->db->query($sql);
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