<?php
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
	<img onclick="f1.submit()" src="<?php base_url()?>/assets/img/pdf.png" style="cursor:pointer">
	<div id="header" align="center">
		<h1>Alert Report</h1>
	</div>
	Sorted By : Vehicle
	<hr>
	<table width="100%">
		<tr>
			<td>Vehicle</td>
			<td>Driver</td>
			<td>Alert Time</td>
			<td>Alert Type</td>
			<td>Location</td>
			<td>Alert Description</td>
		</tr>
		<tr style="background-color: #666666">
			<td colspan="8">Vehicle : Dump Truck</td>
		</tr>
<?php
	$x = 1;
	foreach ($alert as $data) {
		if ($x % 2 == 0)
			$class = "genap";
		else
			$class = "ganjil";
		?>
<tr class="<?php echo $class?>">
			<td><?php echo $data->name?></td>
			<td><?php echo $data->driver_name?></td>
			<td><?php echo $data->create_at?></td>
			<td><?php echo $data->type?></td>
			<td><?php echo $data->location?></td>
			<td><?php echo 'alert description'?></td>
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