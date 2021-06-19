  <?php require_once('layouts/header.php')?>
  <?php require_once('model/DB.php');

    $db = new DB();
    $db->conectarDB();
    $sql = 'SELECT*FROM apartamentos A INNER JOIN administracion AD ON AD.id_administracion=A.id_administracion';
    $apartments = $db->getData($sql);
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Apartamentos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">

    <div class="card ">
      <div class="card-header">
        <h3 class="card-title">
          <i class="far fa-building mr-1"></i>
          Apartamentos
        </h3>
        <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <button class="btn btn-info" data-toggle="modal" data-target="#modal-add"><i class="fas fa-plus"></i> Añadir Apartmento</button>
          </li>
        </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <?php foreach($apartments as $apartment):?>
            <?php
              $db1=new Db();
              $db1->conectarDB();
              $id_apartment = $apartment['id_apartamento'];
              $sql = "select*from factura F inner join apartamentos A on A.id_apartamento=F.id_apartamento where A.id_apartamento={$id_apartment}";
              $faturas = $db1->getData($sql);
              ?>
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Apartamento <?php print_r($apartment['numero_apartamento']);?></h4>
                  <p>
                    <?php 
                      if($apartment['arrendado']==1){
                        echo("<span class='text-primary font-weight-bold'>Arrendado</span><br>");
                      }else if($apartment['arrendado']==2){
                        echo("<span class='text-primary font-weight-bold'>Dueño</span><br>");
                      }else if($apartment['arrendado']==0){
                        echo("<span class='text-warning font-weight-bold'>Vacio</span><br>");
                      }
                    ?>
                    <br>
                    Habitado: <?php echo($apartment['numero_personas']);?> personas
                    <br>
                    Cuota: <?php echo($apartment['valor_cuota']);?>$
                  </p>
                </div>
                <div class="icon">
                  <i class="fas fa-building"></i>
                </div>
                <a href="#" class="small-box-footer"  data-toggle="modal" data-target="#modal-detail-apartment" onclick='detailApartment(<?php print_r(json_encode ((array) $faturas));?>)'>mas información<i class="fas fa-arrow-circle-right"></i></a>
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

  <!-- Add apartment -->
  <div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Añadir Apartamento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="controller/addApartment.php" method="POST">
          <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="cuotaInput" class="form-label">Numero del apartamento</label>
                  <input type="text" class="form-control" id="numeroApartamentoInput" name="numeroApartamento" required>
                </div>
                <div class="col-sm-12 col-md-6">
                  <label for="personasInput" class="form-label">Numero de personas habitando el apartamento</label>
                  <input type="number" class="form-control" id="numeroPersonasInput" name="personas" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-6 mt-3">
                  <label for="habitado" class="form-label">Estado del apartamento</label>
                  <select class="form-control" id="habitadoApartamento" name="estado" required>
                    <option value="1">Arrendado</option>
                    <option value="2">Dueño</option>
                    <option value="0">Vacio</option>
                  </select>
                </div>
                <div class="col-sm-12 col-md-6 mt-3">
                  <label for="cuotaInput" class="form-label">Valor de la cuota</label>
                  <input type="text" class="form-control" id="valorCuotaInput" name="cuota" required>
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
  
  <!-- detail apartment -->
  <div class="modal fade" id="modal-detail-apartment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Administar apartamento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="controller/updateApartment.php" method="POST">
            <div class="row">
              <input type="hidden" name="id" id="id_apartamentpo">
              <div class="col-sm-12 col-md-6">
                <label for="cuotaInput" class="form-label">Valor de la cuota</label>
                <input type="text" class="form-control" id="cuotaInput" name="cuota" required>
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="personasInput" class="form-label">Numero de personas habitando el apartamento</label>
                <input type="number" class="form-control" id="personasInput" name="personas" required>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6 mt-3">
                <label for="habitado" class="form-label">Estado del apartamento</label>
                <select class="form-control" id="habitado" name="estado" required>
                  <option value="1">Arrendado</option>
                  <option value="2">Dueño</option>
                  <option value="0">Vacio</option>
                </select>
              </div>
              <div class="col-sm-12 col-md-6 row mt-5">
                  <div class="col-sm-12 col-md-6">
                    <button type="button" class="btn btn-default form-control" data-dismiss="modal">cancelar</button>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <button type="submit" class="btn btn-primary form-control" name="update">Guardar</button>
                  </div>
              </div>
            </div>
          </form>
          <hr>
          <div class="row mt-3" id="facturas">

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>