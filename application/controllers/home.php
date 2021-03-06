<?php

if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * @author haidar
 *
 */
class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mgps');
		$this->load->model('mprofile');
		$this->load->model('admin/mfleet_config');
		$this->mgps = new MGps();
		$this->mprofile = new MProfile();
		$this->mfleet_config = new MFleet_config();
	}

	public function index() {
		$this->home();
	}

	public function home() {
		$data['vehicles'] = $this->mfleet_config->getAllVehicle();
		$data['region'] = $this->mprofile->getOneRegion();
// 		print_r($data['region']);exit;
		$data['pageTitle'] = 'Home';
		$data['user'] = $this->mgps->getUser();
		$data['last_position'] = $this->mgps->getLastPosition();
		$content_data['user'] = "admin";
		$data['dashboard'] = $this->load->view('block/dashboard_admin', $content_data, true);
		$this->load->template('gps', $data);
	}
	
	public function gmaps(){
		$data['all_vehicle'] = $this->mgps->getDataVehicle();
		$data['regions'] = $this->mprofile->getAllRegion();
		$data['pageTitle'] = 'Home';
		$data['user'] = $this->mgps->getUser();
		$this->load->template('gps_google', $data);
	}

	public function demo() {
		$data['pageTitle'] = 'Demo';
		$data['user'] = $this->mgps->getUser();
		$this->load->template('gps', $data);
	}
	
	public function info(){
		phpinfo();
	}
	
	public function base(){
		echo 'base_url '.base_url_new().'<br>';
		echo 'local '. $_SERVER['SERVER_NAME'];
	}
	
	public function test() {
// 		echo FCPATH;
		$regions = $this->mmap->getAllRegion();
		foreach($regions as $region) {
			$lat = explode(';', $region->latlng);
			foreach($lat as $row) {
				echo $row.' <br>';
			}
		}
	}
}