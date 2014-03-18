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

	function updateUser($data, $user_id) {
		return $this->db->update('user', $data, array(
				'user_id' => $user_id 
		));
	}
	
	function getAllCompany(){
		$query = $this->db->get('company_data');
		return $query->result();
	}

	function getAllUser(){
		$query = $this->db->get('user');
		return $query->result();
	}
	
	function getAllAdmin() {
		$query = $this->db->get_where('user', array('level' => 'admin'));
		return $query->result();
	}
	
	function getAllAdminVendor() {
		$query = $this->db->get_where('user', array('level' => 'admin_vendor'));
		return $query->result();
	}
	
	function getAllAdminCompany($company_id){
		$query = $this->db->get_where('user', array('level'=>'admin_vendor', "company_id"=>$company_id));
		return $query->result();
	}

	function getAllVehicle() {
		$query = $this->db->get('vehicles');
		return $query->result();
	}

	function getUser($user_id) {
		$query = $this->db->get_where('user', array(
				'user_id' => $user_id 
		));
		// echo $this->db->last_query();
		return $query->row();
	}

	function login($username, $password) {
		$query = $this->db->get_where('user', array(
				'username' => $username,
				'password' => md5($password) 
		));
		// echo $this->db->last_query();
		if ($query->num_rows() == 1) {
			return $query->row(); // if data is true
		} else {
			return false; // if data is wrong
		}
	}
}