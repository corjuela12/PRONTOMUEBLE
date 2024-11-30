<?php
include_once "../BD/conexionPDO.php";

// Verificar si se recibió el ID de la venta
if (isset($_POST['id_venta'])) {
    $id_venta = $_POST['id_venta'];

    try {
        // Preparar la consulta SQL para eliminar la venta
        $query = "DELETE FROM VENTAS WHERE id_venta = :id_venta";
        $stmt = $enlace->prepare($query);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si se eliminó alguna fila
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'No se pudo eliminar la venta']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de venta no proporcionado']);
}
?>
