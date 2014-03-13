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
<!-- <div id="nodelist"> -->
<!--             <em>Click on the map to get feature info</em> -->
<!--         </div> -->
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
var popupContentHTML="";
var data_map="";
var name = "";
var lat = "";
var lng = "";
var marker_id="";
var markerClick="";

var geo_url = "<?php echo base_url_new()?>:8080/geoserver/tcm/wms" ;

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
			
		AutoSizeAnchored = OpenLayers.Class(OpenLayers.Popup.Anchored, {
            'autoSize': true
        });

        AutoSizeAnchoredMinSize = OpenLayers.Class(OpenLayers.Popup.Anchored, {
            'autoSize': true, 
            'minSize': new OpenLayers.Size(400,400)
        });

        AutoSizeAnchoredMaxSize = OpenLayers.Class(OpenLayers.Popup.Anchored, {
            'autoSize': true, 
            'maxSize': new OpenLayers.Size(100,100)
        });

        //framed

        //disable the autosize for the purpose of our matrix
        OpenLayers.Popup.FramedCloud.prototype.autoSize = false;

        AutoSizeFramedCloud = OpenLayers.Class(OpenLayers.Popup.FramedCloud, {
            'autoSize': true
        });

        AutoSizeFramedCloudMinSize = OpenLayers.Class(OpenLayers.Popup.FramedCloud, {
            'autoSize': true, 
            'minSize': new OpenLayers.Size(400,400)
        });

        AutoSizeFramedCloudMaxSize = OpenLayers.Class(OpenLayers.Popup.FramedCloud, {
            'autoSize': true, 
            'maxSize': new OpenLayers.Size(100,100)
        });
			
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
                    "Geoserver layers - Tiled", geo_url ,
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
                    "Geoserver layers - Untiled", geo_url,
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
                map.setCenter(new OpenLayers.LonLat('116.890', '-0.457'), 7 )
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

    var socket = io.connect('<?php echo base_url_new()?>:8000');
    // on message received we print all the data inside the #container div
    socket.on('notification', function (data) {
		data_map=data.data;
		if(data_map["packet_number"]=="104" || data_map["packet_number"]=="100")
		{
			name = data_map["system"];
			lat = data_map["lat"];
			lng = data_map["lng"];
		
			marker_id='marker_' + data_map["mobile"];
			var ada=jQuery.inArray( marker_id, filter );
			if(ada>=0)
			{
				if(jQuery.inArray( marker_id, cek_marker )>=0)
				{
					marker_layer.removeMarker(nama_marker["marker_"+data_map["mobile"]].nama);
				}
			
				var point2=new OpenLayers.LonLat(lng,lat);
				var pixel=map.getPixelFromLonLat(point2);
					
				//document.getElementById('nodelist').innerHTML = "Loading... please wait...";
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
                    OpenLayers.loadURL(geo_url, params, this, setHTML, setHTML);
					
				marker_layer.setZIndex( 1001 ); 
			}
		}
  });


function setHTML(response)
{
				response2=eval("(" + response.responseText + ")");
				$("#nodelist").html(response.responseText);
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
					if(response2.features.length>3)
					{
						jalan_tambang = JSON.stringify(response2.features[3].properties.NAME);
					}
					if(! jalan)jalan="";
					if(! jalan_tambang)jalan_tambang="";
					jalan=jalan.replace(/"/g,"");
					if(jalan!="")
					{
						jalan+="&nbsp;";
					}
					jalan_tambang=jalan_tambang.replace(/"/g,"");
					if(jalan_tambang!="")
					{
						jalan_tambang+="&nbsp;";
					}
					provinsi=provinsi.replace(/"/g,"");
					var lokasi=jalan_tambang+jalan+provinsi;
				
				popupContentHTML="<b>";
				popupContentHTML+="<table>";
				popupContentHTML+="<tr>";
				popupContentHTML+="		<td>Name</td>";
				popupContentHTML+="		<td>&nbsp;:</td>";
				popupContentHTML+="		<td>  &nbsp;&nbsp;"+nama_mobil["nama_mobil_"+data_map["mobile"]].nama+"</td>";
				popupContentHTML+="</tr>";
				popupContentHTML+="<tr>";
				popupContentHTML+="		<td>Location</td>";
				popupContentHTML+="		<td>&nbsp;:</td>";
				popupContentHTML+="		<td>&nbsp;&nbsp;"+lokasi+"</td>";
				popupContentHTML+="</tr>";
				popupContentHTML+="<tr>";
				popupContentHTML+="		<td>Position</td>";
				popupContentHTML+="		<td>&nbsp;:</td>";
				popupContentHTML+="		<td> &nbsp;&nbsp;"+lat+","+lng+"</td>";
				popupContentHTML+="</tr>";
				popupContentHTML+="		<td>Time</td>";
				popupContentHTML+="		<td>&nbsp;:</td>";
				popupContentHTML+="		<td> &nbsp;&nbsp;" + data_map["tanggal"] + " " + data_map["jam"]+"</td>";
				popupContentHTML+="<tr>";
				popupContentHTML+="<tr>";
				popupContentHTML+="		<td>Speed</td>";
				popupContentHTML+="		<td>&nbsp;:</td>";
				popupContentHTML+="		<td> &nbsp;&nbsp;" + data_map["velocity"] + "km/h</td>";
				popupContentHTML+="</tr>";
				popupContentHTML+="</table>";
				popupContentHTML+="</b>";
				var icon=new OpenLayers.Icon(customIcons["icon_mobil_"+data_map["mobile"]].icon);
			
			var point=new OpenLayers.LonLat(lng,lat);
			nama_marker["marker_"+data_map["mobile"]].nama=new OpenLayers.Marker(point,icon);
			
			ll = new OpenLayers.LonLat(-35,20);
            var popupClass = AutoSizeAnchored;
            
			popup_marker["popup_marker_"+data_map["mobile"]].popup = new OpenLayers.Feature(marker_layer, point); 
            popup_marker["popup_marker_"+data_map["mobile"]].popup.closeBox = true;
            popup_marker["popup_marker_"+data_map["mobile"]].popup.popupClass = popupClass;
            popup_marker["popup_marker_"+data_map["mobile"]].popup.data.popupContentHTML = popupContentHTML;
            markerClick = function (evt) {
                if (this.popup == null) {
                    this.popup = this.createPopup(this.closeBox);
                    map.addPopup(this.popup);
                    this.popup.show();
                } else {
                    this.popup.toggle();
                }
                currentPopup = this.popup;
                OpenLayers.Event.stop(evt);
            };
            nama_marker["marker_"+data_map["mobile"]].nama.events.register("mouseover", popup_marker["popup_marker_"+data_map["mobile"]].popup, markerClick);
			
			marker_layer.addMarker(nama_marker["marker_"+data_map["mobile"]].nama);
			var point_marker=new OpenLayers.Geometry.Point(lng,lat);
			cek_marker.push(marker_id);
			tampung_posisi["marker_"+data_map["mobile"]].posisi=point;
			var dalam=poly.containsPoint(point_marker);
			if(dalam)alert("Sampai");
};

function doNothing() {}




//]]>


</script>