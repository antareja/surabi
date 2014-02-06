<div class="page-content">
	<div class="page-header">
		<h1>
			System Configuration <small> <i class="icon-double-angle-right"></i>
				Icon
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">

		<div class="col-sm-6">

			<form role="form" class="form-horizontal"
				enctype="multipart/form-data"
				action="<?php echo site_url();?>admin/sys_config/icon/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($icon) ? $icon->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Available Local Icon </label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Vehicle Base">
						<option value="">&nbsp;</option>
						<option value="1">car</option>
						<option value="2">Fire Truck</option>
						<option value="3">Taxi</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Description </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="description" name="description"
						placeholder="Description"><?php  echo  isset($icon) ? $icon->description : '';?></textarea>
				</div>
			</div>
			<?php if (isset($icon)) {
					if($icon->image_name) { ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Icon File Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone" name="phone"
						placeholder="Phone"
						value="<?php echo isset($icon) ? $icon->icon_name : '';?>">
				</div>
			</div>
				<?php } ?>
			<?php } ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="icon"> Icon </label>
					<?php echo isset($icon->icon) ? $icon->icon : '';?>
				<div class="col-sm-9">
					<input type="file" id="id-input-file-2" name="icon"/>
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
			
				<?php echo isset($icon) ? '<input type="hidden" name="id_base" value="'.$icon->icon_id.'" >' : '';?>"
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->