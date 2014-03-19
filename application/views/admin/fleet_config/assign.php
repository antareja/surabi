<div class="page-content">
	<div class="page-header">
		<h1>Vehicle & User Assignment</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-header">Assign To User:
			<select name="user_id" id="user_id">
			<option>&nbsp;</option>
			<?php foreach($users as $user) {?>
				<option value="<?php echo $user->user_id;?>"><?php echo $user->fullname?></option>
			<?php } ?>
			</select>
			<button class="btn btn-sm btn-success" id="assign" type="button">
					<i class="icon-ok bigger-110"></i>Assign
			</button>
			<div id="result"></div>
			</div>
			<div class="table-responsive">
				<table id="sample-table-2"
					class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center"><label> <input type="checkbox" class="ace" />
							<span class="lbl"></span>
							</label></th>
							<th>Vehicle</th>
							<th>User</th>
							<th>GPS ID</th>
							<th>Location</th>
							<th><i class="icon-time bigger-110 hidden-480"></i>Position At</th>
							<th class="hidden-480">Status</th>
						</tr>
					</thead>

					<tbody>
						<?php  foreach ($vehicles as $vehicle) {?>
						<tr id="tr_<?php echo $vehicle->gps_mobile_address?>">
							<td class="center"><label>
							<input type="checkbox" name="assign" id="<?php echo $vehicle->vehicle_id?>" class="ace" />
							<span class="lbl"></span>
							</label></td>
							<td><a href="#"><?php echo $vehicle->name?></a></td>
							<td id="vehicle_<?php echo $vehicle->vehicle_id?>"><?php echo $vehicle->fullname?></td>
							<td id="location_<?php echo $vehicle->gps_mobile_address?>"><?php echo $vehicle->gps_mobile_address?></td>
							<td id="position_<?php echo $vehicle->gps_mobile_address?>">Location</td>
							<td id="position_<?php echo $vehicle->gps_mobile_address?>">Feb 12 10:45:23</td>
							<td class="hidden-480"><span class="label label-sm label-warning">Expiring</span></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.page-content -->
<script src="<?php echo base_url() ?>assets/js/fleet.js"></script>