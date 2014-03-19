<?php
/*
 * By Haidar Mar'ie Email = coder5@ymail.com MGps
 */
class MGps extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getUser() {
		$sql = "SELECT * FROM {PRE}user";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getTrack() {
		$sql = "SELECT * FROM track";
		$query = $this->db->query($sql);
		return $query;
	}
	
	function getTotalGPS(){
		$sql = "SELECT COUNT(*) FROM packet
				GROUP BY mobile_address";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function getDataVehicle(){
		$this->db->select("vehicles.name,gps_mobile_address,image_name,vehicles.icon_id,image_type");
		$this->db->from("vehicles");
		$this->db->join("icon","vehicles.icon_id=icon.icon_id");
		$query=$this->db->get();
		return $query->result();
	}
	
	function getVehicleByUser(){
		$this->db->get('vehicles');
	}
	
	function getLastPosition(){
		$sql = "SELECT
	gps_mobile_address AS gps_mobile_address,name,
	(
		SELECT
			create_at
		FROM
			tcm_packet
		WHERE
			mobile_address = gps_mobile_address
		ORDER BY
			create_at DESC
		LIMIT 0,
		1
	) AS create_at,
	(
		SELECT
			latitude
		FROM
			tcm_packet
		WHERE
			mobile_address = gps_mobile_address
		ORDER BY
			create_at DESC
		LIMIT 0,
		1
	) AS latitude,
(
		SELECT
			longitude
		FROM
			tcm_packet
		WHERE
			mobile_address = gps_mobile_address
		ORDER BY
			create_at DESC
		LIMIT 0,
		1
	) AS longitude,
	(
		SELECT
			velocity
		FROM
			tcm_packet
		WHERE
			mobile_address = gps_mobile_address
		ORDER BY
			create_at DESC
		LIMIT 0,
		1
	) AS velocity,
	(
		SELECT
			bearing
		FROM
			tcm_packet
		WHERE
			mobile_address = gps_mobile_address
		ORDER BY
			create_at DESC
		LIMIT 0,
		1
	) AS bearing
FROM
	tcm_vehicles";
		$query = $this->db->query($sql);
		return $query->result();
	}
}	