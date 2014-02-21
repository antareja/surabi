<?php

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

function pg_to_php($array){
	$str = str_replace('"', '', $array);
	$last = substr($array, 1, -1); // remove curly brace
	return $last;
	
}

function rm_brace($str) {
	$last = substr($str, 1, -1); // remove curly brace
	return $last;
}