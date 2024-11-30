<?php
include_once "../BD/conexionPDO.php";

// Comprobar si se ha recibido una solicitud de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_venta = $_POST['id_venta'];
    $id_vendedor = $_POST['id_vendedor'];
    $id_cliente = $_POST['id_cliente'];
    $total = $_POST['total'];
    $fecha = $_POST['fecha'];

    // Consulta de actualización
    $query = "UPDATE ventas SET id_vendedor = ?, id_cliente = ?, total = ?, fecha = ? WHERE id_venta = ?";

    // Preparar la consulta
    if ($stmt = $enlace->prepare($query)) {
        // Vincular los parámetros
        $stmt->bind_param("iisss", $id_vendedor, $id_cliente, $total, $fecha, $id_venta);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => $enlace->error]);
    }

    // Cerrar la conexión
    $enlace->close();
}
?>
