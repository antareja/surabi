<style>
<!--
.ganjil
{
	background-color: #999999
}
-->
</style>
<div id="header" align="center">
<h1>Speed Report</h1>
<?php
echo date("d/m/Y");
$data_report=array
			(
					"0"=>array
					(
								"vehicle"=>"Dump Truck",
								"time"=>"Driver 1",
								"location"=>"Jl BKR",
								"speed"=>"40 km/h",
								"bearing"=>"N",
					),
					"1"=>array
					(
								"vehicle"=>"Dump Truck",
								"time"=>"Driver 1",
								"location"=>"Jl BKR",
								"speed"=>"40 km/h",
								"bearing"=>"N",
					),
					"2"=>array
					(
								"vehicle"=>"Dump Truck",
								"time"=>"Driver 1",
								"location"=>"Jl BKR",
								"speed"=>"40 km/h",
								"bearing"=>"N",
					)
			);
?>
</div>
Sorted By : Vehicle
<hr>
<table width="100%">
<tr>
	<td>Vehicle</td>
	<td>Time</td>
	<td>Location</td>
	<td>Speed</td>
	<td>Bearing</td>
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
	<td><?php echo $data["time"]?></td>
	<td><?php echo $data["location"]?></td>
	<td><?php echo $data["speed"]?></td>
	<td><?php echo $data["bearing"]?></td>
</tr>	
<?php
$x++;
}
?>
</table>