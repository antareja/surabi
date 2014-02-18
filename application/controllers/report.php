<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author haidar
 *        
 */
class Report extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mreport');
		$this->mreport = new MReport();
	}

	public function index() {
		$this->home();
	}

	public function vehicle($region_id = NULL) {
		$data['pageTitle'] = 'Vehicles Report';
		$data['data_report'] = $this->mreport->getVehicleReport();
		$this->load->view("report/vehicle", $data);
	}

	public function employee($region_id = NULL) {
		$data['pageTitle'] = 'Employee Report';
		$data['data_report'] = $this->mreport->getEmployeeReport();
		$this->load->view("report/employee", $data);
	}

	public function activity_form() {
		$data['pageTitle'] = "Select Acivity";
		$this->load->template("report/activity_report", $data);
	}

	public function activity($region_id = NULL) {
		$data['pageTitle'] = 'Activity Report';
		$post = $this->input->post();
		if ($post) {
			$begin = $post['begin'];
			$end = $post['end'];
			$data['activity'] = $this->mreport->getActivityReport($begin, $end);
		}
		$this->load->view("report/activity", $data);
	}

	public function alert($region_id = NULL) {
		$data['pageTitle'] = 'Alert Report';
		$data['data_report'] = $this->mreport->getAlertReport();
		$this->load->view("report/alert", $data);
	}

	public function speed($region_id = NULL) {
		$data['pageTitle'] = 'Speed Report';
		$data['data_report'] = $this->mreport->getSpeedReport();
		$this->load->view("report/speed", $data);
	}
}