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
	
	public function sum() {
		$time = array('09:30:40','03:40:40', '02:50:30');
		$sum = sum_the_time($time);
		echo $sum;
	}
	
	public function create_user(){
		$vendor = 'vendorB';
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
			$data['admin_id'] = 7;
			$data['company_id'] = 2;
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
	
	public function array_td(){
// 		echo FCPATH;exit;
		$array = array('nama1','nama2','nama3','nama4');
		foreach($array as &$row) {
			$row = '<td>'.$row.'</td>';
		}
		print_r($array);
		
	}
	
	public function nmea_conv($lat,$lng){
		$data['pageTitle'] = 'GPS NMEA Converter';
		# example 0019.15266 , 11551.34587
		$firstLat = substr($lat,0,2);
		$secLat = substr($lat,2);
		$latPerSixty = $secLat / 60;
		$resultLat = -1 * abs($firstLat + $latPerSixty);

		$firstLng = substr($lng,0,3);
		$secLng = substr($lng,3);
		$lngPerSixty = $secLng / 60;
		$resultLng = $firstLng + $lngPerSixty;
// 		echo $resultLat;die();
		$data['lat'] = $resultLat;
		$data['lng'] = $resultLng;
		$this->load->view('tools/nmea_convert',$data);
	}
	
	/**
	 * Convert from fleet control packet data
	 */
	public function nmea_conv_fleet(){
		$query = $this->mtools->convert_nmea_fleet();
		echo 'success';
	}
	
	public function conv_xy(){
		$this->load->library('gPoint');
		$data['gPoint'] = new gPoint();
// 		$gPoint->setLongLat(-121.85831, 37.42104);

// 		echo "I live at: "; $gPoint->printLatLong(); echo "<br>";
		$data['mtools'] = $this->mtools;
// 		$gPoint->convertLLtoTM();
// 		echo "Which in a UTM projection is: "; $gPoint->printUTM(); echo "<br>";
		$data['xyRoad'] = $this->mtools->getAllXYroad();
//		foreach ($data['xyRoad'] as $xy) {
// 			$gPoint->setUTM( $xy->x, $xy->y, "50");
// 			$gPoint->convertTMtoLL();
// 			echo $gPoint->Long();
// 			echo $gPoint->Lat();
// 			$gPoint->printLatLong();
// 			echo "Location $xy->label: "; $gPoint->long; echo "<br>";
//		}
		$this->load->view('tools/conv_xy',$data);
	}
	
	public function update_lat_lng($lat, $lng, $road_id){
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		echo $lat;
		//return $this->mtools->updateLatLngRoad($data, $road_id);
	}
	
	public function progress(){
// 		$total = 10;
// 		// Loop through process
// 		for($i=1; $i<=$total; $i++){
// 			// Calculate the percentation
// 			$percent = intval($i/$total * 100)."%";
// 			echo $percent. ' -'. $i;
// 			sleep(20);
// 			echo str_repeat(' ',1024*64);
// 		}
		$this->load->view('tools/progress');
	}
}