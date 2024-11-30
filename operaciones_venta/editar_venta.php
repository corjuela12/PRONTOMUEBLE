<?php
include_once "../BD/conexionPDO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_venta = $_POST['id_venta'];
    $id_vendedor = $_POST['id_vendedor'];
    $id_cliente = $_POST['id_cliente'];
    $total = $_POST['total'];
    $fecha = $_POST['fecha'];

    // Verificar si la fecha está en el formato correcto
    $fecha = date('Y-m-d', strtotime($fecha));  // Asegurarse de que la fecha esté en formato 'YYYY-MM-DD'

    // Preparar la consulta para actualizar la venta
    $query = "UPDATE VENTAS SET id_vendedor = :id_vendedor, id_cliente = :id_cliente, total = :total, fecha = :fecha WHERE id_venta = :id_venta";
    $stmt = $enlace->prepare($query);
    $stmt->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_INT);
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':total', $total, PDO::PARAM_STR);
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);

    $response = [];
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $stmt->errorInfo()[2];
    }

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Método de solicitud no válido']);
}
?>
