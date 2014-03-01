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
		$data['vehicles'] = $this->mreport->getAllVehicles();
		$this->load->template("report/activity_report", $data);
	}

	public function activity($region_id = NULL) {
		$data['pageTitle'] = 'Activity Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			//print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['activity'] = $this->mreport->getActivityReport($begin, $end, empty($post['vehicle']) ? '':$post['vehicle']  );
			
		}
		$html = $this->load->view("report/activity", $data);
		$html = $this->output->get_output();
		
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("activity.pdf",array('Attachment'=>0));
	}
	
	public function activity_demo(){
		$html = $this->load->view('report/activity_demo');
		$html = $this->output->get_output();
		
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("activity.pdf",array('Attachment'=>0));
		
	}
	
	public function stop_report_form(){
		$data['pageTitle'] = "Stop Or Idling Report";
		$data['vehicle'] = $this->mreport->getAllVehicles();
		$this->load->template('stop_report_form',$data);
	}
	
	public function stop_report($region_id = NULL) {
		$data['pageTitle'] = 'Stop Idling Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			//print_r($post);exit;
			$begin = $post['begin'];
			$end = $post['end'];
			$vehicle = implode(", ", $post['vehicle']);
			$data['activity'] = $this->mreport->getActivityReport($begin, $end, $post['vehicle']);
				
		}
		$html = $this->load->view("report/activity", $data);
		$html = $this->output->get_output();
	
		// Load library
		$this->load->library('dompdf_gen');
	
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("activity.pdf",array('Attachment'=>0));
	}
	
	public function test(){
		$vehicle = 'haidar, rizki, arief';
		$array = array($vehicle);
		print_r($array);
	}

	public function alert($region_id = NULL) {
		$data['pageTitle'] = 'Alert Report';
		$data['data_report'] = $this->mreport->getAlertReport();
		$this->load->view("report/alert", $data);
	}

	public function speed($region_id = NULL) {
		$data['pageTitle'] = 'Speed Report';
		$data['data_report'] = $this->mreport->getSpeedReport();
		$html = $this->load->view("report/speed", $data,$data);
		$html = $this->output->get_output();
		$this->load->helper(array('dompdf', 'file'));
		$pdfData = pdf_create($html, 'test');
		write_file('Progress Repost', $pdfData);
	}
}