<?php
include_once  "BD/conexionPDO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_venta = $_POST['id_venta'];
    $fecha = $_POST['fecha'];
    $id_vendedor = $_POST['id_vendedor'];
    $id_cliente = $_POST['id_cliente'];
    $total = $_POST['total'];
    $query = "UPDATE vendedor SET fecha = ?, id_vendedor = ?, id_cliente = ?, total = ? WHERE id_venta = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("sssssi", $fecha, $id_vendedor, $id_cliente, $total, $id_venta);

    $response = [];
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $enlace->error; // Cambiado para capturar el error desde la conexión ($enlace)
    }
    echo json_encode($response);
}
?>