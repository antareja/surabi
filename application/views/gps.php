<script src="<?php echo base_url()."assets/js/"?>OpenLayers/lib/OpenLayers.js" type="text/javascript"></script>
<script src="<?php echo base_url()."assets/js/"?>OpenLayers/lib/deprecated.js" type="text/javascript"></script>
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
<div id="nodelist">
            <em>Click on the map to get feature info</em>
        </div>
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

var popup_marker = {
<?php 
foreach($all_vehicle as $vehicle)
{
  echo "popup_marker_".$vehicle->gps_mobile_address.": { \n";
  echo "popup: '' \n";
  echo "}, \n";
}
?>
};

var customIcons = {
<?php 
foreach($all_vehicle as $vehicle)
{
  echo "icon_mobil_".$vehicle->gps_mobile_address.": { \n";
  echo "icon: '".base_url()."assets/uploads/icon_".$vehicle->icon_id.".".$vehicle->image_type."' \n";
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

var nama_marker = {
<?php 
foreach($all_vehicle as $vehicle)
{
		echo "marker_".$vehicle->gps_mobile_address.": { \n";
		echo "nama: ''";
		echo "}, \n";
}
?>
};

			OpenLayers.ProxyHost = "<?php echo base_url()?>assets/python/proxy.cgi?url=";
            var map;
            var untiled;
            var tiled;
            // pink tile avoidance
            OpenLayers.IMAGE_RELOAD_ATTEMPTS = 5;
            // make OL compute scale according to WMS spec
            OpenLayers.DOTS_PER_INCH = 25.4 / 0.28;
        
            
                // if this is just a coverage or a group of them, disable a few items,
                // and default to jpeg format
                format = 'image/png';
                
            
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
                    "Geoserver layers - Tiled", "http://192.168.12.58:8080/geoserver/tcm/wms",
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
                    "Geoserver layers - Untiled", "http://192.168.12.58:8080/geoserver/tcm/wms",
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
                
				map.events.register("mousemove", map, function(e) {
					var position = map.getLonLatFromPixel(e.xy);
					OpenLayers.Util.getElement("txt_lat").innerHTML = position.lat.toFixed(3);
					OpenLayers.Util.getElement("txt_long").innerHTML = position.lon.toFixed(3);

				});
				
				var marker_layer = new OpenLayers.Layer.Markers( "Markers" );
				map.addLayer(marker_layer);
				var size = new OpenLayers.Size(21,25);
				
				var sitePoints = [];
					var siteStyle = 
					{
						strokeColor:"red", 
						strokeOpacity:"0.5",
						fillColor:"blue",
						fillOpacity:"0",
						// strokeWidth:3
					};
				var coordinates=[["116.870785","-0.427776"],["116.866665","-0.489572"],["116.924686","-0.495409"],["116.927776","-0.424686"]];
				
				var epsg4326 = new OpenLayers.Projection("EPSG:4326");
				for (var i=0;i<coordinates.length;i++) {
					var point = new OpenLayers.Geometry.Point(coordinates[i][0], coordinates[i][1]);
					// transform from WGS 1984 to Spherical Mercator
					point.transform(epsg4326, map.getProjectionObject());
					sitePoints.push(point);
				}
				sitePoints.push(sitePoints[0]);
				
				var vectors = new OpenLayers.Layer.Vector("poly");
				
				
				
				var linearRing = new OpenLayers.Geometry.LinearRing(sitePoints);
				var poly = new OpenLayers.Geometry.Polygon([linearRing]);
				var polygonFeature = new OpenLayers.Feature.Vector(poly, null, siteStyle);
				map.addLayer(vectors);
				vectors.addFeatures([polygonFeature]);

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
		if(jQuery.inArray( marker_id, cek_marker )>=0)
		{
			marker_layer.removeMarker(nama_marker["marker_"+data_map["mobile"]].nama);
		}
			
					var point2=new OpenLayers.LonLat(lng,lat);
					var pixel=map.getPixelFromLonLat(point2);
					
					document.getElementById('nodelist').innerHTML = "Loading... please wait...";
                    var params = {
                        REQUEST: "GetFeatureInfo",
                        EXCEPTIONS: "application/vnd.ogc.se_xml",
                        BBOX: map.getExtent().toBBOX(),
                        SERVICE: "WMS",
                        INFO_FORMAT: 'application/json',
                        QUERY_LAYERS: map.layers[0].params.LAYERS,
                        FEATURE_COUNT: 50,
                        Layers: 'tcm-layer_group',
                        WIDTH: map.size.w,
                        HEIGHT: map.size.h,
                        format: format,
                        styles: map.layers[0].params.STYLES,
                        srs: map.layers[0].params.SRS};
                    
                    // handle the wms 1.3 vs wms 1.1 madness
                    if(map.layers[0].params.VERSION == "1.3.0") {
                        params.version = "1.3.0";
                        params.j = parseInt(pixel.x);
                        params.i = parseInt(pixel.y);
                    } else {
                        params.version = "1.1.1";
                        params.x = parseInt(pixel.x);
                        params.y = parseInt(pixel.y);
                    }
                        
                    // merge filters
                    if(map.layers[0].params.CQL_FILTER != null) {
                        params.cql_filter = map.layers[0].params.CQL_FILTER;
                    } 
                    if(map.layers[0].params.FILTER != null) {
                        params.filter = map.layers[0].params.FILTER;
                    }
                    if(map.layers[0].params.FEATUREID) {
                        params.featureid = map.layers[0].params.FEATUREID;
                    }
                    OpenLayers.loadURL("http://localhost:8080/geoserver/tcm/wms", params, this, setHTML, setHTML);
			
			var icon=new OpenLayers.Icon(customIcons["icon_mobil_"+data_map["mobile"]].icon);
			var point=new OpenLayers.LonLat(lng,lat);
			nama_marker["marker_"+data_map["mobile"]].nama=new OpenLayers.Marker(point,icon);
			nama_marker["marker_"+data_map["mobile"]].nama.events.register('mouseover', nama_marker["marker_"+data_map["mobile"]].nama, function(evt) {
			alert("xxx");
			});
			nama_marker["marker_"+data_map["mobile"]].nama.events.register('mouseout', nama_marker["marker_"+data_map["mobile"]].nama, function(evt) {popup.hide();});
			marker_layer.addMarker(nama_marker["marker_"+data_map["mobile"]].nama);
			var point_marker=new OpenLayers.Geometry.Point(lng,lat);
			var dalam=poly.containsPoint(point_marker);
			if(dalam)alert("Sampai");
			cek_marker.push(marker_id);
			tampung_posisi["marker_"+data_map["mobile"]].posisi=point;
	  }
  });


