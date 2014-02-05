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

		<div class="col-sm-6">

			<form role="form" class="form-horizontal"
				enctype="multipart/form-data"
				action="<?php echo site_url();?>admin/sys_config/company_data/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php  isset($base) ? $base->address : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-select-2"> Vehicle Icon for this Base </label>
				<div class="col-sm-9">
					<select class="form-control" id="form-field-select-2" 
						data-placeholder="Choose a Country...">
						<option value="">&nbsp;</option>
						<option value="base1">Base1</option>
						<option value="base2">Base2</option>
						<option value="base3">Base3</option>
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
			<input type="hidden" name="id_company"
				value="<?php echo isset($base) ? $base->id_company : '';?>">
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->