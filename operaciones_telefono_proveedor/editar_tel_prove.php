<?php
require_once "../BD/conexionMYSQLI.php"; // Conexión a la base de datos

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $id_proveedor = $_POST['id_proveedor'];
    $telefono_proveedor_nuevo = $_POST['telefono_proveedor'];
    $telefono_proveedor_anterior = $_POST['original_telefono_proveedor'];

    // Preparar la consulta SQL para actualizar el teléfono del proveedor
    $query = "UPDATE telefono_proveedor 
              SET telefono_proveedor = ? 
              WHERE id_proveedor = ? AND telefono_proveedor = ?";

    // Preparar la sentencia SQL
    $stmt = $enlace->prepare($query);

    // Verificar si la preparación fue exitosa
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $enlace->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("sis", $telefono_proveedor_nuevo, $id_proveedor, $telefono_proveedor_anterior);

    // Ejecutar la consulta
    $response = [];
    if ($stmt->execute()) {
        $response['success'] = true; // Actualización exitosa
    } else {
        $response['success'] = false;
        $response['error'] = $enlace->error; // Capturar errores
    }

    // Cerrar la conexión
    $stmt->close();

    // Enviar la respuesta en formato JSON
    echo json_encode($response);
}
?>

