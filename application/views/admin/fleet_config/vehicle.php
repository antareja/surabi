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
						value="<?php echo isset($vehicle) ? $vehicle->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Vendor </label>
				<div class="col-sm-9">
					<select class="form-control" name="company_id" id="company_id">
						<option value="">&nbsp;</option>
						<?php foreach($companies as $company) { ?>
						<option value="<?php  echo $company->id_company?>"
						<?php if(isset($vehicle)) {
							echo $company->id_company == $vehicle->company_id ? 'selected':'';
						}?>><?php echo $company->name?></option>
						<?php  }?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> GPS ID</label>
				<div class="col-sm-9">
					<select class="form-control" name="mobile_address" id="form-field-select-2"
						data-placeholder="Choose a Vehicle">
						<option value="">&nbsp;</option>
						<?php foreach ($all_mobile as $mobile) { ?>
						<option value="<?php echo $mobile->mobile_address?>" 
							<?php 
							if (isset($vehicle)) {
							echo $mobile->mobile_address == $vehicle->gps_mobile_address ? 'selected':'';
							}?>><?php echo $mobile->mobile_address?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> User Assign</label>
				<div class="col-sm-9">
					<select class="form-control" name="user_id" id="user_id">
						<option value="">&nbsp;</option>
						<?php foreach($users as $user) { ?>
						<option value="<?php  echo $user->user_id?>"
						<?php if(isset($vehicle)) {
							echo $user->user_id == $vehicle->user_id ? 'selected':'';
						}?>><?php echo $user->fullname?></option>
						<?php  }?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Driver Assign</label>
				<div class="col-sm-9">
					<select class="form-control" name="driver_id" id="driver_id">
						<option value="">&nbsp;</option>
						<?php foreach($drivers as $driver) { ?>
						<option value="<?php  echo $driver->driver_id?>"
						<?php if(isset($vehicle)) {
							echo $driver->driver_id == $vehicle->driver_id ? 'selected':'';
						}?>><?php echo $driver->name?></option>
						<?php  }?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Hardware Type </label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Vehicle">
						<option value="1">RV7</option>
						<?php // foreach ($hardwares as $hardware) { ?>
						<option value="<?php // echo $hardware->hardware_id?>"><?php // echo $hardware->name?></option>
						<?php // } ?>
					</select>
				</div>
			</div> 
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Base</label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Vehicle" name="base_id" required>
						<option value="">&nbsp;</option>
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
						<option value="">&nbsp;</option>
						<?php foreach ($icons as $icon) { ?>
						<option value="<?php echo $icon->icon_id?>"
						style="background:url(<?php echo base_url().'assets/uploads/icon_'.$icon->icon_id.'.'.$icon->image_type;?>) left no-repeat; "
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
						data-placeholder="Choose a Region" name="region_id">
						<option value=""></option>
						<?php foreach ($regions as $region) { ?>
						<option value="<?php echo $region->region_id?>"
							<?php 
							if (isset($vehicle->region_id)) {
							echo $region->region_id == $vehicle->region_id ? 'selected':'';
							}?>><?php echo $region->name?></option>
						<?php } ?>
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