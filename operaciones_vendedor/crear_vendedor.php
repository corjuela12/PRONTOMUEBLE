<?php
include_once "../BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$genero = $_POST['genero'];

$consulta = "INSERT INTO VENDEDORES (nombre, telefono, direccion, email, genero) VALUES (:nombre, :telefono, :direccion, :email, :genero)";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$resultado->bindParam(':telefono', $telefono, PDO::PARAM_STR);
$resultado->bindParam(':direccion', $direccion, PDO::PARAM_STR);
$resultado->bindParam(':email', $email, PDO::PARAM_STR);
$resultado->bindParam(':genero', $genero, PDO::PARAM_STR);

if ($resultado->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
