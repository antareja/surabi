<div class="page-content">
	<div class="page-header">
		<h1>
			Fleet Configuration <small> <i class="icon-double-angle-right"></i>
				User
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">List User</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
						<?php
						foreach ($all_user as $users) {
							echo "<p><a href='" . site_url() . "admin/user/" . $users->user_id . "'>" . $users->username . "</a></p>";
						}
						?>
						<p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">

			<form role="form" class="form-horizontal"
				enctype="multipart/form-data"
				action="<?php echo site_url();?>admin/user/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Full Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="fullname" name="fullname"
						placeholder="Name"
						value="<?php echo isset($user) ? $user->fullname : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> User Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username" name="username"
						placeholder="Name"
						value="<?php echo isset($user) ? $user->username : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Password </label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password" name="password"
						placeholder="Name"
						value="<?php echo isset($user) ? $user->password : '';?>">
				</div>
			</div>
<!-- 			<div class="form-group"> -->
<!-- 				<label class="col-sm-3 control-label no-padding-right" -->
<!-- 					for="form-field-select-2"> Vehicle Use </label> -->
<!-- 				<div class="col-sm-9"> -->
<!-- 					<select class="form-control" id="form-field-select-2" -->
<!-- 						data-placeholder="Choose a Vehicle user" name="vehicle_id"> -->
<!-- 						<option value="">&nbsp;</option> -->
						<?php // foreach($vehicles as $vehicle) {?>
						<option value="<?php // echo $vehicle->vehicle_id ?>"><?php // echo $vehicle->name?></option>
						<?php // }?>
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
						placeholder="Phone"
						value="<?php echo isset($user) ? $user->phone : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Phone2 </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone2" name="phone2"
						placeholder="Phone2"
						value="<?php echo isset($user) ? $user->phone2 : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Email </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" name="email"
						placeholder="Email"
						value="<?php echo isset($user) ? $user->email : '';?>">
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input type="submit" class="btn btn-info" value="Submit"> &nbsp;
					&nbsp; &nbsp;
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