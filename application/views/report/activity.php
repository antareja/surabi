<div id="isi">
<style>
.ganjil {
	background-color: #999999
}
</style>
	<img onclick="f1.submit()" src="<?php base_url()?>/assets/img/pdf.png" style="cursor:pointer">
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
