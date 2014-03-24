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
		$data['pageTitle'] = "Select ".ucfirst($report);
		$data['vehicles'] = $this->mreport->getAllVehicles();
		$this->load->template("report/form", $data);
	}

	public function vehicle() {
		$data['pageTitle'] = 'Vehicle Report';
		$data['headers'] = array(
				'Alias',
				'H/W Type',
				'Last Update Time',
				'Source Type',
				'Unit Number',
				'Company Name'
		);
		$vehicle = $this->mreport->getAllVehiclesComplete();
		$x = 1;
		$vehicles = array();
		foreach ($vehicle as $row) {
			if ($x % 2 == 0)
				$class = "genap";
			else
				$class = "ganjil";
			$x ++;
			array_push($vehicles, '<tr class="'.$class.'">',
			add_td($row->alias), add_td($row->hw),
			add_td($row->last_update),add_td('G') ,add_td($row->unit), add_td($row->company_name),'</tr>');
		}
		$data['report'] = $vehicles;
		$this->load->template("report/report_style", $data);
	}

	public function employee() {
		$data['pageTitle'] = 'Employee Report';
		$data['headers'] = array(
				'Emp. Number',
				'Name',
				'Phone1',
				'Phone2',
				'Email',
				'User Name',
				'Access Level',
				'Last Login'
		);
		$employee = $this->mreport->getEmployeeReport();
		$x = 1;
		$employees = array();
		foreach ($employee as $row) {
			if ($x % 2 == 0)
				$class = "genap";
			else
				$class = "ganjil";
			$x ++;
			array_push($employees, '<tr class="'.$class.'">',
			add_td($row->user_id), add_td($row->fullname),
			add_td($row->phone),add_td($row->phone2) ,add_td($row->email), add_td($row->username),
			add_td($row->level),add_td($row->login),'</tr>');
		}
		$data['report'] = $employees;
		$this->load->template("report/report_style", $data);
	}

	public function activity() {
		$data['pageTitle'] = 'Activity Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['headers'] = array(
					'Vehicle',
					'Event Time',
					'Location',
					'Speed',
					'Bearing',
					'Latitude',
					'Longitude',
					'Region'
			);
			$activity = $this->mreport->getActivityReport($begin, $end, empty($post['vehicle']) ? '' : $post['vehicle']);
			$x = 1;
			$activities = array();
			foreach ($activity->result() as $row) {
				if ($x % 2 == 0)
					$class = "genap";
				else
					$class = "ganjil";
				$x ++;
				array_push($activities, '<tr class="'.$class.'">',
				add_td($row->name), add_td($row->time),
				add_td($row->location),add_td($row->velocity) ,add_td($row->bearing), add_td($row->latitude),
				add_td($row->longitude),add_td(''),'</tr>');
			}
			$data['report'] = $activities;
		}
		$this->load->template("report/report_style", $data);
	}

	public function alert() {
		$data['pageTitle'] = 'Alert Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['headers'] = array(
					'Vehicle',
					'Driver',
					'Alert Time',
					'Alert Type',
					'Location',
					'Alert Description'
			);
			$alert = $this->mreport->getAlertReport($begin, $end, $post['vehicle']);
			$x = 1;
			$alerts = array();
			foreach ($alert as $row) {
				if ($x % 2 == 0)
					$class = "genap";
				else
					$class = "ganjil";
				$x ++;
				array_push($alerts, '<tr class="'.$class.'">',
				add_td($row->name), add_td($row->driver_name),
				add_td($row->create_at),add_td($row->type) ,
				add_td($row->latitude.','.$row->longitude),add_td('alert description'),'</tr>');
			}
			$data['report'] = $alerts;
		}
		$this->load->template("report/report_style", $data);
	}

	public function speed() {
		$data['pageTitle'] = 'Speed Report';
		$post = $this->input->post();
		$data['headers'] = array(
				'Vehicle',
				'Time',
				'Location',
				'Speed',
				'Bearing' 
		);
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$speed = $this->mreport->getSpeedReport($begin, $end, $post['vehicle']);
			$x = 1;
			$speeds = array();
			foreach ($speed as $row) {
				if ($x % 2 == 0)
					$class = "genap";
				else
					$class = "ganjil";
				$x ++;
				array_push($speeds, '<tr class="'.$class.'">', 
				add_td($row->name), add_td($row->create_at), 
				add_td($row->location), add_td($row->velocity), add_td($row->bearing),'</tr>');
			}
		}
		$data['report'] = $speeds;
		$html = $this->load->template("report/report", $data);
	}

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

	public function test() {
		$vehicle = 'haidar, rizki, arief';
		$array = array(
				$vehicle 
		);
		print_r($array);
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
}