function setHTML(response){
				response2=eval("(" + response.responseText + ")");
                var provinsi = "";
                var jalan =  "";
                var jalan_tambang = "";
                
				provinsi = JSON.stringify(response2.features[0].properties.PROV);
                if(response2.features.length>1)
				{
					jalan =  JSON.stringify(response2.features[1].properties.name);
				}
                if(response2.features.length>2)
                {
					jalan_tambang = JSON.stringify(response2.features[2].properties.NAME);
				}
				if(! jalan)jalan="";
				if(! jalan_tambang)jalan_tambang="";
				jalan=jalan.replace(/"/g,"")+"&nbsp;";
				jalan_tambang=jalan_tambang.replace(/"/g,"")+"&nbsp;";
				provinsi=provinsi.replace(/"/g,"")+"&nbsp;";
				var lokasi=jalan_tambang+jalan+provinsi;
				document.getElementById('nodelist').innerHTML=lokasi;
            };

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
	marker_layer.removeMarker(nama_marker[isi].nama);
}


function add_marker(isi)
{
	isi2=isi.replace("marker_","");
	var icon2=new OpenLayers.Icon(customIcons["icon_mobil_"+isi2].icon);
	var point2=tampung_posisi[isi].posisi;
	marker_layer.addMarker(nama_marker[isi].nama=new OpenLayers.Marker(point2,icon2));
	
}


//]]>

$('.cek').removeAttr('checked');

</script>