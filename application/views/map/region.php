<<<<<<< HEAD
<div class="page-content">
	<div class="page-header">
		<h1>
			Map <small> <i class="icon-double-angle-right"></i>
				Region
			</small>
		</h1>
	</div>
	<!-- /.page-header -->
	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">
						List Icon 
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
							<?php 
							foreach ($all_region as $regions)
							{
								echo "<p><a href='".base_url()."map/region/".$regions->region_id."'>".$regions->name."</a></p>";
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
				action="<?php echo site_url();?>map/region/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($region) ? $region->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Description </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="description" name="description"
						placeholder="Description"><?php  echo  isset($region) ? $region->description : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Expire Time </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="expire_time" name="expire_time"
						placeholder="expire_time"
						value="<?php echo isset($region) ? $region->expire_time : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Time Start </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="time_start" name="time_start"
						placeholder="time_start"
						value="<?php echo isset($region) ? $region->time_start : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Time End </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="time_end" name="time_end"
						placeholder="time_end"
						value="<?php echo isset($region) ? $region->time_end : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> In Out </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="in_out" name="in_out"
						placeholder="in_out"
						value="<?php echo isset($region) ? $region->in_out : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Color </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="color" name="color"
						placeholder="color"
						value="<?php echo isset($region) ? $region->color : '';?>">
				</div>
				<br>
				<br>
				<div class="panel-body">
					<br>
					* Klik kanan untuk menandai peta
					<br>
					* Klik pada penanda peta untuk menghapus penanda
					<br>
					* Anda bisa menggeser penanda dengan cara drag penanda
					<div id="map_canvas_region" style="width: 100%; height: 400px"></div>
					<div id="div_input"></div>
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
				<?php echo isset($hardware) ? '<input type="hidden" name="hardware_id" value="'.$hardware->hardware_id.'" >' : '';?>
			</form>
		</div>
		<textarea id="tmp_position" style="display:none"><?php echo isset($region) ? $region->latlng : '';?></textarea>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->
=======
<div class="page-content">
	<div class="page-header">
		<h1>
			Map <small> <i class="icon-double-angle-right"></i>
				Region
			</small>
		</h1>
	</div>
	<!-- /.page-header -->
	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">
						List Icon 
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
							<?php 
							foreach ($all_region as $regions)
							{
								echo "<p><a href='".base_url()."map/region/".$regions->region_id."'>".$regions->name."</a></p>";
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
				action="<?php echo site_url();?>map/region/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($region) ? $region->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Description </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="description" name="description"
						placeholder="Description"><?php  echo  isset($region) ? $region->description : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Expire Time </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="expire_time" name="expire_time"
						placeholder="expire_time"
						value="<?php echo isset($region) ? $region->expire_time : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Time Start </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="time_start" name="time_start"
						placeholder="time_start"
						value="<?php echo isset($region) ? $region->time_start : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Time End </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="time_end" name="time_end"
						placeholder="time_end"
						value="<?php echo isset($region) ? $region->time_end : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> In Out </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="in_out" name="in_out"
						placeholder="in_out"
						value="<?php echo isset($region) ? $region->in_out : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Color </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="color" name="color"
						placeholder="color"
						value="<?php echo isset($region) ? $region->color : '';?>">
				</div>
				<br>
				<br>
				<div class="panel-body">
					<div id="map_canvas_region" style="width: 100%; height: 400px"></div>
					<div id="div_input"></div>
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
				<?php echo isset($hardware) ? '<input type="hidden" name="hardware_id" value="'.$hardware->hardware_id.'" >' : '';?>
			</form>
		</div>
		<textarea id="tmp_position" style="display:none"><?php echo isset($region) ? $region->latlng : '';?></textarea>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->
>>>>>>> branch 'master' of https://github.com/antareja/surabi.git
<script src="<?php echo base_url() ?>assets/js/map_region.js"></script>
