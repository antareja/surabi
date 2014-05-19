<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * @author haidar
 *
 */
class Map extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mmap');
		$this->mmap = new MMap();
	}

	public function index() {
		//$this->region();
	}

}