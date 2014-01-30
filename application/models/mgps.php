<?php

/* By Haidar Mar'ie
 * Email = coder5@ymail.com
  MGps */

class MGps extends CI_Model {


    function __construct() {
        parent::__construct();
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
	
}	