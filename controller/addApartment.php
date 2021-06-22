<?php
    include('../Model/DB.php');
    $db = new DB();
    $db->conectarDB();
    // print_r($_POST);
    if(isset($_POST['add'])){
        $numero_apartamento=$_POST['numeroApartamento'];
        $numero_personas=$_POST['personas'];
        $arrendado=$_POST['estado'];
        $cuota=$_POST['cuota'];  
        $identificacion=$_POST['propietario'];
        try{
            $sqlAdministracion='SELECT MAX(id_administracion) as id FROM administracion';
            $result=$db->getData($sqlAdministracion);

            $id_administracion=$result[0]['id'];
            $sqlApartamentos="INSERT INTO `apartamentos`(`valor_cuota`, `id_administracion`, `numero_apartamento`, `numero_personas`, `arrendado`, `estado`) VALUES ($cuota,$id_administracion,$numero_apartamento,$numero_personas,$arrendado,1)";
            $db->addData($sqlApartamentos);

            $sqlPropietario="select id_usuario from propietarios where identificacion={$identificacion}";
            $id_propietario=$db->getData($sqlPropietario);

            $sqlApartamento='SELECT MAX(id_apartamento) as id FROM apartamentos';
            $id_apartamento=$db->getData($sqlApartamento);
            $sql3="INSERT INTO `apartamento_usuario`(`id_usuario`, `id_apartamento`,'estado') VALUES ({$id_propietario[0]['id_usuario']},{$id_apartamento[0]['id']},1)";
            $db->addData($sql3);
        }catch(Exception $e) {
            
        }
        
        header("Location: /sistemaApartamentos/index.php");
        die();
    }

