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

	public function login() {
		$data['pageTitle'] = "Login";
		$post = $this->input->post();
		if ($post) {
			if ($this->muser->login($post['username'], $post['password'])) {
				echo 'masuk';
			} else {
				echo 'mistake';
			}
		} else {
			$this->load->view('login', $data);
		}
	}
}