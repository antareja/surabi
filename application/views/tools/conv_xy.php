<?php ob_end_flush(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
    <title>Progress Bar</title>
</head>
<body>
<!-- Progress bar holder -->
<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
<!-- Progress information -->
<div id="information" style="width"></div>
<?php
// Total processes
$total =  $xyRoad->num_rows();
// Loop through process
$i = 1;
foreach($xyRoad->result() as $xy) {
	$gPoint->setUTM( $xy->x, $xy->y, "50");
	$gPoint->convertTMtoLL();
	$id = $xy->road_id;
	echo "ID $id Location $xy->label: "; $gPoint->printLatLong(); echo "<br>";
	$data['lat'] = $gPoint->Lat();
	$data['lng'] = $gPoint->Long();
	$mtools->updateLatLngRoad($data,$id);
    // Calculate the percentation
    $percent = intval($i/$total * 100)."%";
    
    // Javascript for updating the progress bar and information
    echo '<script language="javascript">
    document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#ddd;\">&nbsp;</div>";
    document.getElementById("information").innerHTML="'.$i.' row(s) processed.";
    </script>';
    

// This is for the buffer achieve the minimum size in order to flush data
    echo str_repeat(' ',1024*64);
    

// Send output to browser immediately
    flush();
    
// Sleep one second so we can see the delay
//     sleep(1);
//     if($i == 3)
//     	break;
	$i++;
}
// Tell user that the process is completed
echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';
?>
</body>
</html