<?php
@session_start();

function parse_packet($packet) {
}

function upload_to($input_name, $name) {
	if ($_FILES[$input_name]) {
		move_uploaded_file($_FILES[$input_name]["tmp_name"], FCPATH . "assets/uploads/" . $name);
	}
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

function pg_to_php($array) {
	$str = str_replace('"', '', $array);
	$last = substr($array, 1, - 1); // remove curly brace
	return $last;
}

function rm_brace($str) {
	$last = substr($str, 1, - 1); // remove curly brace
	return $last;
}

function define_sess($username,$user_id,$full_name){
	$_SESSION['gps_username'] = $username; 
	$_SESSION['gps_user_id'] = $user_id; 
	$_SESSION['gps_full_name'] = $full_name;
	define('USERNAME', $username); 
	define('USER_ID', $user_id); 
	define('FULLNAME', $full_name); 
	//echo USERNAME;exit;
	//print_r($_SESSION);exit;
}

function previous_url() {
	if ($_SESSION['last_url']) {
		return header('Location: ' . $_SESSION['last_url']);
	} elseif($_SESSION['last_url'] == 'logout' ) {
		echo 'bad';
	} else {
		return redirect('home');
	}
}

function sum_the_time($times) {
	$seconds = 0;
	foreach ($times as $time) {
		list($hour, $minute) = explode(':', $time);
		$seconds += $hour * 3600;
		$seconds += $minute * 60;
		// $seconds += $second;
	}
	$hours = floor($seconds / 3600);
	$seconds -= $hours * 3600;
	$minutes = floor($seconds / 60);
	$seconds -= $minutes * 60;
	// return "{$hours}:{$minutes}:{$seconds}";
	return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}