<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>Full Screen Example</title>
<script
	src="<?php echo base_url()."assets/js/"?>OpenLayers/lib/OpenLayers.js"
	type="text/javascript"></script>
<script
	src="<?php echo base_url()."assets/js/"?>OpenLayers/lib/deprecated.js"
	type="text/javascript"></script>
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/js/OpenLayers/theme/default/style.css"
	type="text/css">
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/css/style2.css" type="text/css">
<style type="text/css">
html,body,#map {
	margin: 0;
	width: 100%;
	height: 100%;
}

#text {
	position: absolute;
	bottom: 1em;
	left: 1em;
	width: 512px;
	z-index: 20000;
	background-color: white;
	padding: 0 0.5em 0.5em 0.5em;
}
</style>
<script type="text/javascript">
        var geo_url = "<?php echo base_url_new()?>:8080/geoserver/tcm/wms" ;
        var lon =  115.748856;
        var lat = -0.486716;
        var zoom = 5;
        var map, layer;
        format = 'image/png';

        function init(){
            map = new OpenLayers.Map( 'map' );
            layer = new OpenLayers.Layer.WMS( "OpenLayers WMS",
            		geo_url, {LAYERS: 'tcm-layer_group',
                STYLES: '',
                format: format} );
            map.addLayer(layer);
			
            map.setCenter(new OpenLayers.LonLat(lon, lat), 13);
            map.addControl( new OpenLayers.Control.LayerSwitcher() );
        }
</script>
</head>
<body onload="init()">
	<div id="map" class="smallmap"></div>
</body>
</html>
