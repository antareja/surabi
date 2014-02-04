<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Fleet_config extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('madmin');
		$this->madmin = new Madmin();
	}
	public function index() {
		$this->company_data();
	}
	//-------------------------------------icon---------------------------
	public function base($users=NULL) {
		$data['pageTitle'] = 'Base';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->madmin->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->madmin->getUser();
			$this->load->template("admin/fleet_config/base",$data);
		} else {
			$this->load->template("admin/fleet_config/base",$data);
		}
	}
}