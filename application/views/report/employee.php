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
<h1>Employees Report</h1>
<?php
echo date("d/m/Y");
$data_report=array
			(
					"0"=>array
					(
								"number"=>"0001",
								"name"=>"Demo 1",
								"phone1"=>"08xxx",
								"phone2"=>"08xxx",
								"email"=>"demo1@demomail.com",
								"user_name"=>"demo1",
								"access_level"=>"administrator",
								"last_login"=>"10/11/12 10:11:12",
					),
					"1"=>array
					(
								"number"=>"0002",
								"name"=>"Demo 2",
								"phone1"=>"08xxx",
								"phone2"=>"08xxx",
								"email"=>"dem2@demomail.com",
								"user_name"=>"demo2",
								"access_level"=>"dispatcher",
								"last_login"=>"10/11/12 11:12:13",
					),
					"2"=>array
					(
								"number"=>"0003",
								"name"=>"Demo 3",
								"phone1"=>"08xxx",
								"phone2"=>"08xxx",
								"email"=>"demo3@demomail.com",
								"user_name"=>"demo3",
								"access_level"=>"supervisor",
								"last_login"=>"10/11/12 12:13:14",
					)
			);
?>
</div>
Sorted By : Employee Number
<hr>
<table width="100%">
<tr>
	<td>Emp. Number</td>
	<td>Name</td>
	<td>Phone1</td>
	<td>Phone2</td>
	<td>Email</td>
	<td>User Name</td>
	<td>Access Level</td>
	<td>Last Login</td>
</tr>
<?php
$x=1;
foreach($data_report as $data)
{
if($x%2==0)$class="genap";
else $class="ganjil";
?>
<tr class="<?php echo $class?>">
	<td><?php echo $data["number"]?></td>
	<td><?php echo $data["name"]?></td>
	<td><?php echo $data["phone1"]?></td>
	<td><?php echo $data["phone2"]?></td>
	<td><?php echo $data["email"]?></td>
	<td><?php echo $data["user_name"]?></td>
	<td><?php echo $data["access_level"]?></td>
	<td><?php echo $data["last_login"]?></td>
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