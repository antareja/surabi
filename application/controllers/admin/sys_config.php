<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar & rizki
 *        
 */
class Sys_config extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/msys_config');
		$this->sys_config = new MSys_config();
	}

	public function index() {
		$this->company_data();
	}

	/**
	 *
	 * @param number $users
	 *        	Always set One User for Single User Only
	 */
	public function company_data($id_company = 1) {
		$data['pageTitle'] = 'General Company Data';
		$post = $this->input->post();
		if ($post) {
			// print_r($post);
			$name['name'] = $post['name']; 
			$name['address'] = $post['address']; 
			$name['phone'] = $post['phone']; 
			$name['phone2'] = $post['phone2']; 
			$name['fax'] = $post['fax']; 
			if ($post['id_company']) {
				$this->sys_config->editCompany($post['id_company'], $name);
			} else {
				$this->sys_config->insertCompanyData($name);
			}
			redirect('admin/sys_config');
		} elseif ($id_company) {
			$data['users'] = $this->sys_config->getCompany($id_company);
			$this->load->template("admin/sys_config/general", $data);
		} else {
			$this->load->template("admin/sys_config/general", $data);
		}
	}

	/**
	 *
	 * @param string $users
	 *        	Icon
	 */
	public function icon($users = NULL) {
		$data['pageTitle'] = 'Icon';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->sys_config->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->sys_config->getUser();
			$this->load->template("admin/sys_config/icon", $data);
		} else {
			$this->load->template("admin/sys_config/icon", $data);
		}
	}

	/**
	 *
	 * @param string $users
	 *        	Hardware
	 */
	public function hardware_type($users = NULL) {
		$data['pageTitle'] = 'Hardware Type';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->sys_config->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->sys_config->getUser();
			$this->load->template("admin/sys_config/hardware_type", $data);
		} else {
			$this->load->template("admin/sys_config/hardware_type", $data);
		}
	}
}