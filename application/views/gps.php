<script src="http://192.168.12.250:8000/socket.io/socket.io.js"></script>
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

<div id="map_canvas" style="width:100%; height:80%"></div>
Lat &nbsp;&nbsp;&nbsp;: <span id="txt_lat"></span>
<br>
Long :<span id="txt_long"></span><br>
<?php
/*
------------------------------------js------------------------------------------------------
 */
?>
<script>
//<![CDATA[
var tampung_posisi = {
<?php 
	foreach($all_vehicle as $vehicle)
	{
		echo "marker_".$vehicle->gps_mobile_address.": { \n";
		echo "posisi: '', \n";
		echo "html: '', \n";
		echo "}, \n";
	}
?>
};
var filter = [];
var cek_marker = [];
var marker_array = [];
var z=1;
var markers={};
var marker="";
var boundaryPolygon1;
var boundaryPolygon2;
var geocoder = new google.maps.Geocoder();
var customIcons = {
<?php 
foreach($all_vehicle as $vehicle)
{
  echo "icon_mobil_".$vehicle->gps_mobile_address.": { \n";
  echo "icon: 'http://surabi.dev/assets/uploads/icon_".$vehicle->icon_id.".".$vehicle->image_type."' \n";
  echo "}, \n";
}
?>
};

var nama_mobil = {
<?php 
	foreach($all_vehicle as $vehicle)
	{
		echo "nama_mobil_".$vehicle->gps_mobile_address.": { \n";
		echo "nama: '".$vehicle->name."' \n";
		echo "}, \n";
	}
?>
};
google.maps.Polygon.prototype.Contains = function (point) {
    // ray casting alogrithm http://rosettacode.org/wiki/Ray-casting_algorithm
    var crossings = 0,
    path = this.getPath();

    // for each edge
    for (var i = 0; i < path.getLength(); i++) {
        var a = path.getAt(i),
        j = i + 1;
        if (j >= path.getLength()) {
            j = 0;
        }
        var b = path.getAt(j);
        if (rayCrossesSegment(point, a, b)) {
            crossings++;
        }
    }

    // odd number of crossings?
    return (crossings % 2 == 1);

    function rayCrossesSegment(point, a, b) {
        var px = point.lng(),
        py = point.lat(),
        ax = a.lng(),
        ay = a.lat(),
        bx = b.lng(),
        by = b.lat();
        if (ay > by) {
            ax = b.lng();
            ay = b.lat();
            bx = a.lng();
            by = a.lat();
        }
        if (py == ay || py == by) py += 0.00000001;
        if ((py > by || py < ay) || (px > Math.max(ax, bx))) return false;
        if (px < Math.min(ax, bx)) return true;

        var red = (ax != bx) ? ((by - ay) / (bx - ax)) : Infinity;
        var blue = (ax != px) ? ((py - ay) / (px - ax)) : Infinity;
        return (blue >= red);
    }
};

var map = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(-6.915499,107.594301),
    zoom: 13,
    scaleControl:true,
    mapTypeId: 'roadmap'
  });


                    <?php $i=0;
                     foreach($regions as $region) { 
						$i++;
                    	$latlng = explode(";", $region->latlng); ?>
var boundarydata<?php echo $i; ?> = [
                    		<?php foreach($latlng as $lat) {?>
    new google.maps.LatLng(<?php echo rm_brace($lat);?>),
							<?php } ?>
// 	new google.maps.LatLng(-6.9389091089626485, 107.60250091552734),
// 	new google.maps.LatLng(-6.937971885764778, 107.60687828063965),
// 	new google.maps.LatLng(-6.936672550518212, 107.60687828063965)
                  ];


                        boundaryPolygon<?php echo $i;?> = new google.maps.Polygon({
                            path: boundarydata<?php echo $i;?>,
                            strokeColor: "#0000FF",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: 'Yellow',
                            fillOpacity: 0.4

                        });

  boundaryPolygon<?php echo $i;?>.setMap(map);
							<?php 	}?>
  var infoWindow = new google.maps.InfoWindow;

