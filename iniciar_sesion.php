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
        <i class="fas fa-user fa-5x m-4"></i>
        <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
      </div>

      <!-- Login Form -->
      <form method="POST" action="controller/iniciar_sesion.php">
        <input type="text" id="email" class="fadeIn second" placeholder="email" name="email" id="email" aria-describedby="emailHelp">
        <input type="password" id="email" class="fadeIn third" placeholder="contraseña" name="contraseña" id="contraseña" aria-describedby="emailHelp">
        <input type="submit" class="fadeIn fourth" value="Log In" name='iniciarSesionBtn'>
      </form>
    </div>
  </div>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>





