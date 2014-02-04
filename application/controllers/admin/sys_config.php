<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Sys_config extends CI_Controller {
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
			$this->load->template("admin/sys_config/general",$data);
		} else {
			$this->load->template("admin/sys_config/general",$data);
		}
	}
//-------------------------------------icon---------------------------
	public function icon($users=NULL) {
		$data['pageTitle'] = 'Icon';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->madmin->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->madmin->getUser();
			$this->load->template("admin/sys_config/icon",$data);
		} else {
			$this->load->template("admin/sys_config/icon",$data);
		}
	}
//-----------------------------------Hardware--------------------------
	public function hardware_type($users=NULL) {
		$data['pageTitle'] = 'Hardware Type';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->madmin->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->madmin->getUser();
			$this->load->template("admin/sys_config/hardware_type",$data);
		} else {
			$this->load->template("admin/sys_config/hardware_type",$data);
		}
	}
}