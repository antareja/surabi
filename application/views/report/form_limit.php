<script>
function parseDate(input) {
	  var parts = input.split('/');
	  // new Date(year, month [, day [, hours[, minutes[, seconds[, ms]]]]])
	  date = new Date(parts[2], parts[0]-1, parts[1]); // Note: months are 0-based
	  return  Math.round(date/1000);
}

$(document).ready(function(){
	$('.submit').click(function() {
		//alert(n);
		//mobile_address = $("#mobile_address option:selected").text();
		mobile_address = $("#mobile_address").val();
		begin = parseDate($("input[name='begin']").val());
		end = parseDate($("input[name='end']").val());
		window.location = "<?php echo site_url();?>report/speed_limit/" + mobile_address + "/" + begin + "/" + end;
	});
});
</script> 
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

			<div class="form-horizontal"/> 

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="mobile_address"> Vehicle </label>
				<div class="col-sm-9">
					<select name="mobile_address" id="mobile_address">	
					<?php 
					foreach($vehicles as $vehicle)
					{
					?>
						<option value="<?php echo $vehicle->gps_mobile_address ?>"><?php echo $vehicle->name ?></option>
					<?php
					}
					?>
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
						<button class="submit btn btn-info btn-view" type="button">
							<i class="icon-ok bigger-110"></i> View Only
						</button>
						<button class="btn btn-success btn-pdf" type="button">
							<i class="icon-book bigger-110"></i> PDF
						</button>
					</div>
				</div>
				<input type="hidden" name="pdf" value="">
			</div>
			</div>

		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.page-content -->