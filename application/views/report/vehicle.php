<div id="isi">
	<style>
<!--
.ganjil {
	background-color: #999999
}
-->
</style>
	<button type="button" onclick="history.back();">Back</button>
	<br> <br> <input type="button" onclick="f1.submit()" value="Print">
	<div id="header" align="center">
		<h1>Vehicles Report</h1>
	</div>
	Sorted By : Alias
	<hr>
	<table width="100%">
		<tr>
			<td>Alias</td>
			<td>H/W Type</td>
			<td>Last Update Time</td>
			<td>Source Type</td>
			<td>Unit Number</td>
			<td>Company Name</td>
		</tr>
<?php
$x = 1;
foreach ($vehicles as $vehicle) {
	if ($x % 2 == 0)
		$class = "genap";
	else
		$class = "ganjil";
	?>
<tr class="<?php echo $class?>">
			<td><?php echo $vehicle->alias?></td>
			<td><?php echo $vehicle->hw?></td>
			<td><?php echo $vehicle->last_update?></td>
			<td><?php echo "G"?></td>
			<td><?php echo $vehicle->unit?></td>
			<td><?php echo $vehicle->company_name?></td>
		</tr>	
<?php
$x++;
}
?>
</table>
</div>