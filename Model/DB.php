<?php
class DB
{
    //Atributos
    public $usuarioDB="root";
    public $contrasenaDB="";

    //Constructor
    public function __construct(){}
    
    //Metodo
    public function conectarDB(){
        
        try{
            $datosDB="mysql:host=localhost;dbname=sistemaapartamentos";//A esto se le llama el DSN 
            $conexionDB = new PDO($datosDB,$this->usuarioDB,$this->contrasenaDB);
            return($conexionDB);
        }
        catch(PDOException $e){
            echo("Ha ocurrido el error al tatar de conectarse con la base de datos <br/>Código: ".$e->getCode()."<br/> Mensaje: ".$e->getMessage());
        }
    }
    public function addData($consultaSQL){
        
        try{
            //Establecer la conexion
            $conexionDB=$this->conectarDB();

            //Preparar la consulta
            $insertarDatos=$conexionDB->prepare($consultaSQL);

            //Ejecutar la consulta
            $resultado = $insertarDatos->execute();
            return $resultado;
        }
        catch(PDOException $e){
            echo($e->errorInfo);
        }
    }

    public function getData ($consultaSQL){
        try{
            //Establecer conexion 
            $conexionDB=$this->conectarDB();
        
            //preparar la consulta
            $consultarDatos = $conexionDB->prepare($consultaSQL);
            
            //Formato de salida
            $consultarDatos->setFetchMode(PDO::FETCH_ASSOC);
            //Ejecutar la consulta 
            $resultado = $consultarDatos->execute();
            
            //Devolvemos los datos en un array asociativo
            return $consultarDatos->fetchAll();
        }
        catch(PDOException $e){
            echo($e->errorInfo);
        }
    }

    public function deleteData($consultaSQL){
        try{
            //establecer conexion 
            $conexionDB= $this->conectarDB();

            //prepara la consulta
            $eliminarDatos = $conexionDB->prepare($consultaSQL);

            //ejecutamos la consulta
            $eliminarDatos->execute();
            
            return(true);
        }
        catch(PDOException $e){
            return("Ha ocurrido un error durante la consulta ".$e->getMessage());
        }
    }

    public function updateData($consultaSQL){
        try{
            //establecer conexion 
            $conexionDB= $this->conectarDB();

            //prepara la consulta
            $actualizarDatos = $conexionDB->prepare($consultaSQL);
            
            //ejecutamos la consulta
            $actualizarDatos->execute();
            
            return("se realizó la actualización con exito");
        }
        catch(PDOException $e){
            echo("Ha ocurrido un error durante la consulta ".$e->getMessage());
        }
    }
}
?>