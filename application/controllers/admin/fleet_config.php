<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar & rizki
 *        
 */
class Fleet_config extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/mfleet_config');
		$this->fleet_config = new MFleet_config();
	}

	public function index() {
		$this->base();
	}

	/**
	 *
	 * @param string $users        	
	 */
	public function base($base = NULL) {
		$data['pageTitle'] = 'Base';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->fleet_config->insertCompanyData($post);
		} elseif ($base) {
			$data['users'] = $this->fleet_config->getUser();
			$this->load->template("admin/fleet_config/base", $data);
		} else {
			$this->load->template("admin/fleet_config/base", $data);
		}
	}
}