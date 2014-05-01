<div class="page-content">
	<div class="page-header">
		<h1>
		<small>System Config <i class="icon-double-angle-right"></i></small> 
		<?php echo ucfirst($this->config->item('vendor'))?><?php echo isset($vendor) ? ' : '.$vendor->name .' &nbsp;<button onclick="location.href=\''.site_url().'admin/sys_config/vendor\'" class="btn btn-sm btn-primary">Add New</button>' : " : Add New"?>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">
						List <?php echo ucfirst($this->config->item('vendor'))?> 
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
						
						<?php 
							foreach ($all_company as $companies)
							{
								echo "<p><a href='".base_url()."admin/sys_config/vendor/".$companies->id_company."'>".$companies->name."</a></p>";
							}
						?>
						<p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="tabbable">
				<ul class="nav nav-tabs padding-12 tab-color-blue background-blue"
					id="myTab4">
					<li class="active"><a data-toggle="tab" href="#general">General</a></li>
					<li><a data-toggle="tab" href="#parameter">Parameter</a></li>
					<li><a data-toggle="tab" href="#fleet-control">Fleet Control</a></li>
					<li><a data-toggle="tab" href="#email-params">Email Params</a></li>
				</ul>

				<div class="tab-content">
					<div id="general" class="tab-pane in active">
						<form role="form" class="form-horizontal"
							enctype="multipart/form-data"
							action="<?php echo site_url();?>admin/sys_config/vendor/"
							method="POST" />

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-1"> Name </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" name="name"
									value="<?php echo isset($vendor) ? $vendor->name : '';?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-1"> Address </label>
							<div class="col-sm-9">
								<textarea class="form-control" id="address" name="address"><?php echo isset($vendor) ? $vendor->address : '';?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-1"> Phone </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="phone" name="phone"
									placeholder="Phone"
									value="<?php echo isset($vendor) ? $vendor->phone : '';?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-1"> Phone2 </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="phone2"
									name="phone2"
									value="<?php echo isset($vendor) ? $vendor->phone2 : '';?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-1"> E-mail </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="email" name="email"
									value="<?php echo isset($vendor) ? $vendor->email : '';?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-1"> Fax </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="fax" name="fax"
									value="<?php echo isset($vendor) ? $vendor->fax : '';?>">
							</div>
						</div>
						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<input type="submit" class="btn btn-info" value="Submit" >
								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="icon-undo bigger-110"></i> Reset
								</button>
							</div>
						</div>
						<input type="hidden" name="id_company" value="<?php echo isset($vendor) ? $vendor->id_company : '';?>">
						</form>
					</div>

					<div id="parameter" class="tab-pane">
						<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla
							single-origin coffee squid.</p>
					</div>

					<div id="fleet-control" class="tab-pane">
						<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they
							sold out mcsweeney's organic lomo retro fanny pack lo-fi
							farm-to-table readymade.</p>
					</div>
					<div id="email-params" class="tab-pane">
						<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they
							sold out mcsweeney's organic lomo retro fanny pack lo-fi
							farm-to-table readymade.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<!-- /.page-content -->