<div class="page-content">
	<div class="page-header">
		<h1>
			Fleet Configuration <small> <i class="icon-double-angle-right"></i>
				Driver
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">List Driver</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
						<?php
						foreach ($all_driver as $drivers) {
							echo "<p><a href='" . site_url() . "admin/sys_config/driver/" . $drivers->driver_id . "'>" . $drivers->name . "</a></p>";
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
				action="<?php echo site_url();?>admin/sys_config/driver/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($driver) ? $driver->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Vehicle Use </label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Vehicle driver" name="vehicle_id">
						<option value="">&nbsp;</option>
						<?php foreach($vehicles as $vehicle) {?>
						<option value="<?php echo $vehicle->vehicle_id?>"
						<?php 
							if (isset($driver)) {
							echo $vehicle->vehicle_id == $driver->vehicle_id ? 'selected':'';
							}?>><?php echo $vehicle->name?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Description </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="description" name="description"
						placeholder="Description"><?php  echo  isset($driver) ? $driver->description : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Address </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="address" name="address"
						placeholder="Address"><?php  echo  isset($driver) ? $driver->address : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Phone </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone" name="phone"
						placeholder="Phone"
						value="<?php echo isset($driver) ? $driver->phone : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Phone2 </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone2" name="phone2"
						placeholder="Phone2"
						value="<?php echo isset($driver) ? $driver->phone2 : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Email </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" name="email"
						placeholder="Email"
						value="<?php echo isset($driver) ? $driver->email : '';?>">
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
			
				<?php echo isset($driver) ? '<input type="hidden" name="driver_id" value="'.$driver->driver_id.'" >' : '';?>
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->