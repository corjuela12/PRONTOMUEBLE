<?php
include_once "../BD/conexionMYSQLI.php";

if (isset($_GET['id'])) {
    $id_proveedor = $_GET['id'];

    $query = "SELECT * FROM proveedor WHERE id_proveedor = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("i", $id_proveedor);
    $stmt->execute();
    $result = $stmt->get_result();
    $proveedor = $result->fetch_assoc();

    echo json_encode($proveedor);
}
?>