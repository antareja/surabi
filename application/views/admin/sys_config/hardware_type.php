<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<!-- <h1 class="page-header">Dashboard</h1> -->
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Hardware Type</h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-5">
						<form role="form" enctype="multipart/form-data"
							action="<?php echo site_url();?>admin/sys_config/hardware_type/"
							method="POST" />

						<div class="form-group">
							<input type="text" class="form-control" id="name" name="name"
								placeholder="Name">
						</div>
						<div class="form-group">
							<textarea class="form-control" id="description" name="description"
								placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<input type="checkbox" class="form-control" id="message" name="messages"
								placeholder="Messages">
								<label for="message">Device is able to receive text messages</label> 
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="max_message" name="max_messages"
								placeholder="Max Length"> 
						</div>
						<div class="form-group">
							<input type="checkbox" class="form-control" id="garmin" name="garmin"
								placeholder="Garmin Device Support"> 
								<label for="garmin">Device is able to receive text messages</label>
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
