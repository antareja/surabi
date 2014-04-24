<div class="row">
	<div class="space-6"></div>

	<div class="col-sm-7 infobox-container">
		<div class="infobox infobox-green  ">
			<div class="infobox-icon">
				<i class="icon-comments"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">32</span>
				<div class="infobox-content">message + 2 reviews</div>
			</div>
			<div class="stat stat-success">8%</div>
		</div>

		<div class="infobox infobox-red  ">
			<div class="infobox-icon">
				<i class="icon-fighter-jet"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">11</span>
				<div class="infobox-content">Speed Alert</div>
			</div>

			<div class="badge badge-success">
				+32% <i class="icon-arrow-up"></i>
			</div>
		</div>

		<div class="infobox infobox-pink  ">
			<div class="infobox-icon">
				<i class="icon-road"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">8</span>
				<div class="infobox-content">GeoFence Alert</div>
			</div>
			<div class="stat stat-important">4%</div>
		</div>

		<div class="infobox infobox-red  ">
			<div class="infobox-icon">
				<i class="icon-beaker"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">7</span>
				<div class="infobox-content">Application Issue</div>
			</div>
		</div>

		<div class="infobox infobox-orange2  ">
			<div class="infobox-chart">
				<span class="sparkline"
					data-values="196,128,202,177,154,94,100,170,224"></span>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">10</span>
				<div class="infobox-content">Active User</div>
			</div>

			<div class="badge badge-success">
				7.2% <i class="icon-arrow-up"></i>
			</div>
		</div>

		<div class="infobox infobox-blue2  ">
			<div class="infobox-progress">
				<div class="easy-pie-chart percentage" data-percent="42"
					data-size="46">
					<span class="percent">42</span>%
				</div>
			</div>

			<div class="infobox-data">
				<span class="infobox-text">Active Vehicle</span>

				<div class="infobox-content">
					<span class="bigger-110">~</span> 40 remaining
				</div>
			</div>
		</div>

		<div class="space-6"></div>

		<div class="infobox infobox-green infobox-small infobox-dark">
			<div class="infobox-progress">
				<div class="easy-pie-chart percentage" data-percent="61"
					data-size="39">
					<span class="percent">61</span>%
				</div>
			</div>

			<div class="infobox-data">
				<div class="infobox-content">Task</div>
				<div class="infobox-content">Completion</div>
			</div>
		</div>

		<div class="infobox infobox-blue infobox-small infobox-dark">
			<div class="infobox-chart">
				<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
			</div>

			<div class="infobox-data">
				<div class="infobox-content">Earnings</div>
				<div class="infobox-content">$32,000</div>
			</div>
		</div>

		<div class="infobox infobox-grey infobox-small infobox-dark">
			<div class="infobox-icon">
				<i class="icon-download-alt"></i>
			</div>

			<div class="infobox-data">
				<div class="infobox-content">PacketData</div>
				<div class="infobox-content">1,205</div>
			</div>
		</div>
	</div>

	<div class="vspace-sm"></div>

	<div class="col-sm-5">
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5>
					<i class="icon-signal"></i> Total Vehicle
				</h5>

				<div class="widget-toolbar no-border">
					<button class="btn btn-minier btn-primary dropdown-toggle"
						data-toggle="dropdown">
						This Week <i class="icon-angle-down icon-on-right bigger-110"></i>
					</button>

					<ul
						class="dropdown-menu pull-right dropdown-125 dropdown-lighter dropdown-caret">
						<li class="active"><a href="#" class="blue"> <i
								class="icon-caret-right bigger-110">&nbsp;</i> This Week
						</a></li>

						<li><a href="#"> <i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
								Last Week
						</a></li>

						<li><a href="#"> <i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
								This Month
						</a></li>

						<li><a href="#"> <i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
								Last Month
						</a></li>
					</ul>
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main">
					<div id="piechart-placeholder"></div>

					<div class="hr hr8 hr-double"></div>

					<div class="clearfix">
						<div class="grid3">
							<span class="grey"> <img alt="houl truck" width="50" src="<?php echo base_url()?>assets/images/vehicle/houl-truck.png">
								Haul
							</span>
							<h4 class="bigger pull-right">200</h4>
						</div>

						<div class="grid3">
							<span class="grey"> <img alt="houl truck" width="50" src="<?php echo base_url()?>assets/images/vehicle/dump_truck.png">
								Truck
							</span>
							<h4 class="bigger pull-right">50</h4>
						</div>

						<div class="grid3">
							<span class="grey"> <img alt="houl truck" width="50" src="<?php echo base_url()?>assets/images/vehicle/ranger.png">
								Ranger
							</span>
							<h4 class="bigger pull-right">70</h4>
						</div>
					</div>
				</div>
				<!-- /widget-main -->
			</div>
			<!-- /widget-body -->
		</div>
		<!-- /widget-box -->
	</div>
	<!-- /span -->
</div>
<!-- /row -->
<script>
//Chart
jQuery(function($) {
	$('.easy-pie-chart.percentage').each(function(){
		var $box = $(this).closest('.infobox');
		var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
		var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
		var size = parseInt($(this).data('size')) || 50;
		$(this).easyPieChart({
			barColor: barColor,
			trackColor: trackColor,
			scaleColor: false,
			lineCap: 'butt',
			lineWidth: parseInt(size/10),
			animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
			size: size
		});
	})
	
	$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
				});
	
	
	var placeholder = $('#piechart-placeholder').css({'width':'80%' , 'min-height':'120px'});
	var data = [
		{ label: "Houling",  data: 38.7, color: "#68BC31"},
		{ label: "Pickup",  data: 24.5, color: "#2091CF"},
		{ label: "Dump Truck",  data: 8.2, color: "#AF4E96"},
		{ label: "car",  data: 18.6, color: "#DA5430"},
		{ label: "other",  data: 10, color: "#FEE074"}
	]
	function drawPieChart(placeholder, data, position) {
		  $.plot(placeholder, data, {
			series: {
				pie: {
					show: true,
					tilt:0.8,
					highlight: {
						opacity: 0.25
					},
					stroke: {
						color: '#fff',
						width: 2
					},
					startAngle: 2
				}
			},
			legend: {
				show: true,
				position: position || "ne", 
				labelBoxBorderColor: null,
				margin:[-30,15]
			}
			,
			grid: {
				hoverable: true,
				clickable: true
			}
		 })
	}
	drawPieChart(placeholder, data);
	/**
	we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
	so that's not needed actually.
	*/
	placeholder.data('chart', data);
	placeholder.data('draw', drawPieChart);
	
	
	
	 var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
	 var previousPoint = null;
	
	 placeholder.on('plothover', function (event, pos, item) {
		if(item) {
			if (previousPoint != item.seriesIndex) {
				previousPoint = item.seriesIndex;
				var tip = item.series['label'] + " : " + item.series['percent']+'%';
				$tooltip.show().children(0).text(tip);
			}
			$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
		} else {
			$tooltip.hide();
			previousPoint = null;
		}
		
	});

});

</script>