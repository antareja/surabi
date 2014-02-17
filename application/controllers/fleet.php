<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Fleet extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mfleet');
		$this->mfleet = new MFleet();
	}

	public function index() {
		$this->fleet();
	}

	public function fleet() {
		$data['pageTitle'] = "Fleet State Modul";
		$data['vehicles'] = $this->mfleet->getVehicle(); 
		$this->load->template('fleet',$data);
	}
}