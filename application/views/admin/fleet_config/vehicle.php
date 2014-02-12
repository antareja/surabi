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
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">List Vehicle</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
						<?php
						foreach ($all_vehicle as $vehicles) {
							echo "<p><a href='" . base_url() . "admin/fleet_config/vehicle/" . $vehicles->vehicle_id . "'>" . $vehicles->name . "</a></p>";
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
				action="<?php echo site_url();?>admin/fleet_config/vehicle/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($vehicle) ? $vehicle->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> GPS ID</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="gps_id" name="gps_id"
						placeholder="GPS ID"
						value="<?php echo isset($vehicle) ? $vehicle->gps_id : '';?>">
				</div>
			</div>
			<!-- <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Hardware Type </label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Vehicle">
						<?php foreach ($hardwares as $hardware) { ?>
						<option value="<?php echo $hardware->hardware_id?>"><?php echo $hardware->name?></option>
						<?php } ?>
					</select>
				</div>
			</div> -->
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Base</label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Vehicle" name="base_id">
						<?php foreach ($bases as $base) { ?>
						<option value="<?php echo $base->base_id?>"
							<?php 
								if (isset($vehicle)) {
								echo $base->base_id == $vehicle->base_id ? 'selected' : '';
							} ?>><?php echo $base->name?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Icon</label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Icon" name="icon_id">
						<?php foreach ($icons as $icon) { ?>
						<option value="<?php echo $icon->icon_id?>"
							<?php 
							if (isset($vehicle)) {
							echo $icon->icon_id == $vehicle->icon_id ? 'selected':'';
							}?>><?php echo $icon->name?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Alert Profile</label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Icon">
						<option value=""></option>
					</select>
				</div>
			</div> 
			<?php echo isset($vehicle) ? '<input type="hidden" name="vehicle_id" value="'.$vehicle->vehicle_id.'" >' : '';?>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input type="submit" class="btn btn-info" value="Submit"> &nbsp;
					&nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i> Reset
					</button>
				</div>
			</div>
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->