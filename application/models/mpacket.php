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

	function getDefaultSpeed($speed) {
		$query = $this->db->get_where('speed_alert', array(
				'max_speed >=' => $speed,
				'default' => 1 
		));
		if ($query->num_row() >0){
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
		if ($query->num_row() > 0) {
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

	function insertRegionAlert($data) {
		$this->db->insert('alert', $data);
		return $this->db->insert_id();
	}
}	