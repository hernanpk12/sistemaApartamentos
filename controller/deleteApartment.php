<?php
include('../Model/DB.php');
$db = new DB();
$db->conectarDB();

if(isset($_GET['id'])){
    try{
        $id=$_GET['id'];
        $sql = "UPDATE `apartamentos` SET estado=0 WHERE id_apartamento=$id";
        $apartments = $db->updateData($sql);
    }catch(Exception $e){
        
    }        
    header("Location: /sistemaApartamentos/index.php");
    die();

}

