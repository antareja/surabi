<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Profile extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mprofile');
		$this->mprofile = new MProfile();
	}

	public function index() {
		$this->region();
	}

	public function region_alert($region_id = NULL) {
		$data['pageTitle'] = 'Region';
		$data['all_region'] = $this->mprofile->getAllRegion();
		$post = $this->input->post();
		if ($post) {
			$post_data['name'] = $post['name'];
			$post_data['description'] = $post['description'];
			$post_data['user_id'] = user_id_sess();
			if (!empty($post['txt_posisi'])) {
				$post_data['latlng'] = implode(';',$post['txt_posisi']);
			}
			$post_data['expire_time'] = $post['expire_time'];
			$post_data['time_start'] = $post['time_start'];
			$post_data['time_end'] = $post['time_end'];
			$post_data['in_out'] = $post['in_out'];
			$post_data['color'] = $post['color'];
// 			print_r($post);exit;
			if (isset($post['region_id'])) {
				$this->mprofile->updateRegion($post_data, $post['region_id']);
				redirect('profile/region_alert/' . $post['region_id']);
			} else {
				// for add $_POST data
				$id = $this->mprofile->insertRegion($post_data);
				redirect('profile/region_alert/' . $id);
			}
			// for view or edit data
		} elseif ($region_id) {
			$data['region'] = $this->mprofile->getRegion($region_id);
			// check if id exists
			if (isset($data['region']->region_id)) {
				$this->load->template("profile/region_alert", $data);
			} else {
				unset($data['region']);
				$this->load->template("profile/region_alert", $data);
			}
			// for add data only
		} else {
			$this->load->template("profile/region_alert", $data);
		}
	}
	
	public function region_test(){
		$this->load->view("tools/indonesia.php");
	}

	public function region_delete($region_id) {
		$this->mprofile->deleteRegion($region_id);
		redirect('profile/region_alert');
	}

	public function speed_alert($speed_id = NULL) {
		$data['pageTitle'] = "Speed Alert";
		$data['all_speed'] = $this->mprofile->getAllSpeedAlert();
		$data['all_vehicle'] = $this->mprofile->getAllVehicle();
		$post = $this->input->post();
		if ($post) {
			$post_data['max_speed'] = $post['max_speed'];
			$post_data['mobile_address'] = $post['mobile_address'];
			$post_data['user_id'] = $_SESSION['gps_user_id'];
			$post_data['name'] = $post['name'];
			$post_data['description'] = $post['description'];
			if (isset($post['speed_id'])) {
				$this->mprofile->updateSpeedAlert($post_data, $post['speed_id']);
				redirect('profile/speed_alert/' . $post['speed_id']);
			} else {
				$id = $this->mprofile->insertSpeedAlert($post_data);
				redirect('profile/speed_alert/' . $id);
			}
		} elseif ($speed_id) {
			$data['speed'] = $this->mprofile->getSpeedAlert($speed_id);
			if (isset($data['speed']->speed_id)) {
				$this->load->template('profile/speed_alert', $data);
			} else {
				unset($data['speed']);
				$this->load->template('profile/speed_alert', $data);
			}
		} else {
			$this->load->template('profile/speed_alert', $data);
		}
	}

	public function speed_delete($speed_id) {
		$this->mprofile->deleteSpeedAlert($speed_id);
		redirect('profile/speed_alert');
	}
}
