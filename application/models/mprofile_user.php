<?php

/**
 *
 * @author haidar
 *        
 */
class MProfile_user extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getUserData() {
		$this->db->where('user_id',$_SESSION['gps_user_id']);
		return $this->db->get('user')->result();
	}
	function getUserHistory() {
		$this->db->where('user_id',$_SESSION['gps_user_id']);
		$this->db->order_by("login", "desc");
		return $this->db->get('user_log')->result();
	}
}