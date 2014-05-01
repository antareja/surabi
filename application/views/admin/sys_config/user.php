<div class="page-content">
	<div class="page-header">
		<h1>
			<small>System Configuration <i class="icon-double-angle-right"></i></small> 
				<?php echo ucfirst($level);?>  <?php echo isset($user) ? ': '. $user->fullname  : ': Add new '?>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">
						<i class="icon-list"></i>List <?php echo ucfirst($level);?></h4>
					<div class="widget-toolbar">
					<?php echo isset($user) ? '<button onclick="location.href=\''. site_url().'admin/sys_config/user/'. $level.'\'" class="btn btn-xs btn-primary">Add New '.ucfirst($level).'</button>' : '' ?> 
				</div>
				</div>
				<div class="widget-body">
					<div class="widget-main  no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th><i class="icon-user"></i> User</th>

									<th><i class="icon-group"></i> Vendor</th>
									<th class="hidden-480">Status</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="">Alex</td>

									<td><a href="#">alex@email.com</a></td>

									<td class="hidden-480"><span class="label label-warning">Pending</span>
									</td>
								</tr>
							</tbody>
						</table>

						<p class="muted">
						<?php
						foreach ($all_user as $users) {
							echo "<p><a class=\"blue\" href='" . site_url() . "admin/sys_config/user/" . $level . '/' . $users->user_id . "'>" . $users->username . "&nbsp;&nbsp;<i class=\"icon-pencil\"></i></a> | &nbsp;&nbsp;<a href=\"#\" class=\"red\"><i class=\"icon-trash bigger-130\"></i></a> ";
							if ($_SESSION['gps_level'] == 'admin') {
								echo ' : '. $users->company_name;
							}
							echo "</p>";
						}
						?>
						
						
						
						<p>
					
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<form role="form" id="form-user" class="form-horizontal form-user"
				enctype="multipart/form-data" action="<?php echo $action;?>"
				method="POST" />
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Full Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="fullname"
						name="fullname"
						value="<?php echo isset($user) ? $user->fullname : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> User Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username"
						name="username"
						value="<?php echo isset($user) ? $user->username : '';?>"
						required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Password </label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password"
						name="password" <?php empty($user) ? 'required="required"' : '' ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> ReType Password </label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="re_password"
						name="re_password">
				</div>
			</div>
			<?php if($_SESSION['gps_level'] == 'admin' && empty($user)) {?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Vendor </label>
				<div class="col-sm-9">
					<select class="form-control" name="company_id" id="company_id"
						required="required">
						<option value="">&nbsp;</option>
						<?php foreach($companies as $company) { ?>
						<option value="<?php  echo $company->id_company?>"
							<?php if(isset($user)) {
							echo $company->id_company == $user->company_id ? 'selected':'';
						}?>><?php echo $company->name?></option>
						<?php  }?>
					</select>
				</div>
			</div>
			<?php }
				if ($level == 'operator') {?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Admin Vendor</label>
				<div class="col-sm-9">
					<select class="form-control" id="admin_id" name="admin_id">
						<option value="">&nbsp;</option>
					</select>
				</div>
			</div>
			<?php } elseif($level == 'admin' && isset($user)) { ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Vendor </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" disabled="disabled"
						value="<?php echo isset($vendor->name) ? $vendor->name: '';?>">
				</div>
			</div>
			<?php } ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Address </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="address" name="address"
						placeholder="Address"><?php  echo  isset($user) ? $user->address : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Phone </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone" name="phone"
						value="<?php echo isset($user) ? $user->phone : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Phone2 </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone2" name="phone2"
						value="<?php echo isset($user) ? $user->phone2 : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Email </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" name="email"
						value="<?php echo isset($user) ? $user->email : '';?>">
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info btn-user" type="button">
						<i class="icon-ok bigger-110"></i> Submit
					</button>
					
					<button id="btn-delete-user" class="btn btn-danger" type="reset">
						<i class="icon-trash bigger-110"></i> Delete User
					</button>
				</div>
			</div>
				<?php echo isset($user) ? '<input type="hidden" name="user_id" value="'.$user->user_id.'" >' : '';?>
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->
<div id="dialog-confirm" class="hide">
	<div id="confirm-deleted" class="alert alert-info bigger-110"><?php echo $user->fullname?> will be
		permanently deleted and cannot be recovered.</div>

	<div class="space-6"></div>

	<p class="bigger-110 bolder center grey">
		<i class="icon-hand-right blue bigger-120"></i> Are you sure?
	</p>
</div>
<!-- #dialog-confirm -->