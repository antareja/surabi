<?php 
if(isset($data_replay)) { ?>
<script>
$(function(){
    // bind change event to select
    $('#time').bind('change', function () {
    	mobile_address = '<?php echo $mobile_address;?>';
    	unix = <?php echo $unix;?>;
        time = $(this).val(); // get selected value
        url = "<?php echo site_url();?>replay/replay2/" + mobile_address + '/' + unix + '/' + time;
        if (time) { // require a URL
            //alert(url);
            window.location = url; // redirect
        }
        return false;
    });
  });
</script>
<?php 
	if($data_replay->num_rows() > 0) {
?>
<script type="text/javascript">
var array_waktu = {
		<?php
	$x = 1;
	foreach ($data_replay->result() as $replay) {
// 		print_r($replay);exit;
		$jam_replay = explode(".", $replay->create_at)[0];
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $jam_replay);
		if ($x == 1) {
			$jam_awal = $date->format('H:i:s');
		}
		if ($x == count($data_replay)) {
			$jam_akhir = $date->format('H:i:s');
		}
		?>
"<?php echo $x?>": { 
			jam: '<?php echo $date->format('H:i:s')?>', 
			lat: '<?php echo $replay->latitude?>', 
			lng: '<?php echo $replay->longitude?>',
			velocity: '<?php echo $replay->velocity?>',
			bearing: '<?php echo $replay->bearing?>',
			location: '<?php echo $replay->location?>',
			icon_id: '<?php echo $replay->icon_id?>',
			image_type: '<?php echo $replay->image_type?>',
		},
		<?php
		$x ++;
	}
	?>
	};

	var ke=1;
	var size = "";
	var icon = "";
	var point = "";	
	var marker_layer = "";
	var marker = "";
	var timer="1000";
	var detik="<?php echo explode(":", $jam_awal)[2]?>";
	var menit="<?php echo explode(":", $jam_awal)[1]?>";
	var jam="<?php echo explode(":", $jam_awal)[0]?>";
	var myVar="";

    var map;
    var untiled;
    var tiled;
    var pureCoverage = false;
	var vectors = new OpenLayers.Layer.Vector("poly");
    // pink tile avoidance
    OpenLayers.IMAGE_RELOAD_ATTEMPTS = 5;
    // make OL compute scale according to WMS spec
    OpenLayers.DOTS_PER_INCH = 25.4 / 0.28;

    function Init(){
        // if this is just a coverage or a group of them, disable a few items,
        // and default to jpeg format
        format = 'image/png';
        if(pureCoverage) {
            document.getElementById('filterType').disabled = true;
            document.getElementById('filter').disabled = true;
            document.getElementById('antialiasSelector').disabled = true;
            document.getElementById('updateFilterButton').disabled = true;
            document.getElementById('resetFilterButton').disabled = true;
            document.getElementById('jpeg').selected = true;
            format = "image/jpeg";
        }
    
        var bounds = new OpenLayers.Bounds(
            95.0323145, -10.997406989999973,
            141.6132016, 5.906884230000038
        );
        var options = {
            controls: [],
            maxExtent: bounds,
            maxResolution: 0.181956590234375,
            projection: "EPSG:4326",
            units: 'degrees'
        };
        map = new OpenLayers.Map('map', options);
    
        // setup tiled layer
        tiled = new OpenLayers.Layer.WMS(
            "Geoserver layers - Tiled", "<?php echo base_url_new()?>:8080/geoserver/tcm/wms",
            {
                LAYERS: 'tcm-layer_group',
                STYLES: '',
                format: format,
                tiled: true,
                tilesOrigin : map.maxExtent.left + ',' + map.maxExtent.bottom
            },
            {
                buffer: 0,
                displayOutsideMaxExtent: true,
                isBaseLayer: true,
                yx : {'EPSG:4326' : true}
            } 
        );
    
        // setup single tiled layer
        untiled = new OpenLayers.Layer.WMS(
            "Geoserver layers - Untiled", "<?php echo base_url_new()?>:8080/geoserver/tcm/wms",
            {
                LAYERS: 'tcm-layer_group',
                STYLES: '',
                format: format
            },
            {
               singleTile: true, 
               ratio: 1, 
               isBaseLayer: true,
               yx : {'EPSG:4326' : true}
            } 
        );

        map.addLayers([untiled, tiled]);

        // build up all controls
        map.addControl(new OpenLayers.Control.PanZoomBar({
            position: new OpenLayers.Pixel(2, 15)
        }));
        map.addControl(new OpenLayers.Control.Navigation());
        map.addControl(new OpenLayers.Control.Scale($('scale')));
        map.addControl(new OpenLayers.Control.MousePosition({element: $('location')}));
        map.zoomToExtent(bounds);
        map.setCenter(new OpenLayers.LonLat(centerLng, centerLat), 7 )
        
        // wire up the option button
        var options = document.getElementById("options");
        
	size = new OpenLayers.Size(21,25);
	icon = new OpenLayers.Icon("<?php echo base_url()?>assets/uploads/icon_"+array_waktu["1"].icon_id+"."+array_waktu["1"].image_type, size);
//------------------------------deklarasi awal------------------------------------	
	point=new OpenLayers.LonLat(array_waktu["1"].lng,array_waktu["1"].lat);	
	$("#span_jam").html(array_waktu["1"].jam);
	$("#span_location").html("("+array_waktu["1"].lng+","+array_waktu["1"].lat+")");
	$("#span_velocity").html(array_waktu["1"].velocity);
	$("#span_bearing").html(array_waktu["1"].bearing);
//---------------------------------------------------------------------------------
	marker_layer = new OpenLayers.Layer.Markers( "Markers" );	
	marker=new OpenLayers.Marker(point,icon);
	map.addLayer(marker_layer);
	marker_layer.addMarker(marker);
	
	}
    // sets the HTML provided into the nodelist element
	
	function setHTML(response){
        document.getElementById('nodelist').innerHTML = response.responseText;
    };
	
	function myTimer()
	{
		ke++;
		detik++;
		if(detik<10)detik="0"+detik;
		if(detik==60)
		{
			menit++;
			if(menit<10)menit="0"+menit;
			detik="00";
		}
		if(menit==60)
		{
			jam++;
			if(jam<10)jam="0"+jam;
			menit="00";
		}
		if(jam==24)jam="00";
		var waktu=jam+":"+menit+":"+detik;
		document.getElementById("jam").innerHTML=waktu;
			point=new OpenLayers.LonLat(array_waktu[ke].lng,array_waktu[ke].lat);	
			marker_layer.removeMarker(marker);
			marker=new OpenLayers.Marker(point,icon);
			marker_layer.addMarker(marker);
//------------------------------update lokasi------------------------------------	
			$("#span_jam").html(array_waktu[ke].jam);
			$("#span_location").html("("+array_waktu[ke].lng+","+array_waktu["1"].lat+")");
			$("#span_velocity").html(array_waktu[ke].velocity);
			$("#span_bearing").html(array_waktu[ke].bearing);
//---------------------------------------------------------------------------------
			if(ke=="<?php echo count($data_replay)?>")
			{
				clearInterval(myVar);
			}
	}
	
	function resume(id_button)
	{
		$("#"+id_button).attr({"onclick":"pause(this.id)","class":"pause"});
		myVar=setInterval(function(){myTimer()},timer);
		myTimer();
	}
	
	function pause(id_button)
	{	
		$("#"+id_button).attr({"onclick":"resume(this.id)","class":"resume"});
		clearInterval(myVar);
	}
	
	function stop()
	{
		$("#start_pause").attr({"onclick":"start(this.id)","class":"start"});
		clearInterval(myVar);
		detik="<?php echo explode(":", $jam_awal)[2]?>";
		menit="<?php echo explode(":", $jam_awal)[1]?>";
		jam="<?php echo explode(":", $jam_awal)[0]?>";
		var waktu=jam+":"+menit+":"+detik;
		document.getElementById("jam").innerHTML=waktu;

		point=new OpenLayers.LonLat(array_waktu["1"].lng,array_waktu["1"].lat);	
		$("#span_jam").html(array_waktu["1"].jam);
		$("#span_location").html("("+array_waktu["1"].lng+","+array_waktu["1"].lat+")");
		$("#span_velocity").html(array_waktu["1"].velocity);
		$("#span_bearing").html(array_waktu["1"].bearing);
		
		marker_layer.removeMarker(marker);
		marker=new OpenLayers.Marker(point,icon);
		marker_layer.addMarker(marker);
	}
	
	function start(id_button)
	{
		timer=1000;
		$("#"+id_button).attr({"onclick":"pause(this.id)","class":"pause"});
		clearInterval(myVar);
		ke=1;
		detik="<?php echo explode(":", $jam_awal)[2]?>";
		menit="<?php echo explode(":", $jam_awal)[1]?>";
		jam="<?php echo explode(":", $jam_awal)[0]?>";
		myVar=setInterval(function(){myTimer()},timer);
		myTimer();
	}

	function faster()
	{
		if(timer>100)
		{
			timer=parseInt(timer)-100;
			clearInterval(myVar);
			myVar=setInterval(function(){myTimer()},timer);
		}	
	}

	function slower()
	{
		if(timer<5000)
		{
			timer=parseInt(timer)+100;
			clearInterval(myVar);
			myVar=setInterval(function(){myTimer()},timer);
		}
	}

	function normal()
	{
		timer=1000;
		clearInterval(myVar);
		myVar=setInterval(function(){myTimer()},timer);
	}
	window.onload = Init;
  </script>
<style>
.resume {
	width: 32px;
	height: 32px;
	background: url('<?php base_url()?>/assets/img/resume.png');
}

.start {
	width: 32px;
	height: 32px;
	background: url('<?php base_url()?>/assets/img/play.png');
}

.pause {
	width: 32px;
	height: 32px;
	background: url('<?php base_url()?>/assets/img/pause.png');
}

.stop {
	width: 32px;
	height: 32px;
	background: url('<?php base_url()?>/assets/img/stop.png');
}
</style>
<?php
} else { ?>
<div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert">
					<i class="icon-remove"></i>
				</button>
				<i class="icon-ok green"></i> Data Pada <strong class="green">Tanggal <?php echo unixf($unix)?> Jam 
				<?php echo $time?>
				</strong> , Tidak Tersedia Silahkan Coba Waktu yang Lain
			</div>
<?php }

}?>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
		
