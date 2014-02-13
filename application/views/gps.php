<script src="http://localhost:8000/socket.io/socket.io.js"></script>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- <h1 class="page-header">Dashboard</h1> -->
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Maps</h3>
				</div>
				<div class="panel-body">
					<div id="map" style="width: 100%; height: 400px"></div>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.page-content -->

<input type="checkbox" class="check" value="00" onclick="if(this.checked)add_filter(this.value);else remove_filter(this.value);"> 00  <br>
<div id="map_canvas" style="width:100%; height:80%"></div>
Lat &nbsp;&nbsp;&nbsp;: <span id="txt_lat"></span>
<br>
Long :<span id="txt_long"></span><br>
<script src="<?php echo base_url() ?>assets/js/map.js"></script>