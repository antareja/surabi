<script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="<?php echo base_url() ?>assets/js/location.js"></script>
<div id="isi">
	<style>
<!--
.ganjil {
	background-color: #999999
}
-->
</style>
	<button type="button" onclick="history.back();">Back</button>
	<br>
	<br> <input type="button" onclick="f1.submit()" value="Print">
	<div id="header" align="center">
		<h1>Stop/Idling Report</h1>
	</div>
	Sorted By : Vehicle
	<hr>
	<table width="100%">
		<tr>
			<td>Date</td>
			<td>Start Time</td>
			<td>End Time</td>
			<!-- 			<td>Latitude</td> -->
			<!-- 			<td>Longitude</td> -->
			<td>location</td>
			<td>Duration</td>
		</tr>
<?php
	$x = 1;
	$vehicle_name = '';
	$daily_total = array();
	$total = array();
	foreach ($stop->result() as $row) {
		$x ++;
		if ($x % 2 == 0)
			$class = "genap";
		else
			$class = "ganjil";
		if ($vehicle_name != $row->name) {
			$vehicle_name = $row->name;
			// unset($daily_total);
			$daily_total = array(
					$vehicle_name => array(
							$row->duration 
					) 
			);
			?>
		<tr style="background-color: #666666">
			<td colspan="5"><?php echo $vehicle_name?></td>
		</tr>
		<?php
		} else {
			array_push($daily_total[$row->name], $row->duration);
		}
			$total[$row->name] = sum_the_time($daily_total[$row->name]);
		//echo 'total'.$row->name .$total[$row->name];
		?>		
		<tr class="<?php echo $class?>">
			<td><?php echo $row->date ?></td>
			<td><?php echo $row->start_time ?></td>
			<td><?php echo $row->end_time ?></td>
			<td><?php echo $row->location ?></td>
			<td><?php echo $row->duration ?></td>
		</tr>	
	<?php
	}
	?>
</table>
</div>