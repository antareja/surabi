<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar & rizki
 *        
 */
class Fleet_config extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/mfleet_config');
		$this->mfleet_config = new MFleet_config();
	}

	public function index() {
		$this->base();
	}

	/**
	 *
	 * @param string $base_id        	
	 */
	public function base($base_id = NULL) {
		$data['pageTitle'] = 'Base';
		$data['all_base'] = $this->mfleet_config->getAllBase();
		$post = $this->input->post();
		if ($post) {
			$post_data['name'] = $post['name'];
			$post_data['icon_id'] = $post['icon_id'];
			$post_data['description'] = $post['description'];
			$post_data['address'] = $post['address'];
			$post_data['phone'] = $post['phone'];
			$post_data['phone2'] = $post['phone2'];
			$post_data['fax'] = $post['fax'];
			$post_data['email'] = $post['email'];
			if ($post['id_base']) {
				$this->mfleet_config->editBase($base_id, $post_data);
				redirect('admin/fleet_config/'.$base_id);
			} else {
				$id = $this->mfleet_config->insertBase($post_data);
				redirect('admin/fleet_config/'.$id);
			}
		} elseif ($base_id) {
			$data['base'] = $this->mfleet_config->getBase($base_id);
			$this->load->template("admin/fleet_config/base", $data);
		} else {
			$this->load->template("admin/fleet_config/base", $data);
		}
	}
	
	/**
	 * @param string $vehicle_id
	 */
	public function vehicle($vehicle_id = NULL) {
		$data['pageTitle'] = 'Vehicle';
		$data['hardwares'] = $this->mfleet_config->getAllHardware();
		$data['bases'] = $this->mfleet_config->getAllBase();
		$data['icons'] = $this->mfleet_config->getAllIcon();
		$data['vehicles'] = $this->mfleet_config->getAllVehicles();
		$post = $this->input->post();
		if ($post) {
			// print_r($this->upload->data());
			print_r($post);
			// Upload file image
			$post_data['name'] = $post['name'];
			$post_data['base_id'] = $post['base_id'];
			$post_data['icon_id'] = $post['icon_id'];
			// $post_data['status_alert_profile'] = $post['status_alert_profile'];
			// for edit data
			if (isset($post['vehicle_id'])) {
				$this->mfleet_config->updateVehicle($post_data, $post['vehicle_id']);
				redirect('admin/fleet_config/vehicle/' . $vehicle_id);
			} else {
				// for add $_POST data
				$id = $this->mfleet_config->insertVehicle($post_data);
				redirect('admin/fleet_config/vehicle/' . $id);
			}
			// for view or edit data
		} elseif ($vehicle_id) {
			$data['vehicle'] = $this->mfleet_config->getVehicle($vehicle_id);
			// check if id exists
			if(isset($data['vehicle']->vehicle_id)){
				$this->load->template("admin/fleet_config/vehicle", $data);
			} else {
				unset($data['vehicle']);
				$this->load->template("admin/fleet_config/vehicle", $data);
			}
			// for add data only
		} else {
			$this->load->template("admin/fleet_config/vehicle", $data);
		}
	}
}