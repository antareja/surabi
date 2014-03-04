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
		<h1><?php echo $pageTitle;?></h1>
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
		<tr style="background-color: #666666">
			<td colspan="8">Vehicle : Dump Truck</td>
		</tr>
<?php
$x = 1;
foreach ($speed as $row) {
	if ($x % 2 == 0)
		$class = "genap";
	else
		$class = "ganjil";
	?>
<tr class="<?php echo $class?>">
			<td><?php echo $row->name?></td>
			<td><?php echo $row->create_at?></td>
			<td><?php echo $row->location?></td>
			<td><?php echo $row->velocity?></td>
			<td><?php echo $row->bearing?></td>
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