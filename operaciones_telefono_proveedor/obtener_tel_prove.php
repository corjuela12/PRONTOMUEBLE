<?php 
include_once "../BD/conexionMYSQLI.php";

if (isset($_GET['id_proveedor']) && isset($_GET['telefono_proveedor'])) {
    $id_proveedor = $_GET['id_proveedor'];
    $telefono_proveedor = $_GET['telefono_proveedor'];

    // Cambiar la consulta para usar los dos parámetros
    $query = "SELECT * FROM TELEFONO_PROVEEDOR WHERE id_proveedor = ? AND telefono_proveedor = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("is", $id_proveedor, $telefono_proveedor);  // "i" para el id_proveedor (entero) y "s" para telefono_proveedor (cadena)
    $stmt->execute();
    $result = $stmt->get_result();
    $telefono = $result->fetch_assoc();

    echo json_encode($telefono);
} 
?>

