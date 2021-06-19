<?php
    include('../Model/DB.php');
    $db = new DB();
    $db->conectarDB();
    if(isset($_POST['update'])){
        $id=$_POST['id'];
        $cuota = $_POST['cuota'];
        $personas = $_POST['personas'];
        $estado = $_POST['estado'];
        $sql = "UPDATE `apartamentos` SET `valor_cuota`=$cuota,`numero_personas`=$personas,`arrendado`=$estado WHERE id_apartamento=$id";
        $apartments = $db->updateData($sql);

        header("Location: /sistemaApartamentos/index.php");
        die();

    }

    