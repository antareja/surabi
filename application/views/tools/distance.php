<!DOCTYPE html>
<html>
<head>
<title><?php echo $pageTitle;?></title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Simple markers</title>
<style>
html,body,#map-canvas {
	width: 500px;
	height: 400px;
	padding: 0px;
	height: 400px;
}
</style>
<script
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry"></script>
<script src="<?php echo base_url()?>assets/js/OpenLayers/OpenLayers.js"></script>
<script>
var lat1 = -0.47171315382621;
var lng1 = 115.72020039136;
var lat2 = -0.47175;
var lng2 = 115.72;

var point1 = new OpenLayers.Geometry.Point(lat1,lng1);
var point2 = new OpenLayers.Geometry.Point(lat2,lng2);

var line = new OpenLayers.Geometry.LineString([point1, point2]);

var Mercator = new OpenLayers.Projection("EPSG:900913");
var Geographic = new OpenLayers.Projection("EPSG:4326");
alert('OpernLayers '+line.getGeodesicLength(Geographic));




//Server Jumbo
var p1 = new google.maps.LatLng(lat1,lng1);

// office IT adong 
//var p2 = new google.maps.LatLng(-0.576131666666666, 115.71075666666667);

// last detect area to mess bunyut
//var p2 = new google.maps.LatLng(-0.5124583333333333,115.71324666666666);


var p2 = new google.maps.LatLng(lat2,lng2);


alert('GoogleMaps '+calcDistance(p1, p2));

function initialize() {
  var myLatlng = new google.maps.LatLng(<?php echo $lat.','.$lng?>);
  var mapOptions = {
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  google.maps.event.addListener(map, 'mousemove', function(event) {
		var latlong=event.latLng.toString().split(",");
		document.getElementById('latspan').innerHTML=latlong[0].substring(1);
		document.getElementById('lngspan').innerHTML=latlong[1].substring(0,latlong[1].length-1);
		document.getElementById('latlong').innerHTML = event.latLng.lat() + ', ' + event.latLng.lng();
	});


  // click location and get lat lng
  google.maps.event.addListener(map,'click',function(event) {
		document.getElementById('latlongclicked').value = event.latLng.lat() + ', ' + event.latLng.lng()
	})
		
//   var marker = new google.maps.Marker({
//       position: myLatlng,
//       map: map,
//       title: 'Hello World!'
//   });

	var locations = [
	                 ['Default', <?php echo $lat.','.$lng?>, 1],
	                 ['MessRoom5a', <?php echo nmea_conv('0019.31791','11551.38884')?>, 2],
	                 ['MessRoom5b', <?php echo nmea_conv('0019.31810','11551.38892')?>, 3],
	                 ['MessRoom5c', <?php echo nmea_conv('0019.31829','11551.38898')?>, 4],
	                 ['MessRoom5d', <?php echo nmea_conv('0019.31839','11551.38907')?>, 5],
	                 ['MessRoom5e', <?php echo nmea_conv('0019.31858','11551.38933')?>, 6],
// 	                 ['MessRoom5', -0.321965,115.85650283333, 2],
// 	                 ['MessRoom52', -0.32197633333333,115.85648883333, 3],
	                 ['Bunyut Shelter', -0.320576,115.849947, 7],
	                 ['Bunyut Repeater', -0.319228333333333,115.022428333333, 8]
	               ];
	var infowindow = new google.maps.InfoWindow();
	var marker, i;

  for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map
    });

    // click location and get lat lng
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
  }
  
}

google.maps.event.addDomListener(window, 'load', initialize);




//calculates distance between two points in km's
function calcDistance(p1, p2){
  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) ).toFixed(2);
}
// var rad = function(x) {
// 	  return x * Math.PI / 180;
// 	};

// 	var getDistance = function (p1, p2) {
// 	  var R = 6378137; // Earth’s mean radius in meter
// 	  var dLat = rad(p2.lat() - p1.lat());
// 	  var dLong = rad(p2.lng() - p1.lng());
// 	  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
// 	    Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
// 	    Math.sin(dLong / 2) * Math.sin(dLong / 2);
// 	  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
// 	  var d = R * c;
// 	  return d; // returns the distance in meter
// 	};

// 	function calcDistance(p1, p2) {
// 		  var R = 6378137; // Earth’s mean radius in meter
// 		  var dLat = rad(p2.lat() - p1.lat());
// 		  var dLong = rad(p2.lng() - p1.lng());
// 		  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
// 		    Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
// 		    Math.sin(dLong / 2) * Math.sin(dLong / 2);
// 		  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
// 		  var d = R * c;
// 		  return d; // returns the distance in meter
// 		};
// 	var distance =  calcDistance('-0.5794216666666667,115.70552', '-0.576131666666666, 115.71075666666667');
// 	alert(distance);
</script>
</head>
<body>
	<p>Lat : <?php echo $lat?></p>
	<p>Lng : <?php echo $lng?></p>
	<div id="map-canvas"></div>
	<div class="eventtext">
		<div>
			Lattitude: <span id="latspan"></span>
		</div>

		<div>
			Longitude: <span id="lngspan"></span>
		</div>
		<div>
			Lat Lng: <span id="latlong"></span>
		</div>
		<div>
			Lat Lng on click: <input type="text" id="latlongclicked" size="50"></span>
		</div>
	</div>
	</div>
</body>
</html>