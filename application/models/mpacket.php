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
		$query = $this->db->get_where('packet',array('mobile_address'=>$mobile_address));
		//echo $this->db->last_query();
		return $query;
	}
}	