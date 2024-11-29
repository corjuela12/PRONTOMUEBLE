<?php
include_once  "BD/conexionPDO.php";

if (isset($_GET['id'])) {
    $id_vendedor = $_GET['id'];

    $query = "SELECT * FROM VENTAS WHERE id_venta = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $result = $stmt->get_result();
    $venta = $result->fetch_assoc();

    echo json_encode($venta);
}
?>