<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<!-- <h1 class="page-header">Dashboard</h1> -->
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Icon</h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-5">
						<form role="form" enctype="multipart/form-data"
							action="<?php echo site_url();?>admin/sys_config/icon/"
							method="POST" />

						<div class="form-group">
							<input type="text" class="form-control" name="name"
								placeholder="Name">
						</div>
						<div class="form-group">
							<textarea class="form-control" name="description"
								placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<input type="file" class="form-control" name="icon"
								placeholder="Icon"> 
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
