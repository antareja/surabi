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
		$this->replay2();
	}

	public function replay() {
		$data['pageTitle'] = "Replay Module";
		$mobile_address = '00000000000000000000000521';
		$data['replay'] = $this->mpacket->getReplay($mobile_address);
		$this->load->template('replay', $data);
	}

	public function replay2() {
		$show = 'only';
		$this->load->model('admin/mfleet_config');
		$this->mfleet_config = new MFleet_config();
		$data['pageTitle'] = "Replay Module";
		$post = $this->input->post();
		if ($post) {
			$mobile_address = $this->input->post("gps_mobile_address");
			$tanggal = $this->input->post("tanggal");
			$tanggal = date("Y-m-d", strtotime($tanggal));
			$data['data_replay'] = $this->mpacket->getReplayData($mobile_address, $tanggal);
		} else {
			$data['allvehicle'] = $this->mfleet_config->getAllVehicle($_SESSION['gps_user_id'], $show);
		}
		$this->load->template('replay2', $data);
	}
}