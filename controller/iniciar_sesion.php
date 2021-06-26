<?php 

include('../Model/DB.php');
session_start();

$db = new DB();
$conexion = $db->conectarDB();

if(isset($_POST['iniciarSesionBtn'])){
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    
    $result = $db->login($email, $contraseña);
    $errores='';
    if ($result){
        $user = array(
            "username"=>$result['username'],
            "email"=>$result['email']
        );
        
        $_SESSION['user'] = $user;
        
        header("Location: /sistemaApartamentos/index.php");
    } else {
        $errores= '<li>Datos incorrectos </li>';
    }
    // header("Location: /sistemaApartamentos/iniciar_sesion.php");

}
