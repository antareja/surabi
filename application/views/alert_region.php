<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
</head>
<body>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	
<div id="map" style="width: 100%; height: 400px"></div>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
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
    center: new google.maps.LatLng(<?php echo $lat;?>,<?php echo $lng;?>),
    zoom: 12,
    scaleControl:true,
    mapTypeId: 'roadmap'
  });


var myLatlng = new google.maps.LatLng(<?php echo $lat;?>,<?php echo $lng;?>);

var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title: 'Hello World!'
});

                    <?php $i=0;
						$i++;
                    	$latlng = explode(";", $polygon); 
                    	//$clean_lat = remove_bracket($latlng);
                    	foreach ($clean_lat as &$array) {
							$ex_array =  explode(',', $array);
							$array =  $ex_array[1].','.$ex_array[0];
// 							foreach($ex_array as &$ex_r) {
// 								echo $ex_r;
// 							}	
						}
                    	//print_r(polygon_reverse($region->latlng));exit?>
                    	var boundaryPolygon;
var boundarydata = [
                    		<?php foreach(polygon_reverse($region->latlng) as $lats) {
                    		$lnglat = rm_brace($lats);
                    		//print_r('test'.$lnglat);exit;?>
    new google.maps.LatLng(<?php echo $lats;?>),
							<?php } ?>
                  ];
                        boundaryPolygon = new google.maps.Polygon({
                            path: boundarydata,
                            strokeColor: "#0000FF",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: 'Yellow',
                            fillOpacity: 0.4

                        });

  boundaryPolygon.setMap(map);
  var infoWindow = new google.maps.InfoWindow;
		var point = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);               
		if (<?php echo $region->in_out == 'out' ? '!':''?>boundaryPolygon.Contains(point)) {
			 alert("<?php echo $region->in_out?> Area");
			$.post( "<?php echo site_url();?>packet/region_alert",
// 				 { 
				packet_id: <?php echo $packet_id;?>, 
				region_id: <?php echo $region->region_id?> 
// 				} ) .done(function( data ) {
// 					// alert( "Data Loaded: " + data );
// 				});
		} 		
</script>
test<?php echo $lat;?> 
</body>
</html>