<?php
/**
 * @author haidar
 *
 */
class Mfleet extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function getFleet() {
		$sql = "SELECT * FROM {PRE}packet p 
				INNER JOIN {PRE}vehicles v on p.";		
	}
	
	function getVehicle(){
		$query = $this->db->get('vehicles');
		return $query->result();
	}
}