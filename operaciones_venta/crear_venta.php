<?php
include_once "../BD/conexionPDO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_vendedor = $_POST['id_vendedor'];
        $id_cliente = $_POST['id_cliente'];
        $total = $_POST['total'];
        $fecha = $_POST['fecha'];

        // Conexión a la base de datos
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar la consulta de inserción
        $query = "INSERT INTO VENTAS (id_vendedor, id_cliente, total, fecha) 
                  VALUES (:id_vendedor, :id_cliente, :total, :fecha)";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

        $response = [];
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = $stmt->errorInfo();
        }

        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>