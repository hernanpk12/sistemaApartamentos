<?php
    include('../Model/DB.php');
    $db = new DB();
    $db->conectarDB();
    //print_r($_POST);
    if(isset($_POST['add'])){
        $numero_apartamento=$_POST['numeroApartamento'];
        $numero_personas=$_POST['personas'];
        $arrendado=$_POST['estado'];
        $cuota=$_POST['cuota'];  
        
        $sql='SELECT MAX(id_administracion) as id FROM administracion';
        $result=$db->getData($sql);
        $id_administracion=$result[0]['id'];
        $sql1="INSERT INTO `apartamentos`(`valor_cuota`, `id_administracion`, `numero_apartamento`, `numero_personas`, `arrendado`, `estado`) VALUES ($cuota,$id_administracion,$numero_apartamento,$numero_personas,$arrendado,1)";
        $db->addData($sql1);

        header("Location: /sistemaApartamentos/index.php");
        die();
    }

