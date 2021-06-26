<?php
include('../Model/DB.php');
$db = new DB();
$db->conectarDB();

if(isset($_POST['upload'])){
    try{
        $id_factura=$_POST['id_factura'];
        $result='';
        $uploads_dir = '/statics/uploads/comprobantes/';
        $fileTmpPath = $_FILES['comprobante']['tmp_name'];
        $fileName = $_FILES['comprobante']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        
        $dest_path = $uploads_dir . $newFileName;
        //echo($dest_path);
        if(move_uploaded_file($fileTmpPath, "..$dest_path"))
        {
            $id_factura=$_POST['id_factura'];
            $sqlComprobante="INSERT INTO `comprobante`(`id_factura`, `url_comprobante`, `estado`) VALUES ({$id_factura},'/sistemaApartamentos{$dest_path}',1)";
            echo($sqlComprobante);
            $db->addData($sqlComprobante);
        }
        else
        {
            $result=0;
        }
    }catch(Exception $e){
        
    }        
    header("Location: /sistemaApartamentos/facturas.php");
    die();
}else if(isset($_POST['delete'])){
    try{
        $id_factura=$_POST['id_factura'];
        $sql = "UPDATE factura SET estado=0 WHERE id_factura=$id_factura";
        echo($sql);
        $apartments = $db->updateData($sql);

    }catch(Exception $e){
        
    }        
    header("Location: /sistemaApartamentos/facturas.php");
    die();
    //$apartments = $db->updateData($sql);
}