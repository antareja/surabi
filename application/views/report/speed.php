<script>
$(function(){
    // bind change event to select
    $('#speed').bind('change', function () {
    	mobile_address = '<?php echo $mobile_address;?>';
    	begin = <?php echo $begin;?>;
    	end = <?php echo $end;?>;
        speed = $(this).val(); // get selected value
        url = "<?php echo site_url();?>report/speed_limit/" + mobile_address + '/' + begin + "/" + end + '/' + speed;
        if (speed) { // require a URL
            //alert(url);
            window.location = url; // redirect
        }
        return false;
    });
  });
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
		date = parseDate($("input[name='date']").val());
		window.location = "<?php echo site_url();?>replay/replay2/" + mobile_address + "/" + date ;
	});
});
</script>
<div class="page-content">
	<div class="page-header">
		<h1><?php echo $pageTitle;?></h1>
	</div>
	<form action="<?php echo site_url()?>report/<?php echo $this->uri->segment(2)?>/pdf" id="pdf_report" target="_blank" method="POST" >
		<input type="hidden" name="begin" value="<?php echo !empty($begin) ? $begin : ''?>">
		<input type="hidden" name="end" value="<?php echo !empty($end) ? $end : ''?>">
		<input type="hidden" name="vehicle" value="<?php echo !empty($vehicle) ? $vehicle : ''?>">
		<input type="hidden" name='mobile_address' value="<?php echo $vehicle;?>">
		<input type="hidden" name="pdf" value="1">
		<select id="speed" name="speed">
			<option value="20" <?php echo $speed =='20'? 'selected':''?>>20-40</option>
			<option value="50" <?php echo $speed =='50'? 'selected':''?>>50-60</option>
			<option value="60" <?php echo $speed =='60'? 'selected':''?>>60-65</option>
			<option value="65" <?php echo $speed =='65'? 'selected':''?>>65-70</option>
			<option value="70" <?php echo $speed =='70'? 'selected':''?>>70-120</option>
		</select>
	<h4>View PDF : <img onclick="pdf_report.submit()" src="<?php base_url()?>/assets/img/pdf.png"
		style="cursor: pointer"></h4>
	</form>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-header">Results for "Latest Vehicle Fleet Status"</div>
			<div class="table-responsive">
				<table id="sample-table-2"
					class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<?php foreach($headers as $header) {?>
							<th><?php echo $header?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php  foreach ($report as $row) { ?>
							<?php echo $row."\r\n"?>
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