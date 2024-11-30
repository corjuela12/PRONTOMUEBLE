<?php
include_once "../BD/conexionPDO.php";

if (isset($_GET['id_venta'])) {
    $id_venta = $_GET['id_venta'];

    // Verifica que el id_venta es un valor numérico
    if (!is_numeric($id_venta)) {
        echo "<p class='text-danger'>ID de venta no válido.</p>";
        exit;
    }

    // Consulta a la base de datos para obtener los detalles de la venta
    $query = "SELECT VENTAS.*, cliente.nombre AS cliente_nombre, VENDEDORES.nombre AS vendedor_nombre 
              FROM VENTAS 
              JOIN cliente ON VENTAS.id_cliente = cliente.id 
              JOIN VENDEDORES ON VENTAS.id_vendedor = VENDEDORES.id_vendedor 
              WHERE VENTAS.id_venta = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $id_venta, PDO::PARAM_INT); // Uso de PDO para enlazar el parámetro
    $stmt->execute();

    $venta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($venta) {
        // Mostrar los datos de la venta
        echo "<p><strong>Venta ID:</strong> " . $venta['id_venta'] . "</p>";
        echo "<p><strong>Fecha:</strong> " . $venta['fecha'] . "</p>";
        echo "<p><strong>Cliente:</strong> " . $venta['cliente_nombre'] . "</p>";
        echo "<p><strong>Vendedor:</strong> " . $venta['vendedor_nombre'] . "</p>";
        echo "<p><strong>Total:</strong> $" . number_format($venta['total'], 2) . "</p>";
    } else {
        echo "<p class='text-danger'>No se encontró información para esta venta.</p>";
    }

    $stmt->close();
    $conn = null;
} else {
    echo "<p class='text-danger'>ID de venta no proporcionado.</p>";
}
?>
