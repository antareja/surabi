<div class="page-content">
	<div class="page-header">
		<h1>
			Fleet Configuration <small> <i class="icon-double-angle-right"></i>
				Base
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">
						List Base 
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
						<?php 
							foreach ($all_base as $bases)
							{
								echo "<p><a href='".base_url()."admin/fleet_config/base/".$bases->base_id."'>".$bases->name."</a></p>";
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
				action="<?php echo site_url();?>admin/fleet_config/base/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($base) ? $base->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Vehicle Icon for this Base </label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2"
						data-placeholder="Choose a Vehicle Base" name="icon_id">
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
						placeholder="Description"><?php  echo  isset($base) ? $base->description : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Address </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="address" name="address"
						placeholder="Address"><?php  echo  isset($base) ? $base->address : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Phone </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone" name="phone"
						placeholder="Phone"
						value="<?php echo isset($base) ? $base->phone : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Phone2 </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="phone2" name="phone2"
						placeholder="Phone2"
						value="<?php echo isset($base) ? $base->phone2 : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Fax </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="fax" name="fax"
						placeholder="Fax"
						value="<?php echo isset($base) ? $base->fax : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Email </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" name="email"
						placeholder="Email"
						value="<?php echo isset($base) ? $base->email : '';?>">
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
			
				<?php echo isset($base) ? '<input type="hidden" name="id_base" value="'.$base->base_id.'" >' : '';?>"
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->