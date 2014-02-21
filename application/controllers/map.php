<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * @author haidar
 *
 */
class Map extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mmap');
		$this->mmap = new MMap();
	}

	public function index() {
		$this->region();
	}

	public function region($region_id = NULL) {
		$data['pageTitle'] = 'Region';
		$data['all_region'] = $this->mmap->getAllRegion();
		$post = $this->input->post();
		if ($post) {
			$post_data['name'] = $post['name'];
			$post_data['description'] = $post['description'];
			$post_data['employee_id'] = "1";
			$post_data['latlng'] = implode(";",$post['txt_posisi']);
			$post_data['expire_time'] = $post['expire_time'];
			$post_data['time_start'] = $post['time_start'];
			$post_data['time_end'] = $post['time_end'];
			$post_data['in_out'] = $post['in_out'];
			$post_data['color'] = $post['color'];
			if (isset($post['region_id'])) {
				$this->mmap->updateRegion($post_data, $post['region_id']);
				redirect('map/region/' . $post['region_id']);
			} else {
				// for add $_POST data
				$id = $this->mmap->insertRegion($post_data);
				redirect('map/region/' . $id);
			}
			// for view or edit data
		} elseif ($region_id) {
			$data['region'] = $this->mmap->getRegion($region_id);
			// check if id exists
			if(isset($data['region']->region_id)){
				$this->load->template("map/region", $data);
			} else {
				unset($data['region']);
				$this->load->template("map/region", $data);
			}
			// for add data only
		} else {
			$this->load->template("map/region", $data);
		}
	}
}