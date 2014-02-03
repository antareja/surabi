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
	public function company_data() {
		$data['pageTitle'] = 'General Company Data';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->madmin->insertCompanyData($post);
		} else {
			$this->load->template("admin/company_data/general");
		}
	}
}