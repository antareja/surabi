<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html) 
{
require_once("dompdf/dompdf_config.inc.php");

// We check wether the user is accessing the demo locally
if ( isset( $_POST["html"] )) {
  if ( get_magic_quotes_gpc() )
    $html = stripslashes($html);
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper("letter", "portrait");
  $dompdf->render();

  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

  exit(0);
}
}
?>