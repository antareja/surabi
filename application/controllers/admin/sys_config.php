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
		// Upload file image
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$this->load->library('upload', $config);
		if ($post) {
			print_r($post);
			$post_data['name'] = $post['name'];
			$post_data['description'] = $post['description'];
			$post_data['icon'] = $post['icon'];
			if (! $this->upload->do_upload()) {
				$error = array(
						'error' => $this->upload->display_errors() 
				);
				$this->load->view('admin/sys_config/icon', $error);
			} else {
				$data = array(
						'upload_data' => $this->upload->data() 
				);
				$this->load->view('admin/sys_config/icon', $data);
			}
			// for edit data
			if ($post['icon_id']) {
				$this->msys_config->editIcon($post_data, $post['icon_id']);
				// for add $_POST data
			} else {
				$this->msys_config->insertIcon($post_data);
			}
			redirect('admin/sys_config/icon');
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
	 * @param string $users
	 *        	Hardware
	 */
	public function hardware_type($users = NULL) {
		$data['pageTitle'] = 'Hardware Type';
		$post = $this->input->post();
		if ($post) {
			print_r($post);
			$this->msys_config->insertCompanyData($post);
		} elseif ($users) {
			$data['users'] = $this->msys_config->getUser();
			$this->load->template("admin/sys_config/hardware_type", $data);
		} else {
			$this->load->template("admin/sys_config/hardware_type", $data);
		}
	}
}