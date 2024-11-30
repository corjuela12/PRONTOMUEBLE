<?php
include_once "../BD/conexionPDO.php";

if (isset($_GET['id'])) {
    $id_vendedor = $_GET['id'];

    // Crear instancia de la conexión
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $query = "SELECT * FROM VENDEDORES WHERE id_vendedor = :id_vendedor";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_INT);
    $stmt->execute();
    $vendedor = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retornar la respuesta en formato JSON
    echo json_encode($vendedor);
}
?>
