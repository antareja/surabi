<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('mgps');
		$this->mgps = new MGps();
	}
	public function index() {
		$this->users_list();
	}
	public function user_list(){
		
	}
}