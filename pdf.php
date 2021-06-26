

<?php
require 'statics/vendor/autoload.php';

ob_start();
include "./FacturaTemplate.php";
$html = ob_get_clean();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->load_html($html);
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Factura.pdf";
$dompdf->stream($filename);
?>

