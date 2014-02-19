<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Location extends CI_Controller {

	function __construct() {
		parent::__construct();
		// $this->load->model('mfleet');
		// $this->mfleet = new MFleet();
	}

	public function index() {
		$this->loc();
	}

	public function test() {
		echo 'haidar';
	}

	public function loc($lat) {
		$location = explode(',', $lat);
// 		echo 'lat'.$location[0] .', lng' .$location[1];exit;
		$data['lat'] = $location[0];
		$data['lng'] = $location[1];
		$this->load->view('tools/location', $data);
	}
}