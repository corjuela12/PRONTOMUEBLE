<?php
include_once "BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id_venta = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_venta) {
    try {
        // Consulta para obtener los detalles de la venta
        $consulta = "SELECT * FROM VENTAS WHERE id_venta = :id_venta";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $resultado->execute();

        // Verificar si se obtuvo un resultado
        $venta = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($venta) {
            // Si se encuentra la venta, devolver los detalles como JSON
            echo json_encode($venta);
        } else {
            // Si no se encuentra la venta, devolver un error
            echo json_encode(['error' => 'Venta no encontrada']);
        }
    } catch (PDOException $e) {
        // Capturar cualquier error de la base de datos
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    // Si no se proporciona el ID de venta, devolver un error
    echo json_encode(['error' => 'ID de venta no proporcionado']);
}
?>
