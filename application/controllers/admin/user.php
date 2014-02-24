<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('muser');
		$this->muser = new Muser();
	}

	public function index() {
		$this->user();
	}

	public function user($user_id = NULL) {
		$data['pageTitle'] = 'user';
		$data['all_user'] = $this->muser->getAlluser();
// 		$data['vehicles'] = $this->muser->getAllVehicle();
		$post = $this->input->post();
		if ($post) {
			$post_data['name'] = $post['name'];
// 			$post_data['vehicle_id'] = $post['vehicle_id'];
			$post_data['description'] = $post['description'];
			$post_data['address'] = $post['address'];
			$post_data['phone'] = $post['phone'];
			$post_data['phone2'] = $post['phone2'];
			$post_data['email'] = $post['email'];
			if ($post['user_id']) {
				$this->muser->updateUser($user_id, $post_data);
				redirect('user/' . $user_id);
			} else {
				$id = $this->muser->insertUser($post_data);
				redirect('user/' . $id);
			}
		} elseif ($user_id) {
			$data['user'] = $this->muser->getUser($user_id);
			$this->load->template("user", $data);
		} else {
			$this->load->template("user", $data);
		}
	}
}
