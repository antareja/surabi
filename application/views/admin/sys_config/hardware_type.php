<div class="page-content">
	<div class="page-header">
		<h1>
			System Configuration <small> <i class="icon-double-angle-right"></i>
				Hardware
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
							foreach ($all_hardware as $hardwares)
							{
								echo "<p><a href='".base_url()."admin/sys_config/hardware/".$hardwares->hardware_id."'>".$hardwares->name."</a></p>";
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
				action="<?php echo site_url();?>admin/sys_config/hardware/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($hardware) ? $hardware->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Description </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="description" name="description"
						placeholder="Description"><?php  echo  isset($hardware) ? $hardware->description : '';?></textarea>
				</div>
			</div>
			<?php 
			/*
			?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"></label>
				<div class="col-sm-9">
					<input class="ace form-control" type="checkbox"
						name="message_enabled" value="1"  <?php echo isset($hardware->message_enable)==1 ? 'checked': ''?>> <span class="lbl"> Device is able to
						recieve text message </span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"></label>
				<div class="col-sm-9">
					<input class="ace form-control" type="checkbox"
						name="garmin_support" value="1" <?php echo isset($hardware->garmin_support)==1 ? 'checked': ''?>> <span class="lbl"> Garmin Device
						Support </span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Max Length</label>
				<div class="col-sm-9">
					<input type="text" class="col-xs-2" id="max_message_length" name="max_message_length"
						placeholder="Max"
						value="<?php echo isset($hardware) ? $hardware->max_message_length : '';?>">
				</div>
			</div>
			<?php
			*/
			?>
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

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->