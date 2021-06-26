 <?php require_once('layouts/header.php')?>
  <?php require_once('model/DB.php');

    $db = new DB();
    $db->conectarDB();
    $sql = 'select nombre,apellidos,identificacion,telefono,email,identificacion,id_tipo_documento from propietarios p where p.estado=1';
    $propietarios = $db->getData($sql);
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Propietarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Propietarios</a></li>
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
          <i class="fas fa-user mr-1"></i>
          Propietarios

        </h3>
        <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <button class="btn btn-info" data-toggle="modal" data-target="#modal-add"><i class="fas fa-plus"></i> Añadir Propietario</button>
          </li>
        </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <?php foreach($propietarios as $propietario):?>
          <?php 
            $sql1="SELECT A.id_apartamento,A.valor_cuota,A.numero_apartamento,A.numero_personas,A.arrendado FROM `propietarios` p inner join apartamento_usuario ap on ap.id_usuario=p.id_usuario inner join apartamentos a on a.id_apartamento=ap.id_apartamento where p.identificacion='{$propietario['identificacion']}' and A.estado=1";
            $apartamentos=$db->getData($sql1);
            $id_apartment = isset($apartamentos[0]['id_apartamento'])?$apartamentos[0]['id_apartamento']:'';

            $sqlFacturas = "SELECT f.id_factura,f.total,f.mora,f.fecha_creacion FROM factura F INNER JOIN apartamentos A ON A.id_apartamento=F.id_apartamento INNER JOIN apartamento_usuario AU ON AU.id_apartamento=A.id_apartamento INNER JOIN propietarios P ON P.id_usuario=AU.id_usuario where A.id_apartamento={$id_apartment}";
            $facturas = $db->getData($sqlFacturas);

            $jsonFacturas = json_encode((array) $facturas);
            $jsonPropietario=json_encode((array) $propietario);
            $jsonApartamentos=json_encode ((array) $apartamentos);
            ?>
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-light">
                <div class="inner">
                  <h4><?php echo("{$propietario['nombre']} {$propietario['apellidos']}")?></h4>
                  <p>
                    Numero Contacto: <?php echo($propietario['telefono'])?>
                    <br>
                    E-mail: <?php echo($propietario['email'])?>
                    <br>
                    Identificación: <?php echo($propietario['identificacion'])?>
                  </p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <a href="#" class="small-box-footer"  data-toggle="modal" data-target="#modal-detail-apartment" onclick='detailPropietario(<?php print_r("{$jsonApartamentos},{$jsonPropietario}")?>)'>mas información<i class="fas fa-arrow-circle-right"></i></a>
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
          <h4 class="modal-title">Agregar Propietario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="controller/addPropietario.php">
            <div class="modal-body">
              <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="apellido" class="form-label">Apellidos: </label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="tipo_documento" class="form-label">tipo de documento</label>
                  <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required>
                    <option value="1">Cedula de ciudadania</option>
                    <option value="2">Tarjeta de identidad</option>
                    <option value="3">Tarjeta de extranjeria</option>
                  </select>
                </div>
                  <div class="col-sm-12 col-md-6">
                      <label for="identificacion" class="form-label">Identificación: </label>
                      <input type="number" class="form-control" id="identificacion" name="identificacion" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                      <label for="email" class="form-label">Email: </label>
                      <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="col-sm-12 col-md-6">
                      <label for="telefono" class="form-label">Telefono: </label>
                      <input type="number" class="form-control" id="telefono" name="telefono" required>
                  </div>
                </div>
              </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" name="add">Guardar </button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
  <!-- detalle apartment -->
  <div class="modal fade" id="modal-detail-apartment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Administrar propietario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="controller/updatePropietario.php" method="POST">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                  <label for="nombreEdit" class="form-label">Nombre: </label>
                  <input type="text" class="form-control" id="nombreEdit" name="nombreEdit" required>
              </div>
              <div class="col-sm-12 col-md-6">
                  <label for="apellidoEdit" class="form-label">Apellidos: </label>
                  <input type="text" class="form-control" id="apellidoEdit" name="apellidoEdit" required>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="tipo_identificacionEdit" class="form-label">tipo de documento</label>
                <select class="form-control" id="tipo_identificacionEdit" name="tipo_identificacionEdit" disabled required>
                  <option value="1">Cedula de ciudadania</option>
                  <option value="2">Tarjeta de identidad</option>
                  <option value="3">Tarjeta de extranjeria</option>
                </select>
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="identificacionEdit" class="form-label">Identificación: </label>
                <input type="number" class="form-control" id="identificacionEdit" name="identificacionEdit" readonly required>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                  <label for="emailEdit" class="form-label">Email: </label>
                  <input type="email" class="form-control" id="emailEdit" name="emailEdit" required>
              </div>
              <div class="col-sm-12 col-md-6">
                  <label for="telefonoEdit" class="form-label">Telefono: </label>
                  <input type="number" class="form-control" id="telefonoEdit" name="telefonoEdit" required>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <button type="submit" class="btn btn-warning form-control mt-3" name="delete">Inhabilitar</button>
              </div>
              <div class="col-sm-12 col-md-6">
                <button type="submit" class="btn btn-primary form-control mt-3" name="update">Guardar</button>
              </div>
            </div>
          </form>
          <hr>
          <div id="apartments" class="row">
          
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-toggle="modal"  data-dismiss="modal" data-target="#modal-notificacion" id="notificacion">Enviar Correo</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Enviar Correos -->
  <div class="modal fade" id="modal-notificacion">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Notificar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3 form-group">
                <label>
                    Nombre:
                </label>
                <input class="form-control" type="text" id="name" disabled>
                </input>
            </div>
            <div class="col-sm-6 col-sm-offset-3 form-group">
                <label>
                    Correo que recibe:
                </label>
                <input class="form-control" type="email" id="emailNotificacion" disabled>
                </input>
            </div>
            <div class="col-sm-12 col-sm-offset-3 form-group">
                <label>
                    Asunto:
                </label>
                <input class="form-control" type="text" id="subject">
                </input>
            </div>
            <div class="col-sm-12 col-sm-offset-3 form-group">
                <label>
                    Mensaje:
                </label>
                <textarea class="form-control" rows="8" id="message">
                </textarea>
            </div>
            <div class="col-sm-6 col-sm-offset-3 text-center">
                
            </div>
        </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="enviarEmail()">Enviar</button>
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-facturas-apartment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Facturas propietario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="facturas" class="row">
          
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-notificacion" id="notificacion">Enviar Correo</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>