<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
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
			$data = $post['full'];
			if ($this->mpacket->insertPacket($data)) {
				echo 'success';
			}
		}
	}

	public function position() {
	}
}