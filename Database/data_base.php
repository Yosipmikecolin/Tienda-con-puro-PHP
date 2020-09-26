<?php

include_once "config.php";

class  Base_datos{


    private $servidor;
    private $usuario;
    private $contraseña;
    private $base_datos;



    function __construct(){


        $this->servidor = HOST;
        $this->usuario = USER;
        $this->contraseña = PASSWORD;
        $this->base_datos= BD;



    }






    public function Conectar(){


            try{

                $sql= "mysql:host=".$this->servidor.";dbname=".$this->base_datos;
                $pdo = new PDO($sql,$this->usuario,$this->contraseña);
                
                return $pdo;


            }catch(PDOException $e){


                die("Error en la conexion".$e);



            }
    
    }


}










?>