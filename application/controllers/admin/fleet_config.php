<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Fleet_config extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('admin/fllet_config');
		$this->fleet_config = new Fleet_config();
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
			$this->fleet_config->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->fleet_config->getUser();
			$this->load->template("admin/fleet_config/base",$data);
		} else {
			$this->load->template("admin/fleet_config/base",$data);
		}
	}
}