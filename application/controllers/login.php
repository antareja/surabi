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
				if ($this->muser->login($post['username'], $post['password']) === FALSE) {
					//throw new Exception("Username Or Password is invalid");
					$msg = "Username Or Password is invalid";
					$this->login($msg);
				} else {
					$_SESSION['username'] = $post['username'];
				}
			} catch ( Exception $e ) {
				echo $e->getMessage();
			}
		}
	}
	
	public function logout(){
		 session_destroy();
		 redirect('login');
	}
}