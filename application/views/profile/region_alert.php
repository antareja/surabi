<link rel="stylesheet" type="text/css"
	href="<?php echo base_url_new();?>:8080/geoserver/openlayers/theme/default/style.css" />
<!-- Basic CSS definitions -->
<style type="text/css">
/* General settings */
body {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: small;
}
/* Toolbar styles */
#toolbar {
	position: relative;
	padding-bottom: 0.5em;
	display: none;
}

#toolbar ul {
	list-style: none;
	padding: 0;
	margin: 0;
}

#toolbar ul li {
	float: left;
	padding-right: 1em;
	padding-bottom: 0.5em;
}

#toolbar ul li a {
	font-weight: bold;
	font-size: smaller;
	vertical-align: middle;
	color: black;
	text-decoration: none;
}

#toolbar ul li a:hover {
	text-decoration: underline;
}

#toolbar ul li * {
	vertical-align: middle;
}

/* The map and the location bar */
#map {
	clear: both;
	position: relative;
	width: 909px;
	height: 330px;
	border: 1px solid black;
}

#wrapper {
	width: 909px;
}

#location {
	float: right;
}

#options {
	position: absolute;
	left: 13px;
	top: 7px;
	z-index: 3000;
}

/* Styles used by the default GetFeatureInfo output, added to make IE happy */
table.featureInfo,table.featureInfo td,table.featureInfo th {
	border: 1px solid #ddd;
	border-collapse: collapse;
	margin: 0;
	padding: 0;
	font-size: 90%;
	padding: .2em .1em;
}

table.featureInfo th {
	padding: .2em .2em;
	font-weight: bold;
	background: #eee;
}

table.featureInfo td {
	background: #fff;
}

table.featureInfo tr.odd td {
	background: #eee;
}

table.featureInfo caption {
	text-align: left;
	font-size: 100%;
	font-weight: bold;
	padding: .2em .2em;
}
</style>
<script defer="defer" type="text/javascript">
            var map;
            var untiled;
            var tiled;
            var pureCoverage = false;
			var vectors = new OpenLayers.Layer.Vector("poly");
			var geo_url = "<?php echo base_url_new()?>:8080/geoserver/tcm/wms" ;
            // pink tile avoidance
            OpenLayers.IMAGE_RELOAD_ATTEMPTS = 5;
            // make OL compute scale according to WMS spec
            OpenLayers.DOTS_PER_INCH = 25.4 / 0.28;


            	
            
            function init(){
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
                    "Geoserver layers - Tiled", geo_url,
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

             // Set Polygon
                <?php if(isset($region)) {?>
                var sitePoints = [];
    					var siteStyle = 
    					{
    						strokeColor:"yellow", 
    						strokeOpacity:"0.5",
    						fillColor:"blue",
    						fillOpacity:"0",
    						// strokeWidth:3
    					};

    				var coordinates=[<?php echo string_to_bracket($region->latlng);?>];
    				
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
    			<?php }?>
        
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
                // wire up the option button
                var options = document.getElementById("options");
                options.onclick = toggleControlPanel;
                
			var line_control=new OpenLayers.Control.DrawFeature(vectors,OpenLayers.Handler.Path);
			map.addControl(line_control);
			line_control.activate();
			}
            function del(){
                map.removeLayer(vectors);
            };
            // sets the HTML provided into the nodelist element
			
			function setHTML(response){
                document.getElementById('nodelist').innerHTML = response.responseText;
            };
            
            // shows/hide the control panel
            function toggleControlPanel(event){
                var toolbar = document.getElementById("toolbar");
                if (toolbar.style.display == "none") {
                    toolbar.style.display = "block";
                }
                else {
                    toolbar.style.display = "none";
                }
                event.stopPropagation();
                map.updateSize()
            }
            
            // Tiling mode, can be 'tiled' or 'untiled'
            function setTileMode(tilingMode){
                if (tilingMode == 'tiled') {
                    untiled.setVisibility(false);
                    tiled.setVisibility(true);
                    map.setBaseLayer(tiled);
                }
                else {
                    untiled.setVisibility(true);
                    tiled.setVisibility(false);
                    map.setBaseLayer(untiled);
                }
            }
            
            // Transition effect, can be null or 'resize'
            function setTransitionMode(transitionEffect){
                if (transitionEffect === 'resize') {
                    tiled.transitionEffect = transitionEffect;
                    untiled.transitionEffect = transitionEffect;
                }
                else {
                    tiled.transitionEffect = null;
                    untiled.transitionEffect = null;
                }
            }
            
            // changes the current tile format
            function setImageFormat(mime){
                // we may be switching format on setup
                if(tiled == null)
                  return;
                  
                tiled.mergeNewParams({
                    format: mime
                });
                untiled.mergeNewParams({
                    format: mime
                });
                /*
                var paletteSelector = document.getElementById('paletteSelector')
                if (mime == 'image/jpeg') {
                    paletteSelector.selectedIndex = 0;
                    setPalette('');
                    paletteSelector.disabled = true;
                }
                else {
                    paletteSelector.disabled = false;
                }
                */
            }
            
            // sets the chosen style
            function setStyle(style){
                // we may be switching style on setup
                if(tiled == null)
                  return;
                  
                tiled.mergeNewParams({
                    styles: style
                });
                untiled.mergeNewParams({
                    styles: style
                });
            }
            
            // sets the chosen WMS version
            function setWMSVersion(wmsVersion){
                // we may be switching style on setup
                if(wmsVersion == null)
                  return;
                  
                if(wmsVersion == "1.3.0") {
                   origin = map.maxExtent.bottom + ',' + map.maxExtent.left;
                } else {
                   origin = map.maxExtent.left + ',' + map.maxExtent.bottom;
                }
                  
                tiled.mergeNewParams({
                    version: wmsVersion,
                    tilesOrigin : origin
                });
                untiled.mergeNewParams({
                    version: wmsVersion
                });
            }
            
            function setAntialiasMode(mode){
                tiled.mergeNewParams({
                    format_options: 'antialias:' + mode
                });
                untiled.mergeNewParams({
                    format_options: 'antialias:' + mode
                });
            }
            
            function setPalette(mode){
                if (mode == '') {
                    tiled.mergeNewParams({
                        palette: null
                    });
                    untiled.mergeNewParams({
                        palette: null
                    });
                }
                else {
                    tiled.mergeNewParams({
                        palette: mode
                    });
                    untiled.mergeNewParams({
                        palette: mode
                    });
                }
            }
            
            function setWidth(size){
                var mapDiv = document.getElementById('map');
                var wrapper = document.getElementById('wrapper');
                
                if (size == "auto") {
                    // reset back to the default value
                    mapDiv.style.width = null;
                    wrapper.style.width = null;
                }
                else {
                    mapDiv.style.width = size + "px";
                    wrapper.style.width = size + "px";
                }
                // notify OL that we changed the size of the map div
                map.updateSize();
            }
            
            function setHeight(size){
                var mapDiv = document.getElementById('map');
                
                if (size == "auto") {
                    // reset back to the default value
                    mapDiv.style.height = null;
                }
                else {
                    mapDiv.style.height = size + "px";
                }
                // notify OL that we changed the size of the map div
                map.updateSize();
            }
            
            function updateFilter(){
                if(pureCoverage)
                  return;
            
                var filterType = document.getElementById('filterType').value;
                var filter = document.getElementById('filter').value;
                
                // by default, reset all filters
                var filterParams = {
                    filter: null,
                    cql_filter: null,
                    featureId: null
                };
                if (OpenLayers.String.trim(filter) != "") {
                    if (filterType == "cql") 
                        filterParams["cql_filter"] = filter;
                    if (filterType == "ogc") 
                        filterParams["filter"] = filter;
                    if (filterType == "fid") 
                        filterParams["featureId"] = filter;
                }
                // merge the new filter definitions
                mergeNewParams(filterParams);
            }
            
            function resetFilter() {
                if(pureCoverage)
                  return;
            
                document.getElementById('filter').value = "";
                updateFilter();
            }
            
            function mergeNewParams(params){
                tiled.mergeNewParams(params);
                untiled.mergeNewParams(params);
            }
			
            window.onload=init;
        </script>
