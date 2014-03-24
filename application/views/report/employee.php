<div id="isi">
<style>
<!--
.ganjil
{
	background-color: #999999
}
-->
</style>
<img onclick="f1.submit()" src="<?php base_url()?>/assets/img/pdf.png" style="cursor:pointer">
<div id="header" align="center">
<h1>Employees Report</h1>
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
foreach($employee as $row)
{
if($x%2==0)$class="genap";
else $class="ganjil";
?>
<tr class="<?php echo $class?>">
	<td><?php echo $row->user_id?></td>
	<td><?php echo $row->fullname?></td>
	<td><?php echo $row->phone?></td>
	<td><?php echo $row->phone2?></td>
	<td><?php echo $row->email?></td>
	<td><?php echo $row->username?></td>
	<td><?php echo $row->level?></td>
	<td><?php echo $row->login?></td>
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