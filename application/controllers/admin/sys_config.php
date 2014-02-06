<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar & rizki
 *        
 */
class Sys_config extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/msys_config');
		$this->msys_config = new MSys_config();
	}

	public function index() {
		$this->company_data();
	}

	/**
	 *
	 * @param number $id_company
	 *        	for 1 company only
	 *        	
	 */
	public function company_data($id_company = 1) {
		$data['pageTitle'] = 'General Company Data';
		$post = $this->input->post();
		// if add or edit
		if ($post) {
			// print_r($post);
			$post_data['name'] = $post['name'];
			$post_data['address'] = $post['address'];
			$post_data['phone'] = $post['phone'];
			$post_data['phone2'] = $post['phone2'];
			$post_data['fax'] = $post['fax'];
			// for edit data
			if ($post['id_company']) {
				$this->msys_config->editCompany($post['id_company'], $post_data);
				// for add $_POST data
			} else {
				$this->msys_config->insertCompanyData($post_data);
			}
			redirect('admin/sys_config');
			// for edit or view data only
		} elseif ($id_company) {
			$data['users'] = $this->msys_config->getCompany($id_company);
			$this->load->template("admin/sys_config/general", $data);
			// for add new data only
		} else {
			$this->load->template("admin/sys_config/general", $data);
		}
	}

	/**
	 *
	 * @param number $icon_id        	
	 *
	 */
	public function icon($icon_id = NULL) {
		$data['pageTitle'] = 'Icon';
		$data['all_icon'] = $this->msys_config->getAllIcon();
		$post = $this->input->post();
		if ($post) {
			// print_r($this->upload->data());
			print_r($post);
			// Upload file image
			$post_data['name'] = $post['name'];
			$post_data['description'] = $post['description'];
			if ($_FILES['icon']) {
				print_r($_FILES['icon']);
				$post_data['image_name'] = $_FILES['icon']['name'];
				$ext = pathinfo($post_data['image_name'], PATHINFO_EXTENSION);
				$post_data['image_type'] = $ext;
				$post_data['image_size'] = $_FILES['icon']['size'];
			}
			// for edit data
			if (isset($post['icon_id'])) {
				$this->msys_config->editIcon($post_data, $post['icon_id']);
				upload_to('icon', 'icon_' . $post_data['icon'] . '.' . $ext);
				redirect('admin/sys_config/icon/' . $icon_id);
			} else {
				// for add $_POST data
				$id = $this->msys_config->insertIcon($post_data);
				upload_to('icon', 'icon_' . $id . '.' . $ext);
				redirect('admin/sys_config/icon/' . $id);
			}
			// for view or edit data
		} elseif ($icon_id) {
			$data['icon'] = $this->msys_config->getIcon($icon_id);
			$this->load->template("admin/sys_config/icon", $data);
			// for add data only
		} else {
			$this->load->template("admin/sys_config/icon", $data);
		}
	}

	/**
	 *
	 * @param string $hardware_id
	 *        	Hardware
	 */
	public function hardware($hardware_id = NULL) {
		$data['pageTitle'] = 'Hardware';
		$data['all_hardware'] = $this->msys_config->getAllHardwareType();
		$post = $this->input->post();
		if ($post) {
			// print_r($this->upload->data());
			print_r($post);
			// Upload file image
			$post_data['name'] = $post['name'];
			$post_data['description'] = $post['description'];
			$post_data['message_enabled'] = $post['message_enabled'];
			$post_data['garmin_support'] = $post['garmin_support'];
			$post_data['max_message_length'] = $post['max_message_length'];
			// for edit data
			if (isset($post['hardware_id'])) {
				$this->msys_config->updateHardwareType($post_data, $post['hardware_id']);
				redirect('admin/sys_config/hardware/' . $hardware_id);
			} else {
				// for add $_POST data
				$id = $this->msys_config->insertHardwareType($post_data);
				redirect('admin/sys_config/hardware/' . $id);
			}
			// for view or edit data
		} elseif ($hardware_id) {
			$data['hardware'] = $this->msys_config->getHardwareType($hardware_id);
			if(isset($data['hardware']->hardware_id)){
				$this->load->template("admin/sys_config/hardware_type", $data);
			} else {
				 unset($data['hardware']);
				$this->load->template("admin/sys_config/hardware_type", $data);
			}
			// for add data only
		} else {
			$this->load->template("admin/sys_config/hardware_type", $data);
		}
	}
}