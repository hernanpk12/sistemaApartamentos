<?php require_once('layouts/header.php')?>
  <?php require_once('model/DB.php');

    $db = new DB();
    $db->conectarDB();
    $sql = 'SELECT*FROM administracion';
    $valor_Administracion = $db->getData($sql);
    $sqlFecha = 'select DATEDIFF(now(),fecha_creacion) as fecha  FROM administracion where estado=1';
    $fecha_activo = $db->getData($sqlFecha);
    $activo=isset($fecha_activo[0]['fecha'])&&$fecha_activo[0]['fecha']>=365?1:0;
    
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Valor Administración</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Adminstracion</a></li>
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
            <i class="fas fa-dollar-sign mr-1"></i>
            Valor Administración
            </h3>
            <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                    <?php if($activo):?>
                        <button class="btn btn-info" data-toggle="modal" data-target="#modal-add"><i class="fas fa-dollar-sign"></i> Actualizar Valor Administración</button>
                    <?php endif;?>
                </li>
            </ul>
            </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <?php foreach($valor_Administracion as $administracion):?>
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <p class="h4">Administracion Año <?php $año=explode('-',$administracion['fecha_creacion']);
                                                                    echo($año[0]); ?></p>
                                <p class="h4"> Valor: <?php echo($administracion['costo_administracion']) ?></p>
                                <p>
                                    <?php 
                                        if($administracion['estado']==0){
                                            echo("<span class='text-warning font-weight-bold'>Inactivo</span><br>");
                                        }else if($administracion['estado']==1){
                                            echo("<span class='text-primary font-weight-bold'>Activo</span><br>");
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
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

<div class="modal fade" id="modal-add">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Apartamento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controller/addAdministracion.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="cuotaInput" class="form-label">Nuevo valor de la cuota de administración:</label>
                            <input type="number" class="form-control" id="cuotaInput" name="cuotaInput" min="<?php print_r(end($valor_Administracion)['costo_administracion'])?>" required>            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name='add'>Guardar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>