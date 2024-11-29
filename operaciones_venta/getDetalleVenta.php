<?php
// Conexión a la base de datos
include 'conexion.php';

if (isset($_GET['idVenta'])) {
    $idVenta = $_GET['idVenta'];

    // Consulta a la base de datos para obtener los detalles de la venta
    $query = "SELECT VENTAS.*, clientes.nombre AS cliente_nombre, VENDEDORES.nombre AS vendedor_nombre 
              FROM VENTAS 
              JOIN clientes ON VENTAS.id_cliente = clientes.id_cliente 
              JOIN VENDEDORES ON VENTAS.id_vendedor = VENDEDORES.id_vendedor 
              WHERE VENTAS.id_venta = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idVenta);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $venta = $result->fetch_assoc();
        
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
    $conn->close();
} else {
    echo "<p class='text-danger'>ID de venta no proporcionado.</p>";
}
