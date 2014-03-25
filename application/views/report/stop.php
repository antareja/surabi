<style>
.ganjil {
	background-color: #999999
}
</style>
<div id="header" align="center">
	<h1><?php echo $pageTitle?></h1>
	<form action="<?php echo site_url()?>report/<?php echo $this->uri->segment(2)?>/pdf" id="pdf_report" target="_blank" method="POST" >
		<input type="hidden" name="begin" value="<?php echo isset($begin) ? $begin : ''?>">
		<input type="hidden" name="end" value="<?php echo isset($end) ? $end : ''?>">
		<input type="hidden" name="vehicle" value="<?php echo isset($vehicle) ? $vehicle : ''?>">
		<input type="hidden" name="pdf" value="1">
	<h4><?php echo isset($pdf) ? $pdf : '';?></h4>
</div>
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
	// echo 'total'.$row->name .$total[$row->name];
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