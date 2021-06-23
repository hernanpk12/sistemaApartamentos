<?php
    include('../Model/DB.php');
    $db = new DB();
    $db->conectarDB();
    if(isset($_POST['update'])){
        try{
            $nombre=$_POST['nombreEdit'];
            $apellido=$_POST['apellidoEdit'];
            $identificacion=$_POST['identificacionEdit'];
            $email=$_POST['emailEdit'];
            $telefono=$_POST['telefonoEdit'];
            $sql="UPDATE `propietarios` SET `nombre`='{$nombre}',`apellidos`='{$apellido}',`telefono`='{$telefono}',`email`='{$email}' WHERE identificacion={$identificacion}";
            $db->updateData($sql);
        }catch(Exception $e){
            
        }        
        header("Location: /sistemaApartamentos/propietarios.php");
        die();

    }

    