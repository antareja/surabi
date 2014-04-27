<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/muser');
		$this->muser = new Muser();
	}

	public function index() {
		$this->login();
	}

	public function login($msg = NULL) {
		$data['msg'] = $msg;
		$data['pageTitle'] = "Login";
		$this->load->view('login', $data);
	}

	public function do_login() {
		$post = $this->input->post();
		if ($post) {
			try {
				$login = $this->muser->login($post['username'], $post['password']);
				if ($login !== FALSE) {
					// print_r($login);
					$user_login = $this->muser->user_login($login->user_id);
					define_sess($login->username, $login->user_id, $login->fullname, $login->level, $login->company_id, $login->company_name);
					// print_r($_SESSION);exit;
					previous_url();
				} else {
					// throw new Exception("Username Or Password is invalid");
					$msg = "Username Or Password is invalid";
					$this->login($msg);
				}
			} catch ( Exception $e ) {
				echo $e->getMessage();
			}
		}
	}

	public function logout() {
		$this->muser->user_logout($_SESSION['gps_user_id']);
		session_destroy();
		redirect('login');
	}
}