<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('mgps');
		$this->mgps = new MGps();
	}
	
	public function index()
	{
		$data['user'] = $this->mgps->getUser();
		$this->load->template('gps',$data);
	}
	
}