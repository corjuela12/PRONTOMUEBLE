<?php
include_once "../BD/conexionPDO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_vendedor = $_POST['id_vendedor'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $genero = $_POST['genero'];

        // Crear instancia de la conexión
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        // Preparar consulta
        $query = "UPDATE VENDEDORES SET nombre = :nombre, telefono = :telefono, direccion = :direccion, email = :email, genero = :genero WHERE id_vendedor = :id_vendedor";
        $stmt = $conexion->prepare($query);

        // Asignar parámetros
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_INT);

        $response = [];
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = $stmt->errorInfo(); // Capturar el error de la consulta
        }
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