<?php 
if(!isset($data_replay))
{
?>
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
		date = parseDate($("input[name='date']").val());
		window.location = "<?php echo site_url();?>replay/replay2/" + mobile_address + "/" + date ;
	});
});
</script>
<br>
			<div class="form-horizontal"/> 

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="mobile_address"> Vehicle </label>
				<div class="col-sm-9">
					<select name="mobile_address" id="mobile_address">	
					<?php 
					foreach($allvehicle as $vehicle)
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
				<label class="col-sm-3 control-label no-padding-right" for="tanggal">
					Tanggal </label>
				<div class="col-sm-9">
					<input type="text" name="date" id="date-picker" value="">
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="submit btn btn-info">Submit</button> &nbsp;
					&nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i> Reset
					</button>
				</div>
			</div>
			</div>
<?php
} 
if(isset($data_replay))
{
?>
	<input type="hidden" name='mobile_address' value="<?php echo $mobile_address;?>">
	<input type="hidden" name='date' value="<?php echo $unix;?>">
	<input type="button" id="stop" onclick="stop()" class="stop" value="" />
	<input type="button" id="start_pause" onclick="start(this.id)"
				class="start" value="" /> <input type="button" id="slower"
				onclick="slower()" value="<<"/>
	<input   type="button" id="faster"
				onclick="faster()" value=">>" /> <input type="button" id="normal"
				onclick="normal()" value="Reset" />
	<select id="time" name="time">
		<option value="7"  <?php echo $time =='7'? 'selected':''?>>07-11</option>
		<option value="11" <?php echo $time =='11'? 'selected':''?>>11-15</option>
		<option value="15" <?php echo $time =='15'? 'selected':''?>>15-19</option>
		<option value="19" <?php echo $time =='19'? 'selected':''?>>19-23</option>
	</select>			
			<p id="jam" style="display: none"></p>
			<div id="map" style="width: 80%; height: 300px"></div>
			<div>
				<table>
					<tr>
						<td>Jam</td>
						<td>:</td>
						<td><span id="span_jam"></span></td>
					</tr>
					<tr>
						<td>Location</td>
						<td>:</td>
						<td><span id="span_location"></span></td>
					</tr>
					<tr>
						<td>Velocity</td>
						<td>:</td>
						<td><span id="span_velocity"></span></td>
					</tr>
					<tr>
						<td>Bearing</td>
						<td>:</td>
						<td><span id="span_bearing"></span></td>
					</tr>
				</table>
			</div>
<?php 
}?>
</div>
	</div>
</div>