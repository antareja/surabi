<div class="page-content">
	<div class="page-header">
		<h1>
			System Configuration <small> <i class="icon-double-angle-right"></i>
				Email
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">List Email</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
						<?php
						foreach ($all_email as $email) {
							echo "<p><a href='" . site_url() . "admin/sys_config/email_data/" . $email->email_id . "'>" . $email->fullname . "</a></p>";
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
				action="<?php echo site_url();?>admin/sys_config/email_data/"
				method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Full Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="fullname" name="fullname"
						value="<?php echo isset($email_data) ? $email_data->fullname : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Email </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" name="email"
						placeholder="Email"
						value="<?php echo isset($email_data) ? $email_data->email : '';?>">
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
				<?php echo isset($email_data) ? '<input type="hidden" name="email_id" value="'.$email_data->email_id.'" >' : '';?>
			</form>
		</div>

	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->