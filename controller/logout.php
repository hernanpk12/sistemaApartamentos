<?php
session_start();
if(isset($_SESSION['user'])){
    session_destroy();
}
header("Location: /sistemaApartamentos/iniciar_sesion.php");
