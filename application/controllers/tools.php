<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Tools extends CI_Controller {
	

	private $time_start     =   0;
	private $time_end       =   0;
	private $time           =   0;

	function __construct() {
		parent::__construct();
		$this->time_start= microtime(true);
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

	public function get_ini() {
		$ini = $this->config->item('ini_file');
		echo '<pre>';
		echo $ini['timezone'];
		echo '</pre>';
	}

	public function sum() {
		$time = array(
				'09:30:40',
				'03:40:40',
				'02:50:30' 
		);
		$sum = sum_the_time($time);
		echo $sum;
	}

	public function create_user() {
		$vendor = 'vendorB';
		echo $vendor;
		for($i = 1; $i < 10; $i ++) {
			$data['username'] = $vendor . $i;
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
			echo 'Success = ' . $id . '<br/>';
		}
	}

	public function create_vehicle() {
		$name = 'HoulTrackA';
		for($i = 2; $i < 10; $i ++) {
			$data['name'] = $name . $i;
			$data['gps_mobile_address'] = '0000000000000000000000052' . $i;
			$data['hardware_id'] = 3;
			$data['base_id'] = 5;
			// $data['driver_id'] = 1;
			// $data['user_id'] = 12;
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

	public function array_td() {
		// echo FCPATH;exit;
		$array = array(
				'nama1',
				'nama2',
				'nama3',
				'nama4' 
		);
		foreach ($array as &$row) {
			$row = '<td>' . $row . '</td>';
		}
		print_r($array);
	}

	public function nmea_conv($lat, $lng) {
		$data['pageTitle'] = 'GPS NMEA Converter';
		// example 0019.15266 , 11551.34587
		$firstLat = substr($lat, 0, 2);
		$secLat = substr($lat, 2);
		$latPerSixty = $secLat / 60;
		$resultLat = - 1 * abs($firstLat + $latPerSixty);
		$firstLng = substr($lng, 0, 3);
		$secLng = substr($lng, 3);
		$lngPerSixty = $secLng / 60;
		$resultLng = $firstLng + $lngPerSixty;
		// echo $resultLat;die();
		$data['lat'] = $resultLat;
		$data['lng'] = $resultLng;
		$this->load->view('tools/nmea_convert', $data);
	}


	public function distance(){
		$data['lat'] = -0.47171315382621;
		$data['lng'] = 115.72020039136;
		$this->load->view('tools/distance',$data);
	}
	/**
	 * Convert from fleet control packet data
	 */
	public function nmea_conv_fleet() {
		$query = $this->mtools->convert_nmea_fleet();
		echo 'success';
	}

	public function conv_xy($x, $y) {
		$this->load->library('gPoint');
		$gPoint = new gPoint();
		$gPoint->setUTM($x, $y, "50");
		$gPoint->convertTMtoLL();
		echo 'LngLat' . $gPoint->Long() . ',' . $gPoint->Lat() . "<br>";
		$distance = $this->mtools->getClosestDistance($gPoint->Long(), $gPoint->Lat());
		foreach ($distance as $dis) {
			echo $dis->label . " jarak <b>" . $dis->distance_m . "</b>  lnglat" . $dis->lng . ',' . $dis->lng . '<br>';
		}
	}
	
	public function fphp(){
		$this->load->library('fb');
		//$fb = new FB();
		ob_start();
		$var = array('a'=>'pizza', 'b'=>'cookies', 'c'=>'celery');
		$test = 'haidar';
		fb($test);
		fb($var);
		fb($var, "An array");
		fb($var, FirePHP::WARN);
		fb($var, FirePHP::INFO);
		fb($var, 'An array with an Error type', FirePHP::ERROR);
	}
	
	public function get_close($lng,$lat) {
		$distance = $this->mtools->getClosestDistance($lng, $lat);
	}
	
	public function omap(){
		$this->load->view('tools/omap');
	}
	
	public function conv_xy_db() {
		$this->load->library('gPoint');
		$data['gPoint'] = new gPoint();
		// $gPoint->setLongLat(-121.85831, 37.42104);
		// echo "I live at: "; $gPoint->printLatLong(); echo "<br>";
		$data['mtools'] = $this->mtools;
		// $gPoint->convertLLtoTM();
		// echo "Which in a UTM projection is: "; $gPoint->printUTM(); echo "<br>";
		$data['xyRoad'] = $this->mtools->getAllXYroad();
		// foreach ($data['xyRoad'] as $xy) {
		// $gPoint->setUTM( $xy->x, $xy->y, "50");
		// $gPoint->convertTMtoLL();
		// echo $gPoint->Long();
		// echo $gPoint->Lat();
		// $gPoint->printLatLong();
		// echo "Location $xy->label: "; $gPoint->long; echo "<br>";
		// }
		$this->load->view('tools/conv_xy', $data);
	}

	public function check_poly_new($lng, $lat) {
		$start = microtime(true);
		$this->load->library('pointLocation');
		$pointLocation= new pointLocation();
		$region = $this->mtools->getRegion();
		
		$points = array("$lng $lat");
// 		$polygon = array("-50 30","50 70","100 50","80 10","110 -10","110 -30","-20 -50","-30 -40","10 -10","-10 10","-30 -20","-50 30");
		$polygon = array(
				"115.66707935239 -0.57043896996875","115.68964623419 -0.58305510073695",
				"115.72678385857 -0.57772434125743","115.72891616236 -0.55551284342609",
				"115.6690339642 -0.56244283074947","115.66707935239 -0.57043896996875"
				);
		// The last point's coordinates must be the same as the first one's, to "close the loop"
		foreach($points as $key => $point) {
			echo "point " . ($key+1) . " ($point): " . $pointLocation->pointInPolygon($point, $polygon) . "<br>";
		}
        $this->time_end = microtime(true);
        $this->time = $this->time_end - $this->time_start;
        echo "Loaded in $this->time seconds\n";
	}
	
	public function time_test(){
		$tri = array();
		for ($i = 0; $i < 1000000; ++$i) {
			$x = round(sin($i), 5);
			$y = round(tan($x), 3);
			$z = round(cos($y), 4);
			array_push($tri, $z);
			// do something
// 			echo $x;
		}
		echo '<pre>';
		print_r($z);
		echo '</pre>';
        $this->time_end = microtime(true);
        $this->time = $this->time_end - $this->time_start;
        echo "Loaded in $this->time seconds\n";
	}
	
	public function img_test(){
		$filename = FCPATH.'assets\uploads\icon_1.png';
		$imgPng = imagecreatefrompng($filename);
		imageAlphaBlending($imgPng, true);
		imageSaveAlpha($imgPng, true);
		
		/* Output image to browser */
		header("Content-type: image/png");
		imagePng($imgPng);
	}
	
	public function rotation($deg){
		$filename = FCPATH.'assets\uploads\icon_1.png';
		$rotang = $deg; // Rotation angle
		$source = imagecreatefrompng($filename) or die('Error opening file '.$filename);
		imagealphablending($source, false);
		imagesavealpha($source, true);
		
		$rotation = imagerotate($source, $rotang, imageColorAllocateAlpha($source, 0, 0, 0, 127));
		imagealphablending($rotation, false);
		imagesavealpha($rotation, true);
		
		header('Content-type: image/png');
		imagepng($rotation);
		imagedestroy($source);
		imagedestroy($rotation);
	}
	
	public function complex(){
		$time = -microtime(true);
		$hash = 0;
		for ($i=0; $i < rand(10000000,40000000); ++$i) {
			$hash ^= md5(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, rand(1,10)));
		}
		$time += microtime(true);
		echo "Hash: $hash iterations:$i time: ",sprintf('%f', $time),PHP_EOL;
	}
	
	public function new_time(){
		// Randomize sleeping time
		usleep(mt_rand(100, 10000));
		
		// As of PHP 5.4.0, REQUEST_TIME_FLOAT is available in the $_SERVER superglobal array.
		// It contains the timestamp of the start of the request with microsecond precision.
		$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
		
		echo "Did nothing in $time seconds\n";
	}

	public function check_poly($lng, $lat) {
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		echo $lat . ',' . $lng;
		$data['latlng'] = $lng . ',' . $lat;
		$data['region'] = $this->mtools->getRegion();
		$region = $data['region'];
		$lnglats = explode(';', $region->latlng);
		// print_r($lnglats);exit;
		$point = array(
				$lat,
				$lng 
		);
		$polygon = array();
		foreach ($lnglats as $lnglat) {
			// echo $lnglat.'<br/>';
			$lng = explode(',', $lnglat);
			array_push($polygon, array(
					$lng[1],
					$lng[0] 
			));
		}
		echo "<pre>";
		print_r($polygon);
		print_r($point);
		echo "</pre>";
		$in_out = poly_contains($point, $polygon) ? 'in' : 'out';
		// print_r($polygon);exit;
		$in_out == $region->in_out ? 'ada' : '';
		// echo 'test<br/>';
		echo $in_out;
		return $in_out;
	}

	public function update_lat_lng($lat, $lng, $road_id) {
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		echo $lat;
		// return $this->mtools->updateLatLngRoad($data, $road_id);
	}

	public function progress() {
		// $total = 10;
		// // Loop through process
		// for($i=1; $i<=$total; $i++){
		// // Calculate the percentation
		// $percent = intval($i/$total * 100)."%";
		// echo $percent. ' -'. $i;
		// sleep(20);
		// echo str_repeat(' ',1024*64);
		// }
		$this->load->view('tools/progress');
	}
	
	public function panggil_ini(){
		$ci= &get_instance();
		print_r( $ci->config->item['smtp_mail']);
	}
	
	public function asep($angka,$angka2){
		echo $angka;
		echo $angka2;
	}

	public function mail() {
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'haidar.mukmin@gmail.com',
				'smtp_pass' => '',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1' 
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->to('haidar@techinfo.co.id');
		$this->email->cc('coder5@ymail.com');
		$this->email->cc('haidar.mukmin@gmail.com');
		$this->email->bcc('haidar.marie3@gmail.com');
		$this->email->from('haidar.mukmin@gmail.com', 'haidar.mukmin@gmail.com');
		// $this->email->to('fiterlan_k@banpuindo.co.id');
		// $this->email->to('haidar@techinfo.co.id');
		// $this->email->bcc('haidar.mukmin@gmail.com');
		$this->email->subject('Notification Speed Alert');
		$html = 'This is an <b>HTML</b> email with an attachment,
        <i>lovely!</i>';
		$this->email->message($html);
		if ($this->email->send()) {
			echo "email has been send!";
		} else {
			echo $this->email->print_debugger();
		}
	}
	
	public function datef(){
		$now = date('Y-m-d H:i:s');
		setlocale(LC_TIME, "id");
		$date = date("D M y h:i:s A", strtotime($now));
		echo $date;
		echo strftime("%a", strtotime("1/9/2005"));
	}
	
	public function roundf($lng, $lat){
		$latf = floor($lat*1000+0.5)/1000;
		$lngf = floor($lng*1000+0.5)/1000;
		echo $lngf. ' '. $latf;
	}
}