<div class="page-content">
	<div class="page-header">
		<h1>
			Profile <small> <i class="icon-double-angle-right"></i> Region
			</small>
		</h1>
	</div>
	<!-- /.page-header -->
	<div class="row">
		<div class="col-sm-3">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="smaller">List Region</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<p class="muted">
							<?php
							foreach ($all_region as $regions) {
								echo "<p><a href='" . base_url() . "profile/region_alert/" . $regions->region_id . "'>" . $regions->name . "</a></p>";
							}
							?>
						
						
						
						
						
						
						<p>
					
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">

			<form role="form" class="form-horizontal"
				enctype="multipart/form-data" id="form-region"
				action="<?php echo site_url();?>profile/region_alert/" method="POST" />

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Name </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name"
						placeholder="Name"
						value="<?php echo isset($region) ? $region->name : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Description </label>
				<div class="col-sm-9">
					<textarea class="form-control" id="description" name="description"
						placeholder="Description"><?php  echo  isset($region) ? $region->description : '';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Expire Time </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="expire_time"
						name="expire_time" placeholder="0 if unlimited"
						value="<?php echo isset($region) ? $region->expire_time : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Work Hour Start </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="time_start"
						name="time_start" 
						
						value="<?php echo isset($region) ? $region->time_start : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Work Hour End </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="time_end"
						name="time_end" 
						value="<?php echo isset($region) ? $region->time_end : '';?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Inside / Outside </label>
				<div class="col-sm-9">
					<select class="form-control" id="in_out" name="in_out">
					<option>&nbsp;</option>
					<option value="in" <?php if(isset($region)) {
						echo $region->in_out == "in" ? 'selected':'';
					}?>>Inside</option>
					<option value="out" <?php if(isset($region)) {
						echo $region->in_out == "out" ? 'selected':'';
					}?>>Outside</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"
					for="form-field-1"> Color </label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="color" name="color"
						placeholder="color"
						value="<?php echo isset($region) ? $region->color : '';?>">
				</div>
				<br> <br>
				<div class="panel-body">
					<br> * Klik untuk menandai peta 
					<br> * Double pada titik terakhir 
					<div id="map">
						<img id="options" title="Toggle options toolbar"
							src="<?php echo base_url_new();?>:8080/geoserver/options.png" />
					</div>
					<div id="nodelist">
						<em>Click on the map to get feature info</em>
					</div>
					<div id="div_lonlat"></div>
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info btn-region" type="button">
						<i class="icon-ok bigger-110"></i> Submit
					</button>
					<button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i> Reset
					</button>
				</div>
			</div>
				<?php echo isset($region) ? '<input type="hidden" name="region_id" value="'.$region->region_id.'" >' : '';?>
				<textarea id="tmp_position" style="display: none"><?php echo isset($region) ? $region->latlng : '';?></textarea>
			</form>
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.page-content -->
