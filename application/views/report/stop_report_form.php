<div class="page-content">
	<div class="page-header">
		<h1>
			Activity Report<small> <i class="icon-double-angle-right"></i>
				Activity Form
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-6">

			<form role="form" class="form-horizontal"
				enctype="multipart/form-data"
				action="<?php echo site_url();?>report/activity/" method="POST" />

			<div class="form-group">
			<div class="col-sm-5">
				<label for="form-field-select-2 control-label no-padding-right">Vehicles</label> 
				<select name="vehicle[]" class="form-control" id="form-field-select-2" multiple siz="3">
					<?php foreach($vehicles as $vehicle) {?>
					<option value="<?php echo $vehicle->vehicle_id?>"><?php echo $vehicle->name?></option>
					<?php } ?>
				</select>
			</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Beginning</label>
				<div class="col-sm-5">
					<div class="input-group">
						<input type="text" class="form-control date-picker"
							id="id-date-picker-1" name="begin" placeholder="Name"
							date-format="dd-mm-yyyy"> <span class="input-group-addon"> <i
							class="icon-calendar bigger-110"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Ending</label>
				<div class="col-sm-5">
					<div class="input-group">
						<input type="text" class="form-control date-picker2" id="name"
							name="end" placeholder="Name" date-format="dd-mm-yyyy"><span
							class="input-group-addon"> <i class="icon-calendar bigger-110"></i>
						</span>
					</div>
				</div>
				<div class="form-group"></div>
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