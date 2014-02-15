<style>
<!--
.ganjil
{
	background-color: #999999
}
-->
</style>
<div id="header" align="center">
<h1>Alert Report</h1>
<?php
echo date("d/m/Y");
$data_report=array
			(
					"0"=>array
					(
								"vehicle"=>"Dump Truck",
								"driver"=>"Driver 1",
								"alert_time"=>"10:11:12",
								"alert_type"=>"Region Entry",
								"location"=>"Jl Budhi",
								"alert_description"=>"Arrive at Cimahi",
					),
					"1"=>array
					(
								"vehicle"=>"Dump Truck",
								"driver"=>"Driver 1",
								"alert_time"=>"11:12:13",
								"alert_type"=>"Region Entry",
								"location"=>"Jl BKR",
								"alert_description"=>"Arrive at Tegallega",
					),
					"2"=>array
					(
								"vehicle"=>"Dump Truck",
								"driver"=>"Driver 1",
								"alert_time"=>"12:13:14",
								"alert_type"=>"Region Entry",
								"location"=>"Jl Pajajaran",
								"alert_description"=>"Arrive at Hussein",
					)
			);
?>
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
<tr style="background-color:#666666">
	<td colspan="8">Vehicle : Dump Truck</td>
</tr>
<?php
$x=1;
foreach($data_report as $data)
{
if($x%2==0)$class="genap";
else $class="ganjil";
?>
<tr class="<?php echo $class?>">
	<td><?php echo $data["vehicle"]?></td>
	<td><?php echo $data["driver"]?></td>
	<td><?php echo $data["alert_time"]?></td>
	<td><?php echo $data["alert_type"]?></td>
	<td><?php echo $data["location"]?></td>
	<td><?php echo $data["alert_description"]?></td>
</tr>	
<?php
$x++;
}
?>
</table>