// create a new websocket
    var socket = io.connect('http://192.168.12.250:8000');
    // on message received we print all the data inside the #container div
    socket.on('notification', function (data) {
		var data_map=data.data;
		
		var name = data_map["system"];
		var lat = data_map["lat"];
		var lng = data_map["lng"];
		
		var marker_id='marker_' + data_map["mobile"];
		var ada=jQuery.inArray( marker_id, filter );
		if(ada>=0)
		{
		var point = new google.maps.LatLng(lat, lng);
		geocoder.geocode({'latLng': point}, function(results, status) 
		{
			if (status == google.maps.GeocoderStatus.OK) 
			{
				if (results[0]) 
				{
					html2="<b> Location : Near "+results[0]["address_components"][0].short_name+"</b><br>";
				} 
				else 
				{
					html2="<b> Location : Unknow</b> <br/>";
				}
			} 
			else 
			{
				html2="<b> Location : Unknow</b> <br/>";
			}
		var html = "<div id='infowindow' style='height:100px;width:300px'><b> Name : "+nama_mobil["nama_mobil_"+data_map["mobile"]].nama+"</b> <br/>";
		if(data_map["packet_number"]=="100")
		{
			html2+="<b> Position : " + point + "</b> <br/><b> Time : " + data_map["tanggal"] + " " + data_map["jam"] + "</b> <br/><b> Speed : " + data_map["velocity"] + "km/h</b> <br/>";
		}
		if(data_map["packet_number"]=="104")
		{
			html2+="<b> Position : " + point + "</b> <br/><b> Time : " + data_map["tanggal"] + " " + data_map["jam"] + "</b> <br/><b> Speed : " + data_map["velocity"] + " &nbsp;km/h</b> <br/>";
		}
		html+=html2+"</div>";
		var icon = customIcons["icon_mobil_"+data_map["mobile"]] || {};
		if(jQuery.inArray( marker_id, cek_marker )>=0)
		{
			marker_array[marker_id].setMap(null);
		}
			marker = new google.maps.Marker({
			map: map,
			position: point,
			id: marker_id,
			icon: icon.icon
			});
			cek_marker.push(marker_id);
			markers[marker_id] = marker;
			bindInfoWindow(marker, map, infoWindow, html,marker_id);
			marker_array[marker_id]=marker;
			tampung_posisi["marker_"+data_map["mobile"]].posisi=point;
			tampung_posisi["marker_"+data_map["mobile"]].html=html;
		//------------------------------polygon---------------------------------------
		<?php 
		// for in region only
		$i=0;
		foreach($regions as $region) { 
		$i++;?>                       
		if (boundaryPolygon<?php echo $i;?>.Contains(point)) {
			alert("Sampai");
		} 		<?php } ?>
	  });
	  }
  });

function bindInfoWindow(marker, map, infoWindow, html,marker_id) {
  google.maps.event.addListener(marker, 'mouseover', function() {
    infoWindow.setContent(html);
    infoWindow.open(map, marker);
  });
}

function doNothing() {}

function add_filter(isi)
{
	
	var ada=jQuery.inArray( isi, filter );
	if(ada<0)filter.push(isi);
	add_marker(isi);
}

function remove_filter(isi)
{
	filter = jQuery.grep(filter, function(value) {
	return value != isi;
	});
	marker_array[isi].setMap(null);
}

google.maps.event.addListener(map, 'mousemove', function(event) {
	var latlong=event.latLng.toString().split(",");
	document.getElementById('txt_lat').innerHTML=latlong[0].substring(1);
	document.getElementById('txt_long').innerHTML=latlong[1].substring(0,latlong[1].length-1);
});


function add_marker(marker_id2)
{
		var point2=tampung_posisi[marker_id2].posisi;
		var html2=tampung_posisi[marker_id2].html;
		var icon_id=marker_id2.replace("marker_","icon_mobil_");
		var icon = customIcons[icon_id] || {};
		marker = new google.maps.Marker({
		map: map,
		position: point2,
		id: marker_id2,
		icon: icon.icon
		});
		cek_marker.push(marker_id2);
		markers[marker_id2] = marker;
		bindInfoWindow(marker, map, infoWindow, html2,marker_id2);
		marker_array[marker_id2]=marker;
}


//]]>

$('.cek').removeAttr('checked');

</script>