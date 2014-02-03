<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('madmin');
		$this->madmin = new Madmin();
	}
	public function index() {
		$this->company_data();
	}
	public function company_data($users=NULL) {
		$data['pageTitle'] = 'General Company Data';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->madmin->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->madmin->getUser();
			$this->load->template("admin/company_data/general",$data);
		} else {
			$this->load->template("admin/company_data/general",$data);
		}
	}
}