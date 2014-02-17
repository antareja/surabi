<?php 
if($this->input->post("html")!="")
{
	$this->load->helper("dompdf_helper");
	if(!isset($other))$other="";
	pdf_create($this->input->post("html"));
}
else
{
?>
<div id="isi">
<style>
<!--
.ganjil
{
	background-color: #999999
}
-->
</style>
<br>
<input type="button" onclick="f1.submit()" value="Print">
<div id="header" align="center">
<h1>Vehicles Report</h1>
<?php
echo date("d/m/Y");
$data_report=array
			(
					"0"=>array
					(
								"alias"=>"Houling",
								"hardware"=>"GPS001",
								"last_update"=>"14/02/2014 10:10:30",
								"source_type"=>"RV",
								"unit_number"=>"001",
								"base"=>"base1",
					),
					"1"=>array
					(
								"alias"=>"Dump Truck",
								"hardware"=>"GPS002",
								"last_update"=>"14/02/2014 11:11:11",
								"source_type"=>"RV",
								"unit_number"=>"002",
								"base"=>"base2",
					),
					"2"=>array
					(
								"alias"=>"Car",
								"hardware"=>"GPS003",
								"last_update"=>"14/02/2014 10:11:12",
								"source_type"=>"RV",
								"unit_number"=>"003",
								"base"=>"base3",
					)
			);
?>
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
	<td>Base Name</td>
</tr>
<?php
$x=1;
foreach($data_report as $data)
{
if($x%2==0)$class="genap";
else $class="ganjil";
?>
<tr class="<?php echo $class?>">
	<td><?php echo $data["alias"]?></td>
	<td><?php echo $data["hardware"]?></td>
	<td><?php echo $data["last_update"]?></td>
	<td><?php echo $data["source_type"]?></td>
	<td><?php echo $data["unit_number"]?></td>
	<td><?php echo $data["base"]?></td>
</tr>	
<?php
$x++;
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