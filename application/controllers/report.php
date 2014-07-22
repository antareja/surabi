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
		ini_set('memory_limit', '512M');
		$this->load->model('mreport');
		$this->mreport = new MReport();
	}

	public function index() {
		$this->vehicle();
	}

	public function form($report) {
		$data['report'] = $report;
		$data['pageTitle'] = "Select " . ucfirst($report);
		$data['vehicles'] = $this->mreport->getAllVehicles();
		$this->load->template("report/form", $data);
	}
	
	public function form_limit($report) {
		$data['pageTitle'] = "Select " . ucfirst($report);
		$data['vehicles'] = $this->mreport->getAllVehicles();
		$this->load->template("report/form_limit", $data);
	}

	public function vehicle($pdf = NULL) {
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
			array_push($vehicles, '<tr class="' . $class . '">', add_td($row->alias), add_td($row->hw), add_td($row->last_update), add_td('G'), add_td($row->unit), add_td($row->company_name), '</tr>');
		}
		$data['report'] = $vehicles;
		if ($pdf == NULL) {
			$this->load->template("report/report_style", $data);
		} else {
			$this->pdf($data);
		}
	}

	public function employee($pdf = NULL) {
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
			array_push($employees, '<tr class="' . $class . '">', add_td($row->user_id), add_td($row->fullname), add_td($row->phone), add_td($row->phone2), add_td($row->email), add_td($row->username), add_td($row->level), add_td($row->login), '</tr>');
		}
		$data['report'] = $employees;
		if ($pdf == NULL) {
			$this->load->template("report/report_style", $data);
		} else {
			$this->pdf($data);
		}
	}

	public function activity() {
		$data['pageTitle'] = 'Activity Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['begin'] = $begin;
			$data['end'] = $end;
			$data['vehicle'] = is_array($post['vehicle']) ?  implode(',', $post['vehicle']) : $post['vehicle'];
			$vehicle = is_array($post['vehicle']) ? $post['vehicle'] : explode(',', $post['vehicle']);
			$data['headers'] = array(
					'Vehicle',
					'Event Time',
					'Location',
					'Speed',
					'Bearing',
					'Latitude',
					'Longitude' 
			);
			$activity = $this->mreport->getActivityReport($begin, $end, $vehicle);
			$x = 1;
			$activities = array();
			foreach ($activity->result() as $row) {
				if ($x % 2 == 0)
					$class = "genap";
				else
					$class = "ganjil";
				$x ++;
				array_push($activities, '<tr class="' . $class . '">', add_td($row->name), add_td($row->time), add_td($row->location), add_td($row->velocity), add_td($row->bearing), add_td($row->latitude), add_td($row->longitude), '</tr>');
			}
			$data['report'] = $activities;
		}
		if (empty($post['pdf'])) {
			$this->load->template("report/report_style", $data);
		} else {
			$this->pdf($data);
		}
	}

	public function alert() {
		$data['pageTitle'] = 'Alert Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['begin'] = $begin;
			$data['end'] = $end;
			$data['vehicle'] = is_array($post['vehicle']) ?  implode(',', $post['vehicle']) : $post['vehicle'];
			$vehicle = is_array($post['vehicle']) ? $post['vehicle'] : explode(',', $post['vehicle']);
			$data['headers'] = array(
					'Vehicle',
					'Driver',
					'Date',
					'type',
					'Location',
					'LongLat',
					'Description' 
			);
			$alert = $this->mreport->getAlertReport($begin, $end, $vehicle);
			$x = 1;
			$alerts = array();
			foreach ($alert as $row) {
				if ($x % 2 == 0)
					$class = "genap";
				else
					$class = "ganjil";
				$x ++;
				array_push($alerts, '<tr class="' . $class . '">', add_td($row->name), add_td($row->driver_name), add_td($row->create_at), add_td($row->type), add_td($row->location), add_td($row->longitude.', '.$row->latitude), add_td($row->desc), '</tr>');
			}
			$data['report'] = $alerts;
		}
		if (empty($post['pdf'])) {
			$this->load->template("report/report_style", $data);
		} else {
			$this->pdf($data);
		}
	}

	public function speed() {
		$data['pageTitle'] = 'Speed Report';
		$post = $this->input->post();
		$data['headers'] = array(
				'Vehicle',
				'Driver',
				'Time',
				'Location',
				'LongLat',
				'Speed',
				'Bearing' 
		);
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['begin'] = $begin;
			$data['end'] = $end;
			$data['vehicle'] = is_array($post['vehicle']) ?  implode(',', $post['vehicle']) : $post['vehicle'];
			$vehicle = is_array($post['vehicle']) ? $post['vehicle'] : explode(',', $post['vehicle']);
			$speed = $this->mreport->getSpeedReport($begin, $end, $vehicle);
			$x = 1;
			$speeds = array();
			foreach ($speed as $row) {
				if ($x % 2 == 0)
					$class = "genap";
				else
					$class = "ganjil";
				$x ++;
				array_push($speeds, '<tr class="' . $class . '">', add_td($row->name),add_td($row->driver_name), add_td($row->create_at), add_td($row->location) ,add_td($row->latitude . ',' . $row->longitude), add_td($row->velocity), add_td($row->bearing), '</tr>');
			}
		}
		$data['report'] = $speeds;
		if (empty($post['pdf'])) {
			$this->load->template("report/report_style", $data);
		} else {
			$this->pdf($data);
		}
	}

	public function speed_limit($mobile_address = NULL, $begin = NULL, $end = NULL, $speed = NULL) {
		$data['pageTitle'] = 'Speed Report';
		$data['headers'] = array(
				'Vehicle',
				'Driver',
				'Time',
				'Location',
				'LongLat',
				'Speed',
				'Bearing'
		);
		if ($mobile_address) {
			// print_r($post);exit;
			$beginf = unixf($begin);
			$endf = unixf($end);
			$speed= !empty($speed) ? $speed : 20;
			if($speed == 20) {
				$speed_min = 20;
				$speed_max = 40;
			} elseif($speed == 40) {
				$speed_min = 40;
				$speed_max = 60;
			} elseif($speed == 60) {
				$speed_min = 60;
				$speed_max = 80;
			} elseif($speed == 80) {
				$speed_min = 80;
				$speed_max = 200;
			} elseif($speed == 0) {
				$speed_min = 0;
				$speed_max = 20;
			} else {
				$speed_min = '20';
				$speed_max = '40';
			}
			$this->firephp->log('speed_min ='. $speed_min .' speed max = '. $speed_max);
			$data['mobile_address'] =  $mobile_address;
			$data['speed'] = $speed;
			$data['begin'] = $begin;
			$data['end'] = $end;
			$data['vehicle'] = $mobile_address;
// 			$vehicle = is_array($post['vehicle']) ? $post['vehicle'] : explode(',', $post['vehicle']);
			$vehicle = $mobile_address;
			$speed = $this->mreport->getSpeedReport($beginf, $endf, $vehicle, $speed_min, $speed_max);
			$x = 1;
			$speeds = array();
			foreach ($speed as $row) {
				if ($x % 2 == 0)
					$class = "genap";
				else
					$class = "ganjil";
				$x ++;
				array_push($speeds, '<tr class="' . $class . '">', add_td($row->name),add_td($row->driver_name), add_td($row->create_at), add_td($row->location) ,add_td($row->latitude . ',' . $row->longitude), add_td($row->velocity), add_td($row->bearing), '</tr>');
			}
		}
		$data['report'] = $speeds;
		if (empty($post['pdf'])) {
			$this->load->template("report/speed", $data);
		} else {
			$this->pdf($data);
		}
	}
	
	public function stop() {
		$data['pageTitle'] = 'Stop Idling Report';
		$post = $this->input->post();
		if (isset($post['begin'])) {
			// print_r($post);exit;
			$begin = date("Y-m-d", strtotime($post['begin']));
			$end = date("Y-m-d", strtotime($post['end']));
			$data['begin'] = $begin;
			$data['end'] = $end;
			$data['vehicle'] = is_array($post['vehicle']) ?  implode(',', $post['vehicle']) : $post['vehicle'];
			$vehicle = is_array($post['vehicle']) ? $post['vehicle'] : explode(',', $post['vehicle']);
			$data['stop'] = $this->mreport->getStopReportGroup($begin, $end, $vehicle);
		}
		if (empty($post['pdf'])) {
			$data['pdf'] = 'View PDF : <img onclick="pdf_report.submit()" src="'.base_url().'/assets/img/pdf.png"
		style="cursor: pointer">';
			$this->load->template("report/stop", $data);
		} else {
			$this->pdf($data,'stop');
		}
	}

	public function pdf($data,$report= NULL) {
		// $pdfFilePath = FCPATH . "assets/downloads/reports/$report.pdf";
		ini_set('memory_limit', '512M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
		$report_type = $report == NULL ? 'report' : $report;
		$html = $this->load->view("report/".$report_type, $data, true); // render the view into HTML
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->SetFooter($_SESSION['gps_full_name'] . '|{PAGENO}|' . date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
		$pdf->WriteHTML($html); // write the HTML into the PDF
		$pdf->Output(); // save to file because we can
		exit();
	}

// 	public function activity_demo() {
// 		$html = $this->load->view('report/activity_demo');
// 	}
}
