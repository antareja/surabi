<?php

function parse_packet($packet){
	
}

function upload_to($input_name, $name){
	if ($_FILES[$input_name]) {
		move_uploaded_file($_FILES[$input_name]["tmp_name"], FCPATH . "assets/uploads/" . $name);
	}
}