<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<!-- <h1 class="page-header">Dashboard</h1> -->
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Base</h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-5">
						<form role="form" enctype="multipart/form-data"
							action="<?php echo site_url();?>admin/fleet_config/hardware_type/"
							method="POST" />

						<div class="form-group">
							<input type="text" class="form-control" id="vehicle_icon" name="vehicle_icon"
								placeholder="Name">
						</div>
						<div class="form-group">
							<textarea class="form-control" id="description" name="description"
								placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<textarea class="form-control" id="address" name="address"
								placeholder="Address"></textarea>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="phone" name="phone"
								placeholder="Phone"> 
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="phone2" name="phone2"
								placeholder="Phone 2"> 
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="fax" name="fax"
								placeholder="Fax"> 
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="email" name="email"
								placeholder="E-mail"> 
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
