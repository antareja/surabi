<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar & rizki
 *        
 */
class Fleet extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/mfleet_config');
		$this->load->model('admin/muser');
		$this->mfleet_config = new MFleet_config();
		$this->muser = new MUser();
	}

	public function index() {
		$this->fleet();
	}

	/**
	 * Fleet State Table Show
	 */
	public function fleet() {
		$data['pageTitle'] = "Fleet State Modul";
		$data['vehicles'] = $this->mfleet_config->getAllVehicle();
		$this->load->template('fleet', $data);
	}
}