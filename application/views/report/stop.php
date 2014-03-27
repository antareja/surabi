<script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.min.js"></script>
<script>
function toSeconds(time) {
	var parts = time.split(':');
	return (+parts[0]) * 60 * 60 + (+parts[1]) * 60 + (+parts[2]);
}

function toHHMMSS(sec) {
	var sec_num = parseInt(sec, 10); // don't forget the second parm
	var hours = Math.floor(sec_num / 3600);
	var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
	var seconds = sec_num - (hours * 3600) - (minutes * 60);

	if (hours < 10) {
		hours = "0" + hours;
	}
	if (minutes < 10) {
		minutes = "0" + minutes;
	}
	if (seconds < 10) {
		seconds = "0" + seconds;
	}
	var time = hours + ':' + minutes + ':' + seconds;
	return time;
}

function calculateSum(id) {
	var sum = 0;
	$(".duration" + id).each(function() {

		var value = $(this).text();
		// add only if the value is number
		if (!isNaN(value) && value.length != 0) {
			sum += parseFloat(value);
		}
	});

	$('.result' + id).text(sum);
};

		<?php 
		$vehicle_id = '';
		$i = 1;
		foreach ($stop->result() as $row) {
		$i++;

		if ($vehicle_id != $row->vehicle_id) {
			$vehicle_id = $row->vehicle_id;
		?>
		$(document).ready(function(){
		    var total = 0;
		    $('.duration<?php echo $row->vehicle_id?>').each(function(){
		        total += toSeconds( $(this).text() );
		    });
		    
		    $('.result<?php echo $row->vehicle_id?>').text( toHHMMSS(total) );
		})
		<?php }} ?>
		</script>
<style>
.ganjil {
	background-color: #999999
}

</style>
<div id="header" align="center">
	<h1><?php echo $pageTitle?></h1>
	<form action="<?php echo site_url()?>report/<?php echo $this->uri->segment(2)?>/pdf"
	id="pdf_report" target="_blank" method="POST">
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
$sum = 0;
foreach ($stop->result() as $row) { 
	$x ++;
// 	$sum += sum_the_time($row[])
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
	<tr>
		<td colspan="5">Total Stop Duration : 
			<!-- <span class="result<?php echo $row->vehicle_id?>"></span> -->
			<span><?php echo $_SESSION[$row->name];?></span>
		</td>
	</tr>
		<?php
	} else {
		array_push($daily_total[$row->name], $row->duration);
	}
	$total[$row->name] = sum_the_time($daily_total[$row->name]);
	$_SESSION[$row->name] = $total[$row->name];
// 	echo 'total'.$row->name .$total[$row->name];
// 	print_r($total);
	?>		
		<tr class="<?php echo $class?>">
		<td><?php echo $row->date ?></td>
		<td><?php echo $row->start_time ?></td>
		<td><?php echo $row->end_time ?></td>
		<td><?php echo $row->location ?></td>
		<td class="duration<?php echo $row->vehicle_id;?>"><?php echo $row->duration;//$x; ?></td>
	</tr>	
	<?php
}
?>
</table>