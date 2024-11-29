<?php
include_once  "BD/conexionPDO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_vendedor = $_POST['id_vendedor'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $genero = $_POST['genero'];
    $query = "UPDATE vendedor SET nombre = ?, telefono = ?, direccion = ?, email = ?, genero = ? WHERE id_vendedor = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("sssssi", $nombre, $telefono, $direccion, $email, $genero, $id_vendedor);

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