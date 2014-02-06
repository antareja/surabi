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
		$this->mgps = new MGps();
	}

	public function index() {
		$this->home();
	}

	public function home() {
		$data['pageTitle'] = 'Home';
		$data['user'] = $this->mgps->getUser();
		$this->load->template('gps', $data);
	}

	public function demo() {
		$data['pageTitle'] = 'Demo';
		$data['user'] = $this->mgps->getUser();
		$this->load->template('gps', $data);
	}
	
	public function test() {
		echo FCPATH;
	}
}