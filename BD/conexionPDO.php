<?php
class conexion {
    public static function Conectar(){
        define('servidor', 'localhost');
        define('nombre_bd', 'saboresydelicias'); 
        define('usuario', 'root'); 
        define('password', '');

        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');

        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd,usuario,password,$opciones);
            return $conexion;
        }catch (Exception $e){
            die("El error de conexion es: ". $e->getMessage());
        }

    }
    public static function Actualizar($consulta){
        $conexion = self::Conectar();
        
        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            return true; // La actualización fue exitosa
        } catch (Exception $e) {
            return false; // Hubo un error en la actualización
        }
    }
}

