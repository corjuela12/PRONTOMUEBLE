<?php
include_once "../BD/conexionPDO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_vendedor = $_POST['id_vendedor'];

        // Conectar a la base de datos
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar la consulta de eliminación
        $query = "DELETE FROM VENDEDORES WHERE id_vendedor = :id_vendedor";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_INT);

        $response = [];
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = $stmt->errorInfo(); // Captura del error
        }
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
