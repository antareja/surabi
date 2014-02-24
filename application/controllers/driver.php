<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Driver extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mdriver');
		$this->mdriver = new MDriver();
	}

	public function index() {
		$this->driver();
	}

	public function driver($driver_id = NULL) {
		$data['pageTitle'] = 'driver';
		$data['all_driver'] = $this->mdriver->getAllDriver();
		$data['vehicles'] = $this->mdriver->getAllVehicle();
		$post = $this->input->post();
		if ($post) {
			$post_data['name'] = $post['name'];
			$post_data['vehicle_id'] = $post['vehicle_id'];
			$post_data['description'] = $post['description'];
			$post_data['address'] = $post['address'];
			$post_data['phone'] = $post['phone'];
			$post_data['phone2'] = $post['phone2'];
			$post_data['email'] = $post['email'];
			if ($post['driver_id']) {
				$this->mdriver->updateDriver($driver_id, $post_data);
				redirect('driver/' . $driver_id);
			} else {
				$id = $this->mdriver->insertDriver($post_data);
				redirect('driver/' . $id);
			}
		} elseif ($driver_id) {
			$data['driver'] = $this->mdriver->getDriver($driver_id);
			$this->load->template("driver", $data);
		} else {
			$this->load->template("driver", $data);
		}
	}
}
