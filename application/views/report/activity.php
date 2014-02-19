<script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="<?php echo base_url() ?>assets/js/location.js"></script>
<?php
//print_r($_POST);
//print_r($activity);

//exit();
if ($this->input->post("html") != "") {
	$this->load->helper("dompdf_helper");
	if (! isset($other))
		$other = "";
	pdf_create($this->input->post("html"));
} else {
	?>
<div id="isi">
	<style>
<!--
.ganjil {
	background-color: #999999
}
-->
</style>
	<br> <input type="button" onclick="f1.submit()" value="Print">
	<div id="header" align="center">
		<h1>Activity Report</h1>
</div>
	Sorted By : Vehicle
	<hr>
	<table width="100%">
		<tr>
			<td>Vehicle</td>
			<td>Event Time</td>
			<td>Location</td>
			<td>Speed</td>
			<td>Bearing</td>
			<td>Latitude</td>
			<td>Longitude</td>
			<td>Region</td>
		</tr>
		<tr style="background-color: #666666">
			<td colspan="8">Vehicle : Dump Truck</td>
		</tr>
<?php
	$x = 1;
	foreach ($activity->result() as $row) {
		if ($x % 2 == 0)
			$class = "genap";
		else
			$class = "ganjil";
		?>
<tr class="<?php echo $class?>">
			<td><?php echo $row->name ?></td>
			<td><?php echo $row->time ?></td>
			<td><?php echo $row->location ?></td>
			<td><?php echo $row->velocity ?></td>
			<td><?php echo $row->bearing ?></td>
			<td><?php echo $row->latitude ?></td>
			<td><?php echo $row->longitude ?></td>
			<td><?php //echo $row->region ?></td>
		</tr>	
<?php
		$x ++;
	}
	?>
</table>
</div>
<form id="f1" name="f1" action="" method="post">
	<textarea id="html" name="html" style="display: none"></textarea>
</form>
<script>html.innerHTML=isi.innerHTML</script>
<?php 
}
?>