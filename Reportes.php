<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pronto_mueble";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el rango de días seleccionado
$dias = isset($_GET['dias']) ? intval($_GET['dias']) : 10;

// Consultas para los reportes

// 1. Vendedor con más ventas
$sql_vendedor = "SELECT v.nombre AS vendedor, COUNT(ve.id_venta) AS total_ventas, SUM(ve.total) AS total_ingresos 
                 FROM vendedores v 
                 JOIN ventas ve ON v.id_vendedor = ve.id_vendedor 
                 WHERE ve.fecha >= DATE_SUB(CURDATE(), INTERVAL $dias DAY) 
                 GROUP BY v.id_vendedor 
                 ORDER BY total_ingresos DESC LIMIT 1;";
$result_vendedor = $conn->query($sql_vendedor);
$vendedor_data = $result_vendedor->fetch_assoc();

// 2. Clientes nuevos
$sql_clientes_nuevos = "SELECT nombre AS cliente, fecha_registro 
                        FROM cliente 
                        WHERE fecha_registro >= DATE_SUB(CURDATE(), INTERVAL $dias DAY) 
                        ORDER BY fecha_registro DESC;";
$result_clientes_nuevos = $conn->query($sql_clientes_nuevos);

// 3. Clientes con mayores compras
$sql_clientes_compras = "SELECT c.nombre AS cliente, SUM(ve.total) AS total_compras 
                         FROM cliente c 
                         JOIN ventas ve ON c.id = ve.id_cliente 
                         WHERE ve.fecha >= DATE_SUB(CURDATE(), INTERVAL $dias DAY) 
                         GROUP BY c.id 
                         ORDER BY total_compras DESC LIMIT 5;";
$result_clientes_compras = $conn->query($sql_clientes_compras);

// 4. Muebles más vendidos
/* $sql_muebles_vendidos = "SELECT m.nombre AS mueble, COUNT(dv.id_detalle) AS cantidad_vendida, SUM(dv.precio) AS total_ingresos 
                         FROM muebles m 
                         JOIN detalle_venta dv ON m.id_mueble = dv.id_mueble 
                         JOIN ventas ve ON dv.id_venta = ve.id_venta 
                         WHERE ve.fecha >= DATE_SUB(CURDATE(), INTERVAL $dias DAY) 
                         GROUP BY m.id_mueble 
                         ORDER BY cantidad_vendida DESC LIMIT 5;";
$result_muebles_vendidos = $conn->query($sql_muebles_vendidos); */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Ventas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Reportes de Ventas</h1>

        <!-- Formulario para seleccionar el rango de días -->
        <form method="GET" action="" class="mb-4">
            <label for="dias" class="form-label">Seleccionar últimos días:</label>
            <select id="dias" name="dias" class="form-select w-auto d-inline-block">
                <option value="10" <?php if ($dias == 10) echo 'selected'; ?>>10 días</option>
                <option value="20" <?php if ($dias == 20) echo 'selected'; ?>>20 días</option>
                <option value="30" <?php if ($dias == 30) echo 'selected'; ?>>30 días</option>
            </select>
            <button type="submit" class="btn btn-primary">Generar Reporte</button>
        </form>

        <!-- Reporte 1: Vendedor con más ventas -->
        <h3 class="mt-4">Vendedor con más ventas</h3>
        <?php if ($vendedor_data): ?>
            <p><strong>Vendedor:</strong> <?php echo $vendedor_data['vendedor']; ?></p>
            <p><strong>Total Ventas:</strong> <?php echo $vendedor_data['total_ventas']; ?></p>
            <p><strong>Total Ingresos:</strong> $<?php echo number_format($vendedor_data['total_ingresos'], 2); ?></p>
        <?php else: ?>
            <p>No hay datos disponibles para este periodo.</p>
        <?php endif; ?>

        <!-- Reporte 2: Clientes nuevos -->
        <h3 class="mt-4">Clientes Nuevos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_clientes_nuevos->num_rows > 0): ?>
                    <?php while ($cliente = $result_clientes_nuevos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $cliente['cliente']; ?></td>
                            <td><?php echo $cliente['fecha_registro']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No hay clientes nuevos en este periodo.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Reporte 3: Clientes con mayores compras -->
        <h3 class="mt-4">Clientes con mayores compras</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Total Compras</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_clientes_compras->num_rows > 0): ?>
                    <?php while ($cliente = $result_clientes_compras->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $cliente['cliente']; ?></td>
                            <td>$<?php echo number_format($cliente['total_compras'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No hay datos de compras en este periodo.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Reporte 4: Muebles más vendidos -->
        <h3 class="mt-4">Muebles más vendidos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mueble</th>
                    <th>Cantidad Vendida</th>
                    <th>Total Ingresos</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_muebles_vendidos->num_rows > 0): ?>
                    <?php while ($mueble = $result_muebles_vendidos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $mueble['mueble']; ?></td>
                            <td><?php echo $mueble['cantidad_vendida']; ?></td>
                            <td>$<?php echo number_format($mueble['total_ingresos'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No hay datos de muebles vendidos en este periodo.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>
