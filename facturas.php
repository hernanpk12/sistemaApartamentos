  <?php require_once('layouts/header.php')?>
  <?php require_once('model/DB.php');

    $db = new DB();
    $db->conectarDB();
    $sql = 'SELECT*FROM factura F inner join apartamentos A on A.id_apartamento=F.id_apartamento WHERE F.pago=0 AND F.estado=1';
    $facturas = $db->getData($sql);
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Facturas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Facturas</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="far fa-building mr-1"></i>
          Facturas

        </h3>
        <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
        </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <?php foreach($facturas as $factura):?>
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Factura #<?php print_r($factura['id_factura']);?></h4>
                  <p>
                    Apartamento <?php 
                      print_r($factura['numero_apartamento'])
                    ?>
                    <br>
                    Pago: <?php 
                      if($factura['pago']){
                        echo("<span class='text-success font-weight-bold'>SI</span><br>");
                      }else{
                        echo("<span class='text-danger font-weight-bold'>NO</span><br>");
                      }
                      echo("<span>Fecha de generación: {$factura['fecha_creacion']}</span><br>");
                      if($factura['mora']){
                        echo("mora: <span class='text-danger font-weight-bold'>3%</span><br>");
                      }else{
                        echo("mora: <span class='text-success font-weight-bold'>NO</span><br>");
                      }
                      ?>

                    total: <?php echo($factura['total']);?>$
                  </p>
                </div>
                <div class="icon">
                  <i class="fas fa-receipt"></i>
                </div>
                <a href="#" class="small-box-footer"  data-toggle="modal" onclick='adminFacturas(<?php echo(json_encode((array) $factura))?>)' data-target="#modal-detail-apartment">mas información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          <?php endforeach;?>
        </div>
      </div><!-- /.card-body -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once('layouts/footer.php');?>
  
  <!-- detalle apartment -->
  <div class="modal fade" id="modal-detail-apartment">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Administrar Factura</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="controller/facturas.php" method="POST" enctype="multipart/form-data">
          <p class="h5 text-center">¿Desea subir el comprobante de pago de esta factura?</p>
            <input type="hidden" name="id_factura" id="id_factura">
            <!-- <div class="custom-file mt-2"> -->
              <input type="file"  name="comprobante" id="comprobante">
              <!-- <label class="custom-file-label" for="comprobante">Selecciona el archivo</label> -->
            <!-- </div> -->
            <button type="submit" class="btn btn-success form-control mt-3" name="upload">Subir</button>  
            <hr>
            <p class="h4 text-center">¿Desea inhabilitar esta factura?</p>
            <button type="submit" class="btn btn-warning form-control" name="delete">Inhabilitar</button>
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="  " class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>