<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
include_once "../BD/conexionPDO.php";

// Verificar si se ha pasado el parámetro 'id'
if (isset($_GET['id'])) {
    $id_venta = $_GET['id'];

    try {
        // Preparar la consulta
        $query = "SELECT * FROM VENTAS WHERE id_venta = :id_venta";
        $stmt = $enlace->prepare($query);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si la consulta devolvió algún resultado
        $venta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($venta) {
            echo json_encode($venta);
        } else {
            // Si no se encuentra la venta
            echo json_encode(['error' => 'Venta no encontrada']);
        }
    } catch (Exception $e) {
        // Si hay algún error en la consulta o en la ejecución
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    // Si no se pasó el parámetro 'id'
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>
