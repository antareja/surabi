<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar & rizki
 *        
 */
class Conf extends CI_Controller {

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
	 * Configuration :
	 * Center Map LatLng,
	 * Zoom,
	 * Size
	 */
	public function open_layer_conf() {
		$data['pageTitle'] = 'OpenLayer Map Configuration';
		$this->load->template("open_layer_conf", $data);
	}
}