<?php

include('Model/DB.php');
$db = new DB();
$db->conectarDB();
// print_r($_POST);
if(isset($_GET['id_factura'])){
    $idFactura=$_GET['id_factura'];
    try{
        $sqlUpdate="SELECT P.identificacion, P.nombre, P.apellidos, F.id_factura, F.total, F.mora, F.fecha_creacion,A.numero_apartamento
		FROM factura F INNER JOIN apartamentos A ON A.id_apartamento=F.id_apartamento INNER JOIN apartamento_usuario AU ON AU.id_apartamento=A.id_apartamento INNER JOIN propietarios P ON P.id_usuario=AU.id_usuario  where   F.id_factura={$idFactura} AND F.pago=0 AND F.estado=1";
        $factura = $db->getData($sqlUpdate);
    }catch(Exception $e) {
        
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
  			body, h1, h2, h3, h4, h5, h6{
    			font-family: 'Bree Serif', serif;
 	 									}
  	</style>
		<div class="container">
			<div class="row">
		<div class="col-xs-6 text-right">
							<div class="panel panel-default">
							<div class="panel-heading">
									<h4>NIT : 
										<span><?php echo $factura[0]['identificacion']  ?></span>
									</h4>
							</div>
							<div class="panel-body">
								<h4>FACTURA : 
								<span><?php echo $factura[0]['id_factura']  ?></span>
								</h4>
							</div>
						</div>
					</div>
 
			<hr />
 
			
				<h1 style="text-align: center;">FACTURA</h1> 
			
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-default">
								<div class="panel-heading">
									<h4><span><?php echo $factura[0]['fecha_creacion']  ?></span>
									
									</h4>
								</div>
						<div class="panel-body">
						
							
								<h4>Comprador :  
									<span><?php  echo ("{$factura[0]['nombre']}  {$factura[0]['apellidos']}")  ?></span>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									NIT/CI :
									<span><?php echo $factura[0]['identificacion']  ?></span>
									
								</h4>
					
						</div>
						</div>
					</div>
					
				</div>
<pre></pre>
<table class="table table-bordered " >
	<thead  >
		<tr >
			<th style="text-align: center;">
				<h4>Concepto</h4>
			</th>
			<th style="text-align: center;">
				<h4>Mora</h4>
			</th>
			<th style="text-align: center;">
				<h4>Total</h4>
			</th>
			
		</tr>
	</thead>
	<tbody>
		<tr >
			<td class="text-center"><span>administracion apartamento # <?php echo $factura[0]['numero_apartamento'] ?></span></td>
			<td class="text-center">  <?php if($factura[0]['mora']){
                        echo("<span class='text-danger font-weight-bold'>3%</span><br>");
                      }else{
                        echo(" <span class='text-success font-weight-bold'>NO</span><br>");
                      }  ?>  </td>
			<td class="text-center">  <?php echo $factura[0]['total']  ?>  </td>
			
		</tr>
		<tr>
			<td><a href="#"> &nbsp; </a></td>
			<td class="text-right">&nbsp;</td>
			<td class="text-right ">&nbsp;</td>
			
	    </tr>
	</tbody>
</table>
<pre></pre>
		

	<div class="row">
			<div class="col-xs-8">
			
				<div class="panel panel-info"  style="text-align: right;">
					<h6> "LA ALTERACI&Oacute;N, FALSIFICACI&Oacute;N O COMERCIALIZACI&Oacute;N ILEGAL DE ESTE DOCUMENTO ESTA PENADO POR LA LEY"</h6>
				</div>
			
		</div>
	</div>
	<a  href="pdf.php"><i class="fa fa-download"></i> Descargar archivo PDF</a>
		
</div>
</div>

</head>
<body>
	
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>