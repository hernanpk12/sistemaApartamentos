<?php
    include('../Model/DB.php');
    $db = new DB();
    $db->conectarDB();
    // print_r($_POST);
    if(isset($_POST['add'])){
        print_r($_POST);
        try{
            $sql="INSERT INTO `propietarios`( `nombre`, `apellidos`, `identificacion`, `telefono`, `email`, `estado`, `id_tipo_documento`) VALUES ('{$_POST['nombre']}','{$_POST['apellido']}',{$_POST['identificacion']},{$_POST['telefono']},'{$_POST['email']}',1,{$_POST['tipo_identificacion']})";

            $db->addData($sql);
            echo($sql);
        }catch(Exception $e){
            echo('Error');
        }
        
        header("Location: /sistemaApartamentos/index.php");
        die();
    }

