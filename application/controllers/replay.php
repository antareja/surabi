<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Replay extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mpacket');
		$this->mpacket = new MPacket();
	}

	public function index() {
		$this->replay();
	}
	
	public function replay() {
		$data['pageTitle'] = "Replay Module";
		$this->load->template('replay',$data);
	}
	
}