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
	 * for client vendor or contractor
	 * @param number $id_company
	 *     
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
			$post_data['email'] = $post['email'];
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
	 * Icon for vehicle
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
				upload_to('icon', 'icon_' . $post['icon_id'] . '.' . $ext);
				//print_r($post);exit;
				redirect('admin/sys_config/icon/' . $post['icon_id']);
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
	 * for User Managment operator, admin_vendor , admin
	 */
	public function user($level,$user_id = NULL) {
		$data['pageTitle'] = 'User Management';
		$data['level'] = $level;
		$data['action'] = site_url().'admin/sys_config/user/'.$level.'/'.$user_id;
// 		echo $_SESSION['gps_level'];exit;
		if($_SESSION['gps_level'] == 'admin_vendor') {
			$data['all_user'] = $this->muser->getAllOperatorByAdmin();
// 			print_r($data['all_user']);
		} elseif ($_SESSION['gps_level'] == 'admin' && $level == 'operator') {
			$data['all_user'] = $this->muser->getAllUser(); 
		} elseif ($_SESSION['gps_level'] == 'admin' && $level == 'admin') {
			$data['all_user'] = $this->muser->getAllAdminVendor(); 
		}
		
		//$data['admin'] = $this->muser->getAllAdmin();
		$data['companies'] = $this->muser->getAllCompany();
		
		//$data['vehicles'] = $this->muser->getAllVehicle();
		$post = $this->input->post();
// 		print_r($post);exit;
		if ($post) {
			$post_data['fullname'] = $post['fullname'];
			$post_data['username'] = $post['username'];
			// $post_data['vehicle_id'] = $post['vehicle_id'];
			$post_data['password'] = md5($post['password']);
			$post_data['address'] = $post['address'];
			if ($_SESSION['gps_level'] == 'admin_vendor') {
				$post_data['company_id'] = $_SESSION['gps_company_id'];
				$post_data['admin_id'] = $_SESSION['gps_user_id'];
			} elseif ($_SESSION['gps_level'] == 'admin') {
				$post_data['company_id'] = $post['company_id'];
				// Create Dropdown Chain and get Admin ID form company iD
				// $post_data['admin_id'] = $_SESSION['gps_user_id'];
			}
			// Bugs found heres $level
			$post_data['level'] = $level == 'operator' ? 'operator' : 'admin_vendor';
			$post_data['phone'] = $post['phone'];
			$post_data['phone2'] = $post['phone2'];
			$post_data['email'] = $post['email'];
			// for update user
			if (!empty($user_id)) {
				if (! empty($post['password'])) {
					$post_data['password'] = md5($post['password']);
				} else {
					unset($post_data['password']);
					unset($post['password']);
				}
				print_r($post);
				$sql = $this->muser->updateUser($post_data, $post['user_id']);
				echo 'masuk Update';
				// echo $sql;exit;
				redirect('admin/sys_config/user/'.$level.'/' . $post['user_id']);
				// for insert only
			} elseif(empty($post['user_id'])) {
// 				die('masuk Insert');
				$id = $this->muser->insertUser($post_data);
				$this->output->enable_profiler(TRUE);
				redirect('admin/sys_config/user/'.$level.'/' . $id);
			}
		} elseif ($user_id) {
			//die($user_id);
			$data['user'] = $this->muser->getUser($user_id);
			$data['vendor'] = $this->muser->getCompanyByUser($user_id);
			$this->load->template("admin/sys_config/user", $data);
		} else {
			$this->load->template("admin/sys_config/user", $data);
		}
	}
	
	/**
	 * Delete user confirm by update deleted field
	 * @param unknown $user_id
	 */
	public function delete_user() {
		$post = $this->input->post();
		$user_id = $post['user_id'];
		if($this->muser->deleteUser($user_id)) {
			echo 'data deleted';
		}
	}
	
	public function get_admin(){
// 		echo '<option>test</option>';
		$post = $this->input->post();
		$admins = $this->muser->getAllAdminCompany($post['company_id']);
		foreach($admins as $admin) {
			echo '<option value"'.$admin->user_id.'">'.$admin->fullname.'</option>';
		}
	}
	
	public function driver($driver_id = NULL) {
		$data['pageTitle'] = 'driver';
		$data['all_driver'] = $this->msys_config->getAllDriver();
		$data['companies'] = $this->muser->getAllCompany();
		//TODO: get vehicle where choosen dropdown company_id
		$data['vehicles'] = $this->msys_config->getAllVehicle();
		$post = $this->input->post();
		//print_r($post);exit;
		if ($post) {
			$post_data['name'] = $post['name'];
			$post_data['company_id'] = $post['company_id'];
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
	 * Input Email Data for notification Alert Only
	 * @param string $email_id
	 */
	public function email_data($email_id = NULL){
		$data['pageTitle'] = 'Email Notification';
		$data['all_email'] = $this->msys_config->getAllEmailData();
		$post = $this->input->post();
		if ($post) {
			$post_data['fullname'] = $post['fullname'];
			$post_data['email'] = $post['email'];
			if($post_data['email_id']) {
				$this->msys_config->updateEmailData($email_id, $data);
				redirect('admin/sys_config/email_data/'. $post_data['email_id']);
			} else {
				$id = $this->msys_config->insertEmailData($post_data);
				redirect('admin/sys_config/email_data/'. $id);
			}
		} elseif ($email_id) {
			$data['email_data'] = $this->msys_config->getEmailData($email_id);
			$this->load->template("admin/sys_config/email_data",$data);
		} else {
			$this->load->template("admin/sys_config/email_data",$data);
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