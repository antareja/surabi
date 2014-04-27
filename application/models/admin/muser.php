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
		 $this->db->update('user', $data, array(
				'user_id' => $user_id 
		));
		return $this->db->last_query();
	}

	function getAllCompany() {
		$query = $this->db->get('company_data');
		return $query->result();
	}

	function getAllUser() {
		$this->db->select("*,  company_data.name as company_name");
		$this->db->join("company_data", "company_data.id_company = user.company_id", 'inner');
		$this->db->order_by("user_id", "desc");
		$query = $this->db->get('user');
		return $query->result();
	}

	function getAllAdmin() {
		$this->db->select("*, company_data.name as company_name");
		$this->db->join("company_data", "company_data.id_company = user.company_id", 'inner');
		$query = $this->db->get_where('user', array(
				'level' => 'admin' 
		));
		return $query->result();
	}

	function getAllOperatorByAdmin() {
		$query = $this->db->get_where('user', array(
				'level' => 'operator',
				'admin_id' => $_SESSION['gps_user_id'] 
		));
		return $query->result();
	}

	function getAllAdminVendor() {
		$this->db->join("company_data", "company_data.id_company = user.company_id", 'inner');
		$this->db->select("*, company_data.name as company_name");
		$query = $this->db->get_where('user', array(
				'level' => 'admin_vendor' 
		));
		return $query->result();
	}

	function getAllAdminCompany($company_id) {
		$query = $this->db->get_where('user', array(
				'level' => 'admin_vendor',
				"company_id" => $company_id 
		));
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
	
	function getCompanyByUser($user_id) {
		$this->db->join('company_data', 'user.company_id = company_data.id_company', "inner");
		$query = $this->db->get_where('user', array(
				"user_id" => $user_id
		));
		return $query->row();
	}

	function login($username, $password) {
		$this->db->select('username, user_id, fullname, level, user.company_id, company_data.name');
		$this->db->join('company_data', 'company_data.id_company = user.company_id', 'inner');
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

	function user_login($user_id) {
		$data['user_id'] = $user_id;
		$data['login'] = date('Y-m-d H:i:s');
		$this->db->insert('user_log', $data);
		return $this->db->insert_id();
	}

	function user_logout($user_id) {
		$last = $this->check_last_login($user_id);
		$data['logout'] = date('Y-m-d H:i:s');
		$this->db->update('user_log', $data, array(
				'user_id' => $user_id,
				'login' => $last->login 
		));
	}

	function check_last_login($user_id) {
		$this->db->order_by("log_id", "desc");
		$this->db->limit(1);
		$query = $this->db->get_where('user_log', array(
				'user_id' => $user_id,
				'logout' => NULL,
				'DATE(login)' => date('Y-m-d') 
		));
		$this->db->last_query();
		return $query->row();
	}
	
	/**
	 * Delete User but still in database
	 * @param unknown $user_id
	 */
	function deleteUser($user_id){
		$data['deleted'] = 1;
		return $this->db->update('user', $data, array('user_id' => $user_id));
	}
}