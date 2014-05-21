<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Profile_user extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mprofile_user');
		$this->mprofile_user= new MProfile_user();
	}

	public function index() {
		$this->profile_user();
	}
	
	public function profile_user() {
		$data['pageTitle'] = "Replay Module";
		$data['data_user'] = $this->mprofile_user->getUserData();
		$data['data_history'] = $this->mprofile_user->getUserHistory();
		$this->load->template('profile_user',$data);
	}
	
}