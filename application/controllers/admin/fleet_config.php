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
	 * @param string $users        	
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
			$this->mfleet_config->insertBase($post);
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
}