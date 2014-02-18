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
			//print_r($post);
			// '\x02G000000000000000000000000521192.168.012.250100*\x03103025,-6.915009,107.600255,0.00,0,40214,8,1.02\x04'
			// $data['full_packet'] = $post['full_packet'];
			$data['source_type'] = $post['source'];
			$data['create_at'] = date("Y-m-d H:i:s.m");
			$data['system_id'] = $post['system'];
			$data['mobile_address'] = $post['mobile'];
			$data['base_ip_address'] = $post['base_ip'];
			$data['base_modem_channel_address'] = $post['base_modem_channel'];
			if ($post['packet_number'] == '104' || $post['packet_number'] == '100') {
				$data['packet_number'] = $post['packet_number'];
				$data['status_key'] = $post['status'];
				$data['minutes_offset'] = $post['offset'];
				$data['numerics'] = $post['numeric'];
				$data['time'] = $post['jam'];
				$data['latitude'] = $post['lat'];
				$data['longitude'] = $post['lng'];
				$data['velocity'] = $post['velocity'];
				$data['bearing'] = $post['bearing'];
				$data['date'] = $post['tanggal'];
				$data['satellite'] = $post['satelite'];
				$data['hdop'] = $post['hdop'];
			} elseif ($post['packet_number'] == '072') {
				$data['input'] = $post['input'];
				$data['state'] = $post['state'];
			}
			if ($this->mpacket->insertPacket($data)) {
				// print_r($data);
				echo 'success';
			}
		}
	}

	public function test_post() {
		$data['create_at'] = date("Y-m-d H:i:s.m");
		$this->mpacket->insertPacket($data);
		echo 'test';
	}

	public function parse() {
		$packet = '\x02G000000000000000000000000521192.168.012.250100*\x03103025,-6.915009,107.600255,0.00,0,40214,8,1.02\x04';
	}
}