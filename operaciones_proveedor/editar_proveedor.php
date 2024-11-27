<?php
include_once "../BD/conexionMYSQLI.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proveedor = $_POST['id_proveedor'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $persona_contacto = $_POST['persona_contacto'];

    $query = "UPDATE proveedor SET nombre = ?, direccion = ?, persona_contacto = ? WHERE id_proveedor = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("sssi", $nombre, $direccion, $persona_contacto, $id_proveedor);

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