<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Packet extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mpacket');
		$this->mpacket = new MPacket();
	}

	public function index() {
		$this->resv();
	}

	public function test() {
		$post = $this->input->post();
		print_r($post);
	}

	public function resv() {
		$post = $this->input->post();
		if ($post) {
			// '\x02G000000000000000000000000521192.168.012.250100*\x03103025,-6.915009,107.600255,0.00,0,40214,8,1.02\x04'
			$data['full_packet'] = $post['full_packet'];
			if ($this->mpacket->insertPacket($data)) {
				print_r($data);
				echo 'success';
			}
		}
	}

	public function test_post() {
	}

	public function parse() {
		$packet = '\x02G000000000000000000000000521192.168.012.250100*\x03103025,-6.915009,107.600255,0.00,0,40214,8,1.02\x04';
		
	}
}