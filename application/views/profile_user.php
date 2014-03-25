<div class="page-content">
	<div class="page-header">
		<h1>User Profile</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table border="0" width="100%">
					<tr>
						<td rowspan="6" style="vertical-align: top">Foto</td>
						<td width="7%">User</td>
						<td width="1%">:</td>
						<td><?php echo $data_user[0]->username?></td>
					</tr>
					<tr>
						<td>Full Name</td>
						<td>:</td>
						<td><?php echo $data_user[0]->fullname?></td>
					</tr>
					<tr>
						<td>Level</td>
						<td>:</td>
						<td><?php echo $data_user[0]->level?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?php echo $data_user[0]->email?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $data_user[0]->address?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $data_user[0]->phone?></td>
					</tr>
				</table>
				<br>
				<div class="table-header">Login History</div>
				<div class="table-responsive">
				<table id="sample-table-2"
					class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center"><label> <input type="checkbox" class="ace" />
									<span class="lbl"></span>
							</label></th>
							<th>Login</th>
							<th>Logout</th>
						</tr>
					</thead>

					<tbody>
						<?php  foreach ($data_history as $history) {?>
						<tr>
							<td class="center"><label> <input type="checkbox" class="ace" />
									<span class="lbl"></span>
							</label></td>
							<td><?php echo $history->login?></td>
							<td><?php echo $history->logout?></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.page-content -->