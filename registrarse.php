<?php 
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location: /sistemaApartamentos/iniciar_sesion.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apartamentos| Login</title>

  <link rel="stylesheet" href="statics/plugins/fontawesome-free/css/all.min.css">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

  <link rel="stylesheet" href="statics/css/login.css">
</head>
<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <i class="fas fa-user-plus fa-5x m-4"></i>
        <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
      </div>

      <!-- Login Form -->
      <form method="POST" action="controller/registrarse.php">
        
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="fadeIn second" id="nombre" name="nombre" value="" required>

          <label for="apellidos" class="form-label">Apellido</label>
          <input type="text" class="fadeIn second" id="apellidos" name="apellidos" value="" required>
          
          <label for="username" class="form-label">Username</label>
          <input type="text" class="fadeIn second" id="username" name="username" value="" required>

          <label for="email" class="form-label">Email address</label>
          <input type="email"  name="email" class="fadeIn Third" id="email" required>

          <label for="contraseña" class="form-label">Contraseña</label>
          <input type="password" name="contraseña" class="fadeIn second" id="contraseña" required>

          <input type="submit" class="btn btn-primary" name="botonRegistrarse" value="Registarse">
        </form>
    </div>
  </div>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>





