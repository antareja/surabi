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
		for($i=0;$i<10;$i++) {
			echo $i;
		}
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