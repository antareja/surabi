<div class="page-content">
	<div class="page-header">
		<h1>
			<?php echo $pageTitle;?><small> <i class="icon-double-angle-right"></i>
				Form
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-6">

			<form role="form" class="form-horizontal" id="form-report"
				enctype="multipart/form-data"
				action="<?php echo site_url();?>report/<?php echo $report;?>"
				method="POST" />

			<div class="form-group">
				<div class="col-sm-5">
					<label for="form-field-select-2 control-label no-padding-right">Vehicles</label>
					<select name="vehicle[]" class="form-control"
						id="form-field-select-2" multiple siz="3">
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
							id="date-picker" name="begin" placeholder="Name"
							date-format="yy-mm-dd"> <span class="input-group-addon"> <i
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
						<input type="text" class="form-control" id="date-picker2"
							name="end" placeholder="Name" date-format="yy-mm-dd"><span
							class="input-group-addon"> <i class="icon-calendar bigger-110"></i>
						</span>
					</div>
				</div>
				<div class="form-group"></div>
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info btn-view" type="button">
							<i class="icon-ok bigger-110"></i> View Only
						</button>
						<button class="btn btn-success btn-pdf" type="button">
							<i class="icon-book bigger-110"></i> PDF
						</button>
					</div>
				</div>
				<input type="hidden" name="pdf" value="">
				</form>
			</div>

		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.page-content -->