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
		$this->load->model('admin/muser');
		$this->mfleet_config = new MFleet_config();
		$this->muser = new MUser();
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
				redirect('admin/fleet_config/' . $base_id);
			} else {
				$id = $this->mfleet_config->insertBase($post_data);
				redirect('admin/fleet_config/' . $id);
			}
		} elseif ($base_id) {
			$data['base'] = $this->mfleet_config->getBase($base_id);
			$this->load->template("admin/fleet_config/base", $data);
		} else {
			$this->load->template("admin/fleet_config/base", $data);
		}
	}

	/**
	 *
	 * @param string $vehicle_id        	
	 */
	public function vehicle($vehicle_id = NULL) {
		$data['pageTitle'] = 'Vehicle';
		$data['hardwares'] = $this->mfleet_config->getAllHardware();
		$data['companies'] = $this->mfleet_config->getAllCompany();
		$data['drivers'] = $this->mfleet_config->getAllDriver();
		if ($_SESSION['gps_level'] == 'admin') {
			$data['users'] = $this->mfleet_config->getAllUserByAdmin($_SESSION['gps_user_id']);
		} elseif ($_SESSION['gps_level'] == 'admin_vendor') {
			$data['users'] = $this->mfleet_config->getAllUserByAdmin($_SESSION['gps_user_id']);
		}
		$data['all_vehicle'] = $this->mfleet_config->getAllVehicle();
		$data['bases'] = $this->mfleet_config->getAllBase();
		$data['icons'] = $this->mfleet_config->getAllIcon();
		$data['regions'] = $this->mfleet_config->getRegion();
		$data['speeds'] = $this->mfleet_config->getSpeed();
		$data['all_mobile'] = $this->mfleet_config->getAllMobileAddress();
		$post = $this->input->post();
		if ($post) {
			// print_r($this->upload->data());
			print_r($post);
			// Upload file image
			$post_data['name'] = $post['name'];
			$post_data['base_id'] = $post['base_id'];
			$post_data['icon_id'] = $post['icon_id'];
			$post_data['gps_mobile_address'] = $post['mobile_address'];
			$post_data['user_id'] = $post['user_id'];
			$post_data['driver_id'] = $post['driver_id'];
			// $post_data['status_alert_profile'] = $post['status_alert_profile'];
			// for edit data
			if (isset($post['vehicle_id'])) {
				$this->mfleet_config->updateVehicle($post_data, $post['vehicle_id']);
				redirect('admin/fleet_config/vehicle/' . $post['vehicle_id']);
			} else {
				// for add $_POST data
				$id = $this->mfleet_config->insertVehicle($post_data);
				redirect('admin/fleet_config/vehicle/' . $id);
			}
			// for view or edit data
		} elseif ($vehicle_id) {
			$data['vehicle'] = $this->mfleet_config->getVehicle($vehicle_id);
			// check if id exists
			if (isset($data['vehicle']->vehicle_id)) {
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

	/**
	 * Fleet Table Show
	 */
	public function fleet() {
		$data['pageTitle'] = "Fleet State Modul";
		$data['vehicles'] = $this->mfleet_config->getAllVehicle();
		$this->load->template('fleet', $data);
	}

	/**
	 * User & Vehicle Assignment
	 */
	public function assign() {
		$data['pageTitle'] = "Assigmnet Vehicle & User";
		if ($_SESSION['gps_level'] == 'admin_vendor') {
			$data['users'] = $this->mfleet_config->getAllUserByAdmin($_SESSION['gps_user_id']);
		} else {
			$data['users'] = $this->mfleet_config->getAllUser();
		}
		$data['vehicles'] = $this->mfleet_config->getAllVehicle();
		$this->load->template('admin/fleet_config/assign', $data);
	}

	public function vehicle_assign() {
		$post = $this->input->post();
		foreach ($post['vehicle'] as $vehicle_id) {
			$data['user_id'] = $post['user_id'];
			$this->mfleet_config->updateVehicleUser($data, $vehicle_id);
		}
		// print_r($post_data);exit;
	}
	
	/**
	 * Set Status Vehicle
	 */
	public function status_vehicle() {
		$data['pageTitle'] = "Status Vehicle";
		if ($_SESSION['gps_level'] == 'admin_vendor') {
			$data['users'] = $this->mfleet_config->getAllUserByAdmin($_SESSION['gps_user_id']);
		} else {
			$data['users'] = $this->mfleet_config->getAllUser();
		}
		$data['vehicles'] = $this->mfleet_config->getAllVehicle();
		$this->load->template('admin/fleet_config/assign', $data);
	}
	
	public function set_status() {
		$post = $this->input->post();
		foreach ($post['vehicle'] as $vehicle_id) {
			$data['user_id'] = $post['user_id'];
			$this->mfleet_config->updateVehicleUser($data, $vehicle_id);
		}
		// print_r($post_data);exit;
	}
}