<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * @author haidar
 *
 */
class Map extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mmap');
		$this->load->model('mgps');
		$this->load->model('mprofile');
		$this->load->model('admin/mfleet_config');
		$this->mgps = new MGps();
		$this->mprofile = new MProfile();
		$this->mfleet_config = new MFleet_config();
		$this->mmap = new MMap();
	}

	public function index() {
		$this->full();
	}
	
	public function full(){
		$data['vehicles'] = $this->mfleet_config->getAllVehicle();
		$data['region'] = $this->mprofile->getOneRegion();
// 		print_r($data['region']);exit;
		$data['pageTitle'] = 'Home';
		$data['user'] = $this->mgps->getUser();
		$data['last_position'] = $this->mgps->getLastPosition();
		$content_data['user'] = "admin";
		//$data['dashboard'] = $this->load->view('block/dashboard_admin', $content_data, true);
		$this->load->template('fullmap', $data);
		
	}

}