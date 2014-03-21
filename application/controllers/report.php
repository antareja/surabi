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
		$this->activity();
	}

	public function form($report) {
		$data['report'] = $report;
		$data['pageTitle'] = "Select Acivity";
		$data['vehicles'] = $this->mreport->getAllVehicles();
		$this->load->template("report/form", $data);
	}
	
	public function employee() {
		$data['pageTitle'] = 'Employee Report';
		$data['data_report'] = $this->mreport->getEmployeeReport();
		$this->load->template("report/employee", $data);
	}
	
	public function vehicle() {
		$data['pageTitle'] = 'Vehicle Report';
		$data['vehicles'] = $this->mreport->getAllVehiclesComplete();
		$this->load->template("report/vehicle",$data);
	}

	public function activity() {
		$data['pageTitle'] = 'Activity Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['activity'] = $this->mreport->getActivityReport($begin, $end, empty($post['vehicle']) ? '' : $post['vehicle']);
		}
		$html = $this->load->template("report/activity", $data);
		$html = $this->output->get_output();
		// Load library
		$this->load->library('dompdf_gen');
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("activity.pdf", array(
				'Attachment' => 0 
		));

	}
	/*
	public function activity_demo() {
		$html = $this->load->template('report/activity_demo');
		$html = $this->output->get_output();
		// Load library
		$this->load->library('dompdf_gen');
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("activity.pdf", array(
				'Attachment' => 0 
		));
	}
	public function alert() {
		$data['pageTitle'] = 'Alert Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			//print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['alert'] = $this->mreport->getAlertReport($begin, $end, $post['vehicle']);
		}
		$this->load->view("report/alert", $data);
	}
	
	public function speed() {
		$data['pageTitle'] = 'Speed Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			//print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['speed'] = $this->mreport->getSpeedReport($begin, $end, $post['vehicle']);
		}
		$html = $this->load->view("report/speed", $data);
	}
	*/
	public function stop() {
		$data['pageTitle'] = 'Stop Idling Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['stop'] = $this->mreport->getStopReportGroup($begin, $end, $post['vehicle']);
		}
		$html = $this->load->template("report/stop", $data);
		// $html = $this->output->get_output();
		// // Load library
		// $this->load->library('dompdf_gen');
		// // Convert to PDF
		// $this->dompdf->load_html($html);
		// $this->dompdf->render();
		// $this->dompdf->stream("activity.pdf",array('Attachment'=>0));
	}
	
	public function activity_demo() {
		$html = $this->load->view('report/activity_demo');
		$html = $this->output->get_output();
		// Load library
		$this->load->library('dompdf_gen');
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("activity.pdf", array(
				'Attachment' => 0 
		));
	}

	public function test() {
		$vehicle = 'haidar, rizki, arief';
		$array = array(
				$vehicle 
		);
		print_r($array);
	}

	public function alert() {
		$data['pageTitle'] = 'Alert Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			//print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['alert'] = $this->mreport->getAlertReport($begin, $end, $post['vehicle']);
		}
		$this->load->template("report/alert", $data);
	}

	public function speed() {
		$data['pageTitle'] = 'Speed Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			//print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['speed'] = $this->mreport->getSpeedReport($begin, $end, $post['vehicle']);
		}
		$html = $this->load->template("report/speed", $data);
	}
}
