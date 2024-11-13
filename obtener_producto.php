<?php
include_once  "BD/conexionMYSQLI.php";

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    $query = "SELECT * FROM producto WHERE id_producto = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    echo json_encode($producto);
}
?>