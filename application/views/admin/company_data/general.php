<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<!-- <h1 class="page-header">Dashboard</h1> -->
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">General Company Data</h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-5">
						<form role="form" enctype="multipart/form-data"
							action="<?php echo site_url();?>admin/company_data/"
							method="POST" />

						<div class="form-group">
							<input type="text" class="form-control" name="name"
								placeholder="Name">
						</div>
						<div class="form-group">
							<textarea class="form-control" name="address"
								placeholder="Address"></textarea>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="phone"
								placeholder="Phone"> 
						</div>
						<div class="form-group">
							<input type="text" class="form-control"
								name="phone2" placeholder="Phone2">
						</div>
						<div class="form-group">
							<input type="text" class="form-control"
								name="fax" placeholder="Fax">
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
