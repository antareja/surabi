<div class="page-content">
	<div class="page-header">
		<h1>
			<small>System Configuration <i class="icon-double-angle-right"></i></small> 
				<?php echo ucfirst($level);?>  <?php echo isset($user) ? ': '. $user->fullname . '&nbsp;<button onclick="location.href=\''.site_url().'admin/sys_config/user/'.$level.'\'" class="btn btn-sm btn-primary">Add New</button>' : ': Add new '?>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">List <?php echo ucfirst($level);?></h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
						<?php
						foreach ($all_user as $users) {
							echo "<p><a href='" . site_url() . "admin/sys_config/user/".$level. '/' . $users->user_id . "'>" . $users->username . "</a>";
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
				enctype="multipart/form-data"
				action="<?php echo site_url().'admin/sys_config/user/'.$level;?>"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Full Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="fullname" name="fullname"
						value="<?php echo isset($user) ? $user->fullname : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> User Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username" name="username"
						value="<?php echo isset($user) ? $user->username : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Password </label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password" name="password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> ReType Password </label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="re_password" name="re_password">
				</div>
			</div>
			<?php if($_SESSION['gps_level'] == 'admin') {?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Vendor </label>
				<div class="col-sm-9">
					<select class="form-control" name="company_id" id="company_id">
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
			<?php } // TODO:create Dropdown Chain Here ?>
<!-- 			<div class="form-group"> -->
<!-- 				<label class="col-sm-3 control-label no-padding-right" -->
<!-- 					for="form-field-select-2"> Admin Vendor</label> -->
<!-- 				<div class="col-sm-9"> -->
<!-- 					<select class="form-control" id="admin_id" name="admin_id"> -->
<!-- 						<option value="">&nbsp;</option> -->
<!-- 					</select> -->
<!-- 				</div> -->
<!-- 			</div> -->
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
						<i class="icon-ok bigger-110"></i>
						Submit
					</button>
					<button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i> Reset
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