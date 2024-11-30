<?php
include_once "../BD/pruebaPDO.php"; // Asegúrate de que aquí se define correctamente la clase de conexión

// Comprobar si se ha recibido una solicitud de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_venta = $_POST['id_venta'];
    $fecha = $_POST['fecha'];
    $id_vendedor = $_POST['id_vendedor'];
    $id_cliente = $_POST['id_cliente'];
    $id_mueble = $_POST['id_mueble'];
    $total = $_POST['total'];

    try {
        // Obtener la conexión
        $enlace = conexion::Conectar(); // Asegúrate de que este método devuelve un objeto PDO

        // Consulta de actualización
        $query = "UPDATE ventas SET fecha = :fecha, id_vendedor = :id_vendedor, id_cliente = :id_cliente, 
                  id_mueble = :id_mueble, total = :total WHERE id_venta = :id_venta";

        // Preparar la consulta
        $stmt = $enlace->prepare($query);

        // Vincular los parámetros
        $stmt->bindValue(':fecha', $fecha);
        $stmt->bindValue(':id_vendedor', $id_vendedor);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':id_mueble', $id_mueble);
        $stmt->bindValue(':total', $total);
        $stmt->bindValue(':id_venta', $id_venta);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->errorInfo()]);
        }
    } catch (Exception $e) {
        // Capturar cualquier error y devolverlo como JSON
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Detener la ejecución para evitar cualquier salida extra
    exit;
}
?>
