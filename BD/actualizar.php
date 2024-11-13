<?php
class conexion
{
    public static function Conectar()
    {
        if (!defined('SERVIDOR')) {
            define('SERVIDOR', 'localhost');
        }
        if (!defined('NOMBRE_BD')) {
            define('NOMBRE_BD', 'saboresydelicias');
        }
        if (!defined('USUARIO')) {
            define('USUARIO', 'root');
        }
        if (!defined('PASSWORD')) {
            define('PASSWORD', '');
        }

        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $conexion = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . NOMBRE_BD, USUARIO, PASSWORD, $opciones);
            return $conexion;
        } catch (Exception $e) {
            die("El error de conexión es: " . $e->getMessage());
        }
    }

    public static function Actualizar($consulta)
    {
        $conexion = self::Conectar();

        try {
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            return true; // La actualización fue exitosa
        } catch (Exception $e) {
            return false; // Hubo un error en la actualización
        }
    }
    public static function Actualiza($consul, $params)
    {
        $conexion = self::Conectar();

        try {
            $stmt = $conexion->prepare($consul);
            $stmt->execute($params);
            return true; // La actualización fue exitosa
        } catch (Exception $e) {
            error_log($e->getMessage()); // Registrar el mensaje de error para depuración
            return false; // Hubo un error en la actualización
        }
    }
}
?>