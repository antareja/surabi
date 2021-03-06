<?php
@session_start();


/**
 * @return string
 * for nodejs, geoserver use only , change return localhost if in local
 */
function base_url_new() {
	$ci= &get_instance();
	if ($_SERVER['SERVER_NAME'] == 'techinfo.dnset.com') {
		$base_url = substr(base_url(), 0, - 1);
		return $base_url;
	} else {
		return $ci->config->item('base_url_new');
	}
}

function parse_packet($packet) {
}

function upload_to($input_name, $name) {
	if ($_FILES[$input_name]) {
		move_uploaded_file($_FILES[$input_name]["tmp_name"], FCPATH . "assets/uploads/" . $name);
	}
}

function null_int($int) {
	return isset($int) ? (int) $int : 0;
}

function to_pg_array($set) {
	settype($set, 'array'); // can be called with a scalar or array
	$result = array();
	foreach ($set as $t) {
		if (is_array($t)) {
			$result[] = to_pg_array($t);
		} else {
			$t = str_replace('"', '\\"', $t); // escape double quote
			if (! is_numeric($t)) // quote only non-numeric values
				$t = '"' . $t . '"';
			$result[] = $t;
		}
	}
	return '{' . implode(",", $result) . '}'; // format
}

function datef($date){
// 	$now = date('Y-m-d H:i:s');
	return date("D M d y h:i:s A", strtotime($date));
}

function unixf($unix) {
	$date = new DateTime();
	$date->setTimestamp($unix);
	return $date->format('Y-m-d');
}

function string_to_bracket($str) {
	$array = array();
	$new_str = explode(';', $str);
	foreach ($new_str as $new) {
		$new2 = str_replace(',', '","', $new);
		array_push($array, '["' . $new2 . '"]');
	}
	$last_str = implode(',', $array);
	return $last_str;
}

function pg_to_php($array) {
	$str = str_replace('"', '', $array);
	$last = substr($array, 1, - 1); // remove curly brace
	return $last;
}

function rm_brace($str) {
	$last = substr($str, 1, - 1); // remove curly brace
	return $last;
}


function define_sess($username, $user_id, $full_name, $level, $company_id,$company_name) {
	$_SESSION['gps_username'] = $username;
	$_SESSION['gps_user_id'] = $user_id;
	$_SESSION['gps_full_name'] = $full_name;
	$_SESSION['gps_level'] = $level;
	$_SESSION['gps_company_id'] = $company_id;
	$_SESSION['gps_company_name'] = $company_name;
	define('USERNAME', $username);
	define('USER_ID', $user_id);
	define('FULLNAME', $full_name);
	// echo USERNAME;exit;
	// print_r($_SESSION);exit;
}

function user_id_sess() {
	return $_SESSION['gps_user_id'];
}

function username_sess() {
	return $_SESSION['gps_username'];
}

function previous_url() {
	if ($_SESSION['last_url']) {
		return header('Location: ' . $_SESSION['last_url']);
	} elseif ($_SESSION['last_url'] == 'logout') {
		echo 'bad';
	} else {
		return redirect('home');
	}
}
// For check Point in Polygon
function poly_contains($point, $polygon) {
	if ($polygon[0] != $polygon[count($polygon) - 1])
		$polygon[count($polygon)] = $polygon[0];
	$j = 0;
	$oddNodes = false;
	$x = $point[1];
	$y = $point[0];
	$n = count($polygon);
	for($i = 0; $i < $n; $i ++) {
		$j ++;
		if ($j == $n) {
			$j = 0;
		}
		if ((($polygon[$i][0] < $y) && ($polygon[$j][0] >= $y)) || (($polygon[$j][0] < $y) && ($polygon[$i][0] >= $y))) {
			if ($polygon[$i][1] + ($y - $polygon[$i][0]) / ($polygon[$j][0] - $polygon[$i][0]) * ($polygon[$j][1] - $polygon[$i][1]) < $x) {
				$oddNodes = ! $oddNodes;
			}
		}
	}
	return $oddNodes;
}
// For check Point in Polygon
function poly_contains_op($point, $polygon) {
	if ($polygon[0] != $polygon[count($polygon) - 1])
		$polygon[count($polygon)] = $polygon[0];
	$j = 0;
	$oddNodes = false;
	$x = $point[0];
	$y = $point[1];
	$n = count($polygon);
	for($i = 0; $i < $n; $i ++) {
		$j ++;
		if ($j == $n) {
			$j = 0;
		}
		if ((($polygon[0][$i] < $y) && ($polygon[0][$j] >= $y)) || (($polygon[0][$j] < $y) && ($polygon[0][$i] >= $y))) {
			if ($polygon[1][$i] + ($y - $polygon[0][$i]) / ($polygon[0][$j] - $polygon[0][$i]) * ($polygon[1][$j] - $polygon[1][$i]) < $x) {
				$oddNodes = ! $oddNodes;
			}
		}
	}
	return $oddNodes;
}

