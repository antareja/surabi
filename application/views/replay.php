<style type="text/css">

#map_canvas {
	position: absolute;
	top: 50px;
	bottom: 0;
	left: 0;
	right: 0;
}
</style>
<script type="text/javascript"
	src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var map, path = new google.maps.MVCArray(), service = new google.maps.DirectionsService(), shiftPressed = false, poly,lineSymbol,x=0;

    google.maps.event.addDomListener(document, "keydown", function(e) { shiftPressed = e.shiftKey; });
    google.maps.event.addDomListener(document, "keyup", function(e) { shiftPressed = e.shiftKey; });
	
	var lineCoordinates = [
	   	<?php foreach ($replay as $row)  {?>
		new google.maps.LatLng(<?php echo $row->latitude ?>,<?php echo $row->longitude ?>),
		<?php } ?>
	/*
	*/
	];
		
    function Init() {
      var myOptions = {
        zoom: 17,
        center: new google.maps.LatLng(-6.915957,107.603508),
        scaleControl:true,
        draggable:false,
		zoomControl:false,
		scrollwheel: false, 
		disableDoubleClickZoom: true,
      }
	
	  
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	   
	   lineSymbol = {
			path: google.maps.SymbolPath.CIRCLE,
			scale: 8,
			strokeColor: '#393'
		};
	   
	   poly = new google.maps.Polyline({icons: [{
			icon: lineSymbol,
			offset: '100%'
		}], map: map });
		var z=1;	
		var interval=setInterval(function(){
		document.getElementById('button_coba').click();
		if(z==lineCoordinates.length)
		{
			clearInterval(interval);
			map.setOptions
			({
				draggable:true,
				zoomControl:true,
				scrollwheel: true, 
				disableDoubleClickZoom: false,
			});
		}
		z++;
		},5000);
    }
function add_poly() {
        if (shiftPressed || path.getLength() === 0) {
          path.push(lineCoordinates[x]);
		  if(path.getLength() === 1) {
			poly.setPath(path);
		  }
        } else {
          service.route({ origin: path.getAt(path.getLength() - 1), destination: lineCoordinates[x], travelMode: google.maps.DirectionsTravelMode.DRIVING }, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              for(var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
			    path.push(result.routes[0].overview_path[i]);
			  }
            }
          });
        }
	  x++;	
      };
function animateCircle() {
    var count = 0;
    window.setInterval(function() {
      count = (count + 1) % 200;

      var icons = poly.get('icons');
      icons[0].offset = (count / 2) + '%';
      poly.set('icons', icons);
  }, 100);
}
	window.onload = Init;
  </script>
  <div class="page-content">
	<div class="row">
		<div class="col-xs-12">
	<button onclick="animateCircle()">start</button>
	<button id="button_coba" onclick="add_poly()">coba</button>
	<div id="map_canvas" style="width:80%; height:800px"></div>
</div>
</div>
</div>