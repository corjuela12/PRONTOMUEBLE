<?php
include_once  "BD/conexionPDO.php";

if (isset($_GET['id'])) {
    $id_vendedor = $_GET['id'];

    $query = "SELECT * FROM vendedor WHERE id_vendedor = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("i", $id_vendedor);
    $stmt->execute();
    $result = $stmt->get_result();
    $vendedor = $result->fetch_assoc();

    echo json_encode($vendedor);
}
?>