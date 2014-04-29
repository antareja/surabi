<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Packet extends CI_Controller {

	public $mapWidth = 512;
	public $mapHeight = 424;
	protected $lat;
	protected $lon;
	
	function __construct() {
		parent::__construct();
		$this->load->model('mpacket');
		$this->mpacket = new MPacket();
	}

	public function index() {
		$this->recv();
	}
	
	public function test() {
		$post = $this->input->post();
		echo 'this is post'. base_url_new();
		echo '<pre>';
		print_r($post);
		echo '<pre>';
	}
	

	public function recv() {
		$post = $this->input->post();
		if ($post) {
			// print_r($post);
			// '\x02G000000000000000000000000521192.168.012.250100*\x03103025,-6.915009,107.600255,0.00,0,40214,8,1.02\x04'
			$data['full_packet'] = $post['full_packet'];
			$data['source_type'] = $post['source'];
			// $data['create_at'] = date("Y-m-d H:i:s.m"); # for ms sql only
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
				// Only for google maps
				$data['location'] = $this->location_op($post['lng'] . ',' . $post['lat']);
				// Test Curl with Ajax
				// $data['full_packet'] = $this->test_curl();
				$data['velocity'] = $post['velocity'];
				$data['bearing'] = $post['bearing'];
				$data['date'] = $post['tanggal'];
				$data['satellite'] = $post['satelite'];
				$data['hdop'] = $post['hdop'];
			} elseif ($post['packet_number'] == '072') {
				$data['input'] = $post['input'];
				$data['state'] = $post['state'];
			}
			$insert_id = $this->mpacket->insertPacket($data);
			// check Speed if exceed
			$this->check_speed($data['velocity'], $insert_id);
			// check Region
			if ($post['packet_number'] == '104' || $post['packet_number'] == '100' && isset($insert_id)) {
				$this->check_point_op($post['lng'], $post['lat'], $insert_id);
			}
			// test Region
			// $this->test_region();
		}
	}
	

	public function location_pg($lng,$lat) {
		$data['distance'] = $this->mpacket->getLocationDistance($lng, $lat);
		$this->load->view('mtools/distance',$data);
	}
	
	public function location($lat) {
		$location = explode(',', $lat);
		$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "&sensor=false&language=id";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
		$data = curl_exec($ch);
		// curl_close($ch);
		$json = json_decode($data, true);
		echo '<pre>';
		print_r($json);
		echo '</pre>';
		$short_name = $json['results'][0]['address_components'][0]['short_name'];
		return $short_name;
	}

