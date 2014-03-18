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
		$this->load->model('admin/muser');
		$this->msys_config = new MSys_config();
		$this->muser = new MUser();
	}

	public function index() {
		$this->vendor();
	}

	/**
	 *
	 * @param number $id_company
	 *        	for 1 company only
	 *        	
	 */
	public function vendor($id_company = NULL) {
		$data['pageTitle'] = 'Vendor Data';
		$data['all_company'] = $this->msys_config->getAllCompany();
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
				redirect('admin/sys_config/vendor/'.$post['id_company']);
				// for add $_POST data
			} else {
				$id = $this->msys_config->insertCompanyData($post_data);
				redirect('admin/sys_config/vendor/'.$id);
			}
			// for edit or view data only
		} elseif ($id_company) {
			$data['vendor'] = $this->msys_config->getCompany($id_company);
			$this->load->template("admin/sys_config/vendor", $data);
			// for add new data only
		} else {
			$this->load->template("admin/sys_config/vendor", $data);
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
	 * @param string $user_id
	 * for 
	 */
	public function user($level,$user_id = NULL) {
		$data['pageTitle'] = 'user';
		$data['action'] = site_url().'admin/sys_config/user/'.$level;
		$data['level'] = $level;
		$data['all_user'] = $level == 'operator' ? $this->muser->getAllUser() : $this->muser->getAllAdminVendor(); 
		//$data['admin'] = $this->muser->getAllAdmin();
		$data['companies'] = $this->muser->getAllCompany();
		// 		$data['vehicles'] = $this->muser->getAllVehicle();
		$post = $this->input->post();
		if ($post) {
			$post_data['fullname'] = $post['fullname'];
			$post_data['username'] = $post['username'];
			// 			$post_data['vehicle_id'] = $post['vehicle_id'];
			$post_data['password'] = md5($post['password']);
			$post_data['address'] = $post['address'];
			$post_data['company_id'] = $post['company_id'];
			$post_data['admin_id'] = $_SESSION['user_id'];
			$post_data['level'] = $level =='operator'?'operator':'admin_vendor';
			$post_data['phone'] = $post['phone'];
			$post_data['phone2'] = $post['phone2'];
			$post_data['email'] = $post['email'];
			if ($post['user_id']) {
				!empty($post['password']) ? $post_data['password'] = md5($post['password']) : '';
				$this->muser->updateUser($post_data,$post['user_id']);
				redirect('admin/sys_config/user/'.$level.'/' . $post['user_id']);
			} else {
				$id = $this->muser->insertUser($post_data);
				redirect('admin/sys_config/user/'.$level.'/' . $id);
			}
		} elseif ($user_id) {
			// 			die($user_id);
			$data['user'] = $this->muser->getUser($user_id);
			$this->load->template("admin/sys_config/user", $data);
		} else {
			$this->load->template("admin/sys_config/user", $data);
		}
	}
	
	public function get_admin(){
// 		echo '<option>test</option>';
		$post = $this->input->post();
		$company_id = $post['company_id'];
		$admins = $this->muser->getAllAdmin($company_id);
		foreach($admins as $admin) {
			echo '<option value"'.$admin->user_id.'">'.$admin->fullname.'</option>';
		}
	}
	
	public function driver($driver_id = NULL) {
		$data['pageTitle'] = 'driver';
		
		$data['all_driver'] = $this->msys_config->getAllDriver();
		$data['vehicles'] = $this->msys_config->getAllVehicle();
		$post = $this->input->post();
		//print_r($post);exit;
		if ($post) {
			$post_data['name'] = $post['name'];
			$post_data['vehicle_id'] = $post['vehicle_id'];
			$post_data['description'] = $post['description'];
			$post_data['address'] = $post['address'];
			$post_data['phone'] = $post['phone'];
			$post_data['phone2'] = $post['phone2'];
			$post_data['email'] = $post['email'];
			if ($post['driver_id']) {
				$this->msys_config->updateDriver($post['driver_id'], $post_data);
				redirect('admin/sys_config/driver/' . $post['driver_id']);
			} else {
				$id = $this->msys_config->insertDriver($post_data);
				redirect('admin/sys_config/driver/' . $id);
			}
		} elseif ($driver_id) {
			$data['driver'] = $this->msys_config->getDriver($driver_id);
			$this->load->template("admin/sys_config/driver", $data);
		} else {
			$this->load->template("admin/sys_config/driver", $data);
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