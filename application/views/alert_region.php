<script type="text/javascript">
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
                    	var boundaryPolygon<?php echo $region->region_id;?>;
var boundarydata<?php echo $region->region_id; ?> = [
                    		<?php foreach($latlng as $lat) {?>
    new google.maps.LatLng(<?php echo rm_brace($lat);?>),
							<?php } ?>
                  ];
                        boundaryPolygon<?php echo $region->region_id;?> = new google.maps.Polygon({
                            path: boundarydata<?php echo $region->region_id;?>,
                            strokeColor: "#0000FF",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: 'Yellow',
                            fillOpacity: 0.4

                        });

  boundaryPolygon<?php echo $region->region_id;?>.setMap(map);
							<?php 	}?>
  var infoWindow = new google.maps.InfoWindow;
  <?php 
  $i=0;
	foreach($regions as $region) { ?>        
		var point = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);               
		if (boundaryPolygon<?php echo $region->region_id;?>.Contains(point)) {
			alert("Sampai");
			$.post( "<?php echo site_url();?>packet/region_alert", { packet_id: "2131", region_id: <?php echo $region->region_id?> } );
		} 		
	<?php } ?>
  </script>