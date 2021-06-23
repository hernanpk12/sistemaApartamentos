<?php

include('../Model/DB.php');
$db = new DB();
$db->conectarDB();
// print_r($_POST);
if(isset($_POST['add'])){
    $valor_cuota=$_POST['cuotaInput'];
    try{
        $sqlUpdate='UPDATE `administracion` SET `estado`=0';
        $db->updateData($sqlUpdate);

        $sqlInsert="INSERT INTO `administracion`(`costo_administracion`, `fecha_creacion`, `estado`) VALUES ({$valor_cuota},NOW(),1)";
        $db->addData($sqlInsert);
    }catch(Exception $e) {
        
    }
    
    header("Location: /sistemaApartamentos/administracion.php");
    die();
}