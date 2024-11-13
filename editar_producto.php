<?php
include_once  "BD/conexionMYSQLI.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio_compra = $_POST['precio_compra'];
    $img = $_POST['img'];
    $precio_venta = $_POST['precio_venta'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    $query = "UPDATE producto SET nombre = ?, marca = ?, precio_compra = ?, img = ?, precio_venta = ?, categoria = ?, descripcion = ? WHERE id_producto = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("ssdsdssi", $nombre, $marca, $precio_compra, $img, $precio_venta, $categoria, $descripcion, $id_producto);

    $response = [];
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }
    echo json_encode($response);
}
?>