<div class="page-content">
	<div class="page-header">
		<h1>
			Fleet Configuration <small> <i class="icon-double-angle-right"></i>
				Vehicle
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">

		<div class="col-sm-6">

			<form role="form" class="form-horizontal"
				enctype="multipart/form-data"
				action="<?php echo site_url();?>admin/fleet_config/vehicle/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($vehicle) ? $vehicle->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Hardware Type</label>
				<div class="col-sm-9">
					<textarea class="form-control" id="hardware_type" name="hardware_type"
						placeholder="Description"><?php  echo  isset($vehicle) ? $vehicle->hardware_type : '';?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"></label>
				<div class="col-sm-9">
					<input class="ace form-control" type="checkbox"
						name="message_enabled" value="1"  <?php echo isset($vehicle->message_enable)==1 ? 'checked': ''?>> <span class="lbl"> Device is able to
						recieve text message </span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"></label>
				<div class="col-sm-9">
					<input class="ace form-control" type="checkbox"
						name="garmin_support" value="1" <?php echo isset($vehicle->garmin_support)==1 ? 'checked': ''?>> <span class="lbl"> Garmin Device
						Support </span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Max Length</label>
				<div class="col-sm-9">
					<input type="text" class="col-xs-2" id="max_message_length" name="max_message_length"
						placeholder="Max"
						value="<?php echo isset($vehicle) ? $vehicle->max_message_length : '';?>">
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
				<?php echo isset($vehicle) ? '<input type="hidden" name="hardware_id" value="'.$vehicle->hardware_id.'" >' : '';?>
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->