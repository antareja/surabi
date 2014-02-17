<style>
<!--
.ganjil
{
	background-color: #999999
}
-->
</style>
<div id="header" align="center">
<h1>Activity Report</h1>
<?php
echo date("d/m/Y");
$data_report=array
			(
					"0"=>array
					(
								"vehicle"=>"Dump Truck",
								"time"=>"09:10:11",
								"location"=>"JL Budhi",
								"speed"=>"30 km/h",
								"bearing"=>"W",
								"lat"=>"-6.921911",
								"lng"=>"107.61391000000003",
								"region"=>"Cimahi",
					),
					"1"=>array
					(
								"vehicle"=>"Dump Truck",
								"time"=>"12:13:14",
								"location"=>"JL Pajajaran",
								"speed"=>"20 km/h",
								"bearing"=>"N",
								"lat"=>"-6.921911",
								"lng"=>"107.61391000000003",
								"region"=>"-",
					),
					"2"=>array
					(
								"vehicle"=>"Dump Truck",
								"time"=>"11:12:13",
								"location"=>"JL Gardu Jati",
								"speed"=>"30 km/h",
								"bearing"=>"N",
								"lat"=>"-6.921911",
								"lng"=>"107.61391000000003",
								"region"=>"-",
					)
			);
?>
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
	<td><?php echo $data["lat"]?></td>
	<td><?php echo $data["lng"]?></td>
	<td><?php echo $data["region"]?></td>
</tr>	
<?php
$x++;
}
?>
</table>