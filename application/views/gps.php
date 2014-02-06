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
<script type="text/javascript">
    //<![CDATA[
	var filter = [];
	var cek_marker = [];
	var marker_array = [];
	var z=1;
	var markers={};
	var marker="";
	var geocoder = new google.maps.Geocoder();
    var customIcons = {
      00: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      01: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };

    var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(-6.915499,107.594301),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
	
	// create a new websocket
        var socket = io.connect('http://localhost:8000');
        // on message received we print all the data inside the #container div
        socket.on('notification', function (data) {
			var data_map=data.data;
			
			var name = data_map["system"];
			var lat = data_map["lat"];
			var lng = data_map["lng"];
			
			var marker_id='marker_' + name;
			var ada=jQuery.inArray( name, filter );
			if(ada>=0)
			{
			var point = new google.maps.LatLng(lat, lng);
			geocoder.geocode({'latLng': point}, function(results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK) 
				{
					if (results[1]) 
					{
						html2="<b> Location : Near "+results[1].formatted_address+"</b><br>";
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
			var html = "<div id='infowindow' style='height:100px;width:500px'><b> Name : " + name + "</b> <br/>";
			if(data_map["packet_number"]=="100")
			{
				html2+="<b> Time : " + data_map["jam"] + "</b> <br/><b> Date : " + data_map["tanggal"] + "</b> <br/><b> Speed : " + data_map["velocity"] + "km/h</b> <br/>";
			}
			if(data_map["packet_number"]=="104")
			{
				html2+="<b> Time : " + data_map["jam"] + "</b> <br/><b> Date : " + data_map["tanggal"] + "</b> <br/><b> Speed : " + data_map["velocity"] + " &nbsp;km/h</b> <br/>";
			}
			html+=html2+"</div>";
			var icon = customIcons[name] || {};
			if(jQuery.inArray( marker_id, cek_marker )<0)
			{
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
			}
			else
			{
				marker_array[marker_id].setMap(null);
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
			}
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
	}
	
	function remove_filter(isi)
	{
		filter = jQuery.grep(filter, function(value) {
		return value != isi;
		});
		marker_array["marker_"+isi].setMap(null);
	}
	
	google.maps.event.addListener(map, 'mousemove', function(event) {
		var latlong=event.latLng.toString().split(",");
		document.getElementById('txt_lat').innerHTML=latlong[0].substring(1);
		document.getElementById('txt_long').innerHTML=latlong[1].substring(0,latlong[1].length-1);
	});
	
	var removeMarker = function(marker, markerId) {
    marker.setMap(null); // set markers setMap to null to remove it from map
    delete markers[markerId]; // delete marker instance from markers object
	};
	
	function setAllMap(map) {
		for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
		}
	}

    //]]>
  </script>
<input type="checkbox" class="check" value="00" onclick="if(this.checked)add_filter(this.value);else remove_filter(this.value);"> 00  <br>
<div id="map_canvas" style="width:100%; height:80%"></div>
Lat &nbsp;&nbsp;&nbsp;: <span id="txt_lat"></span>
<br>
Long :<span id="txt_long"></span><br>
<script>
$('.check').removeAttr('checked');
</script>