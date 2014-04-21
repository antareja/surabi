<?php

$lon=117.00507;
$lat=-0.45760;

$mapWidth = 512;
$mapHeight = 424;

$mapLonLeft =  $lon-0.00033;
$mapLonRight = $lon+0.00033;
$mapLonDelta = $mapLonRight - $mapLonLeft;

$mapLatUp = $lat+0.00028;
$mapLatBottom = $lat-0.00028;
$mapLatBottomDegree = $mapLatBottom * M_PI / 180;

// echo $mapLonLeft."<br>";
// echo $mapLonRight."<br>";
// echo "<br>";
// echo $mapLatUp."<br>";
// echo $mapLatBottom."<br>";
// echo "<br>";

function convertGeoToPixel($lat, $lon)
{
    global $mapWidth, $mapHeight, $mapLonLeft, $mapLonDelta, $mapLatBottom, $mapLatBottomDegree;

    $x = ($lon - $mapLonLeft) * ($mapWidth / $mapLonDelta);

    $lat = $lat * M_PI / 180;
    $worldMapWidth = (($mapWidth / $mapLonDelta) * 360) / (2 * M_PI);
    $mapOffsetY = ($worldMapWidth / 2 * log((1 + sin($mapLatBottomDegree)) / (1 - sin($mapLatBottomDegree))));
    $y = $mapHeight - (($worldMapWidth / 2 * log((1 + sin($lat)) / (1 - sin($lat)))) - $mapOffsetY);

    return array($x, $y);
}

$position = convertGeoToPixel($lat, $lon);
// echo "x: ".round($position[0])." / ".round($position[1]);
// echo "<br>";
// echo "http://localhost:8080/geoserver/tcm/wms?REQUEST=GetFeatureInfo&EXCEPTIONS=application%2Fvnd.ogc.se_xml&BBOX=".$mapLonLeft."%2C".$mapLatBottom."%2C".$mapLonRight."%2C".$mapLatUp."&SERVICE=WMS&INFO_FORMAT=application%2Fjson&QUERY_LAYERS=tcm-layer_group&FEATURE_COUNT=50&Layers=tcm-layer_group&WIDTH=512&HEIGHT=424&format=image%2Fpng&styles=&srs=EPSG%3A4326&version=1.1.1&x=".round($position[0])."&y=".round($position[1]);
$ch = curl_init();
curl_setopt_array(
    $ch, array(
    CURLOPT_URL => "http://localhost:8080/geoserver/tcm/wms?REQUEST=GetFeatureInfo&EXCEPTIONS=application%2Fvnd.ogc.se_xml&BBOX=".$mapLonLeft."%2C".$mapLatBottom."%2C".$mapLonRight."%2C".$mapLatUp."&SERVICE=WMS&INFO_FORMAT=application%2Fjson&QUERY_LAYERS=tcm-layer_group&FEATURE_COUNT=50&Layers=tcm-layer_group&WIDTH=512&HEIGHT=424&format=image%2Fpng&styles=&srs=EPSG%3A4326&version=1.1.1&x=".round($position[0])."&y=".round($position[1]),
    CURLOPT_RETURNTRANSFER => true
));
 
$output = curl_exec($ch);
$output=json_decode($output);
$jalan="";
$provinsi="";
if(isset($output->features[3]->properties->NAME))
{
	$jalan=$output->features[3]->properties->NAME;
}
else if(isset($output->features[1]->properties->name))
{
	$jalan=$output->features[1]->properties->name;
}
if(isset($output->features[0]->properties->PROV))
{
	$provinsi=$output->features[0]->properties->PROV;
}
echo $lokasi=$jalan." ".$provinsi;
?>