// 	function convertGeoToPixel() {
// 		$x = ($this->getLon() - $this->getMapLonLeft()) * ($this->mapWidth / $this->getMapLonDelta);
// 		$this->setLat($this->getLat() * M_PI / 180);
// 		$worldMapWidth = (($this->mapWidth / $this->getMapLonDelta) * 360) / (2 * M_PI);
// 		$mapOffsetY = ($worldMapWidth / 2 * log((1 + sin($this->getMapLatBottomDegree)) / (1 - sin($this->getMapLatBottomDegree))));
// 		$y = $this->mapHeight - (($worldMapWidth / 2 * log((1 + sin($this->getLat())) / (1 - sin($this->getLat())))) - $mapOffsetY);
// 		return array(
// 				$x,
// 				$y 
// 		);
// 	}

	public function location_op($lon, $lat) {
		$mapLonLeft =  $lon-0.00033;
		$mapLonRight = $lon+0.00033;
		$mapLonDelta = $mapLonRight - $mapLonLeft;
		
		$mapLatUp = $lat+0.00028;
		$mapLatBottom = $lat-0.00028;
		$mapLatBottomDegree = $mapLatBottom * M_PI / 180;

		$mapWidth = 512;
		$mapHeight = 424;
		$position = convertGeoToPixel($lon,$lat);
// 		print_r($position);
		$ch = curl_init();
		curl_setopt_array($ch, array(
				CURLOPT_URL => base_url_new() . ":8080/geoserver/tcm/wms?REQUEST=GetFeatureInfo&EXCEPTIONS=application%2Fvnd.ogc.se_xml&BBOX=" . 
				$mapLonLeft . "%2C" . $mapLatBottom . "%2C" . $mapLonRight . "%2C" . $mapLatUp . "&SERVICE=WMS&INFO_FORMAT=application%2Fjson&QUERY_LAYERS=tcm-layer_group&FEATURE_COUNT=50&Layers=tcm-layer_group&WIDTH=512&HEIGHT=424&format=image%2Fpng&styles=&srs=EPSG%3A4326&version=1.1.1&x=" . round($position[0]) . "&y=" . round($position[1]),
				CURLOPT_RETURNTRANSFER => true 
		));
		$output = curl_exec($ch);
		$output = json_decode($output);
// 		echo '<pre>';
// 		print_r($output);
// 		echo '</pre>';
		$jalan = "";
		$provinsi = "";
		if (isset($output->features[3]->properties->NAME)) {
			$jalan = $output->features[3]->properties->NAME;
		} else if (isset($output->features[1]->properties->name)) {
			$jalan = $output->features[1]->properties->name;
		}
		if (isset($output->features[0]->properties->PROV)) {
			$provinsi = $output->features[0]->properties->PROV;
		}
		echo $lokasi = $jalan . " " . $provinsi;
	}

	public function get_loc() {
		$data['type'] = 'region';
		$data['type_id'] = '1';
		$data['packet_id'] = '333';
		$this->db->insert('alert', $data);
	}

	public function test_curl() {
		// $url = "http://surabi.dev/packet/check_region_op/-0.449062/116.896477/199";
		$url = 'http://surabi.dev/location/loc2/-6.89931/107.62638';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
		$data = curl_exec($ch);
		curl_close($ch);
		// $json = json_decode($data, true);
		// print_r($json);
		// $short_name = $json['results'][0]['address_components'][0]['short_name'];
		echo $data;
		return $data;
	}

	public function check_point_op($lng, $lat, $packet_id) {
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		$data['latlng'] = $lng . ',' . $lat;
		$data['packet_id'] = $packet_id;
		$vehicle_id = $this->mpacket->getVehicle($packet_id);
		$data['region'] = $this->mpacket->getRegion($vehicle_id);
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
		// print_r($polygon);exit;
		$in_out = poly_contains($point, $polygon) ? 'in' : 'out';
		// print_r($polygon);exit;
		$in_out == $region->in_out ? $this->region_alert($region->region_id, $packet_id) : '';
		// echo 'test<br/>';
		// echo $in_out;
		return $in_out;
	}

	public function check_point($lat, $lng, $packet_id) {
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		$data['latlng'] = $lat . ',' . $lng;
		$data['packet_id'] = $packet_id;
		$vehicle_id = $this->mpacket->getVehicle($packet_id);
		$data['region'] = $this->mpacket->getRegion($vehicle_id);
		$region = $data['region'];
		$latlngs = explode(';', $region->latlng);
		$point = array(
				$lat,
				$lng 
		);
		$polygon = array();
		foreach ($latlngs as $latlng) {
			$lat = explode(',', rm_brace($latlng));
			array_push($polygon, array(
					$lat[0],
					$lat[1] 
			));
		}
		$in_out = poly_contains($point, $polygon) ? 'in' : 'out';
		$in_out == $region->in_out ? $this->region_alert($region->region_id, $packet_id) : '';
		// echo 'test';
		return $in_out;
	}

	public function check_region($lat, $lng, $packet_id) {
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		$data['latlng'] = $lat . ',' . $lng;
		$data['packet_id'] = $packet_id;
		$vehicle_id = $this->mpacket->getVehicle($packet_id);
		$data['region'] = $this->mpacket->getRegion($vehicle_id);
		$data['polygon'] = $data['region']->latlng;
		$region = $data['region'];
		// print_r($region);
		$latlngs = explode(';', $region->latlng);
		// var_dump($latlngs);exit;
		$point = array(
				$lat,
				$lng 
		);
		$polygon = array();
		foreach (remove_bracket($latlngs) as $latlng) {
			$lat = explode(',', $latlng);
			array_push($polygon, array(
					$lat[0],
					$lat[1] 
			));
		}
		$data['in_out'] = poly_contains($point, $polygon) ? 'IN' : 'OUT';
		echo $data['in_out'];
		$data['in_out'] == $region->in_out ? $this->region_alert() : '';
		// print_r($polygon);
		// print_r($central_park2);
		$this->load->view('alert_region', $data);
	}

	public function check_region_op($lng, $lat, $packet_id) {
		$data['lat'] = $lat;
		$data['lng'] = $lng;
		$data['latlng'] = $lng . ',' . $lat;
		$data['packet_id'] = $packet_id;
		$vehicle_id = $this->mpacket->getVehicle($packet_id);
		$data['region'] = $this->mpacket->getRegion($vehicle_id);
		$data['polygon'] = polygon_reverse($data['region']->latlng);
		$region = $data['region'];
		// print_r($region);
		$latlngs = explode(';', $region->latlng);
		$point = array(
				$lng,
				$lat 
		);
		// print_r($point);exit;
		$polygon = array();
		foreach (remove_bracket($latlngs) as $latlng) {
			$lat = explode(',', $latlng);
			array_push($polygon, array(
					$lat[1],
					$lat[0] 
			));
		}
		// print_r($polygon);exit;
		$data['in_out'] = poly_contains($point, $polygon) ? 'in' : 'out';
		echo $data['in_out'];
		$data['in_out'] == $region->in_out ? $this->region_alert() : '';
		// print_r($polygon);
		// print_r($central_park2);
		$this->load->view('alert_region', $data);
	}

	public function region_alert($region_id, $packet_id) {
		$data['type'] = 'region';
		$data['type_id'] = $region_id;
		$data['packet_id'] = $packet_id;
		// print_r($data);
		$this->mpacket->insertRegionAlert($data);
	}

	public function get_vehicle($id) {
		echo $this->mpacket->getVehicle($id);
	}

	public function check_speed($speed, $packet_id) {
		if ($this->mpacket->getDefaultSpeed($speed)) {
			$data['type'] = 'speed';
			$data['type_id'] = 1;
			$data['packet_id'] = $packet_id;
			echo $this->mpacket->insertSpeedAlert($data);
		}
	}

	public function check_test($speed) {
		if ($this->mpacket->getDefaultSpeed($speed)) {
			echo 'exceed max';
		} else {
			echo 'kecepatan aman';
		}
	}

	public function parse() {
		$packet = '\x02G000000000000000000000000521192.168.012.250100*\x03103025,-6.915009,107.600255,0.00,0,40214,8,1.02\x04';
		echo $packet;
	}

	public function test_post() {
		$data['create_at'] = date("Y-m-d H:i:s.m");
		$this->mpacket->insertPacket($data);
		echo 'test';
	}
	
	public function notify_node() {
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, 'http://192.168.12.250');
	
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		curl_setopt($ch, CURLOPT_PORT, 8000);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	
		curl_setopt($ch, CURLOPT_POST, true);
	
		$foo  = 'hellow world';

		curl_setopt($ch, CURLOPT_POSTFIELDS, $foo);
	
		curl_exec($ch);
		curl_close($ch);
	}

	public function get_notif(){
		$this->load->view('tools/node');
	}
}