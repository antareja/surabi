<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Tools extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mtools');
		$this->mtools = new MTools();
	}

	public function index() {
		$this->loc();
	}

	public function test() {
		echo 'haidar';
		$str = '116.70342341822,-0.49924192863678;116.74180488647,-0.58595561617035;117.10429653108,-0.51487882311005;117.09150270833,-0.4096851693808';
		$new = string_to_bracket($str);
		echo $new;
	}
	
	public function create_user(){
		$vendor = 'vendorA';
		echo $vendor;
		for($i=1;$i<10;$i++) {
			$data['username'] = $vendor.$i;
			$data['password'] = md5('testing');
			$data['email'] = 'testing@testing.com';
			$data['phone'] = '1234567';
			$data['phone2'] = '1234567';
			$data['address'] = $vendor;
			$data['fullname'] = $vendor;
			$data['level'] = 'operator';
			$data['admin_id'] = 8;
			$data['company_id'] = 3;
			$id = $this->mtools->insertUser($data);
			echo 'Success = '.$id.'<br/>';
		}
	}
	
	public function create_vehicle(){
		$name = 'HoulTrackA';
		for($i=2;$i<10;$i++){
			$data['name'] = $name.$i;
			$data['gps_mobile_address'] = '0000000000000000000000052'.$i;
			$data['hardware_id'] = 3;
			$data['base_id'] = 5;
// 			$data['driver_id'] = 1;
// 			$data['user_id'] = 12;
			$data['company_id'] = 3;
			$this->mtools->insertVehicle($data);
		}
	}

	public function loc($lat) {
		$location = explode(',', $lat);
		$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "&sensor=false&language=id";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
		$data = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($data, true);
		$short_name = $json['results'][0]['address_components'][0]['short_name'];
		echo $short_name;
	}

	public function loc2($lat, $lng) {
		// $loc = $this->loc('-6.89931,107.62638');
		// echo $loc;
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		$this->load->view('tools/location', $data);
	}

	public function get_loc() {
		$ch = curl_init();
		curl_setopt_array($ch, array(
				CURLOPT_URL => site_url() . "location/loc/-6.89931/107.62638",
				CURLOPT_RETURNTRANSFER => true 
		));
		$output = curl_exec($ch);
		echo $output;
	}
}