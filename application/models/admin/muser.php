<?php

/**
 *
 * @author haidar
 *        
 */
class Muser extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertUser($data) {
		$this->db->insert("user", $data);
		return $this->db->insert_id();
	}
	
	function updateUser($data,$user_id){
		return $this->db->update('user',$data, array('user_id'=> $user_id));
	}
	function getAllUser() {
		$query = $this->db->get('user');
		return $query->result();
	}
	
	function getAllVehicle(){
		$query = $this->db->get('vehicles');
		return $query->result();
	}
	
	function getUser($user_id){
		$query = $this->db->get_where('user',array('user_id'=> $user_id));
		return $query->row();
	}
	
	
}