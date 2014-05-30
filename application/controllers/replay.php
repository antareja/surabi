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
	
	public function fphp(){
		//$fb = new FB();
		$test = 'haidar gets';
		fb($test);
	}
	

	public function replay2($mobile_address = NULL, $unix = NULL, $time = NULL) {
		ob_start();
		//fb('haidar get one');
		$this->firephp->log("FirePHP is working!");
		//print_r($this->firephp);
		$show = 'only';
		$this->load->model('admin/mfleet_config');
		$this->mfleet_config = new MFleet_config();
		$data['pageTitle'] = "Replay Module";
		if ($mobile_address) {
			$data['mobile_address'] = $mobile_address;
// 			$time_begin = isset($post["time"]) ? $post['time'] : '07:00:00';
// 			$time_end = isset($post["time"]) ? $post['time'] : '11:00:00';
			$time = isset($time) ? $time : '07';
			if($time =='07') {
				$time_begin = '07:00:00';
				$time_end = '11:00:00';
			} elseif($time == '11') {
				$time_begin = '11:00:00';
				$time_end = '15:00:00';
			} elseif($time == '15') {
				$time_begin = '15:00:00';
				$time_end = '19:00:00';
			} elseif ($time == '19') {
				$time_begin = '19:00:00';
				$time_end = '23:00:00';
			} else {
				$time_begin = '07:00:00';
				$time_end = '11:00:00';
			}
			$data['mobile_address'] =  $mobile_address;
			$data['time'] = $time;
			$date = unixf($unix);
			$data['unixf'] = $date;
			$data['unix'] = $unix;
			//$date = date("Y-m-d", strtotime($date));
			$data['data_replay'] = $this->mpacket->getReplayData($mobile_address, $date, $time_begin, $time_end);
		} else {
			$data['allvehicle'] = $this->mfleet_config->getAllVehicle($_SESSION['gps_user_id'], $show);
		}
		$this->load->template('replay2', $data);
	}
}