function prev_url() {
	return $_SERVER['HTTP_REFERER'];
}
// dua angka sebelum koma / 60 + angka yg tidak disertakan
function get_coordinate($coor) {
	return $coor;
}

function sum_the_time($times) {
	$seconds = 0;
	foreach ($times as $time) {
		list($hour, $minute, $second) = explode(':', $time);
		$seconds += $hour * 3600;
		$seconds += $minute * 60;
		$seconds += $second;
		// $seconds += $second;
	}
	$hours = floor($seconds / 3600);
	$seconds -= $hours * 3600;
	$minutes = floor($seconds / 60);
	$seconds -= $minutes * 60;
	// return "{$hours}:{$minutes}:{$seconds}";
	return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

function convertGeoToPixel($lon, $lat) {
	global $mapWidth, $mapHeight, $mapLonLeft, $mapLonDelta, $mapLatBottom, $mapLatBottomDegree;
	// $lon=117.00507;
	// $lat=-0.45760;
	$mapWidth = 512;
	$mapHeight = 424;
	$mapLonLeft = $lon - 0.00033;
	$mapLonRight = $lon + 0.00033;
	$mapLonDelta = $mapLonRight - $mapLonLeft;
	$mapLatUp = $lat + 0.00028;
	$mapLatBottom = $lat - 0.00028;
	$mapLatBottomDegree = $mapLatBottom * M_PI / 180;
	$x = ($lon - $mapLonLeft) * ($mapWidth / $mapLonDelta);
	$lat = $lat * M_PI / 180;
	$worldMapWidth = (($mapWidth / $mapLonDelta) * 360) / (2 * M_PI);
	$mapOffsetY = ($worldMapWidth / 2 * log((1 + sin($mapLatBottomDegree)) / (1 - sin($mapLatBottomDegree))));
	$y = $mapHeight - (($worldMapWidth / 2 * log((1 + sin($lat)) / (1 - sin($lat)))) - $mapOffsetY);
	return array(
			$x,
			$y 
	);
}

function remove_bracket($array) {
	foreach ($array as &$string) {
		$string = str_replace(array(
				"(",
				")" 
		), '', $string);
	}
	return $array;
}

function polygon_reverse($str) {
	$latlng = explode(";", $str);
	$latlng = remove_bracket($latlng);
	foreach ($latlng as &$array) {
		$ex_array = explode(',', $array);
		$array = $ex_array[1] . ',' . $ex_array[0];
	}
	return $latlng;
}

function array_reverse_sub($array) {
	$index = 0;
	foreach ($array as $subarray) {
		if (is_array($subarray)) {
			$subarray = array_reverse($subarray);
			$arr = array_reverse_sub($subarray);
			$array[$index] = $arr;
		} else {
			$array[$index] = $subarray;
		}
		$index ++;
	}
	return $array;
}

function add_td($row) {
	return '<td>' . $row . '</td>';
}

function nmea_conv($lat, $lng) {
	$firstLat = substr($lat, 0, 2);
	$secLat = substr($lat, 2);
	$latPerSixty = $secLat / 60;
	$resultLat = - 1 * abs($firstLat + $latPerSixty);
	$firstLng = substr($lng, 0, 3);
	$secLng = substr($lng, 3);
	$lngPerSixty = $secLng / 60;
	$resultLng = $firstLng + $lngPerSixty;
	// echo $resultLat;die();
	return $resultLat . ',' . $resultLng;
}
