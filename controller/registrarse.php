<?php
include('../Model/DB.php');

if(isset($_POST['botonRegistrarse'])){
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $contraseña=$_POST['contraseña'];


    $transaccion = new DB();
    $consultaSQL = "INSERT INTO usuarios(nombre, apellidos, username,email, contraseña, estado) VALUES ('$nombre', '$apellidos','$username','$email', '$contraseña' , 1)";
    $transaccion->addData($consultaSQL);
    header("Location: /sistemaApartamentos/iniciar_sesion.php");
}