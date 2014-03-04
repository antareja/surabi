<div class="page-content">
	<div class="page-header">
		<h1>
			Profile <small> <i class="icon-double-angle-right"></i>
				Speed
			</small>
		</h1>
	</div>
	<!-- /.page-header -->
	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">
						List Speed 
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
							<?php 
							foreach ($all_speed as $speeds)
							{
								echo "<p><a href='".base_url()."profile/speed_alert/".$speeds->speed_id."'>".$speeds->name."</a></p>";
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
				action="<?php echo site_url();?>profile/speed_alert/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($speed) ? $speed->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Description </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="description" name="description"
						placeholder="Description"><?php  echo  isset($speed) ? $speed->description : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Vehicle</label>
				<div class="col-sm-9">
					<select class="form-control" name="mobile_address" id="form-field-select-2"
						data-placeholder="Choose a Vehicle">
						<option></option>
						<?php foreach ($all_vehicle as $vehicle) { ?>
						<option value="<?php echo $vehicle->gps_mobile_address?>" 
							<?php 
							if (isset($speed)) {
							echo $speed->vehicle_id == $vehicle->vehicle_id ? 'selected':'';
							}?>><?php echo $vehicle->name?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Maximum Speed </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="max_speed" name="max_speed"
						placeholder="max_speed"
						value="<?php echo isset($speed) ? $speed->max_speed : '';?>">
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
				<?php echo isset($speed) ? '<input type="hidden" name="speed_id" value="'.$speed->speed_id.'" >' : '';?>
			</form>
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->
<script src="<?php echo base_url() ?>assets/js/map_region.js"></script>
