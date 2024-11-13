<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Clientes</title>
    <link rel="stylesheet" href="path_to_your_css">
</head>
<body>
    <?php include 'vistas/parte_superior.php'; ?>
    
    <div class="container mt-5">
        <h1>Informe de Clientes</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Total Consumido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once 'BD/conexionPDO.php';

                    try {
                        $conn = conexion::Conectar();
                        if ($conn) {
                            echo "Conexión exitosa.<br>";
                        } else {
                            echo "Error en la conexión.<br>";
                        }

                        $sql = "SELECT c.id_cliente, c.nombre, c.apellido, SUM(p.`valor total`) AS total_consumido 
                                FROM cliente c 
                                JOIN pedido p ON c.id_cliente = p.cliente_id_cliente 
                                GROUP BY c.id_cliente, c.nombre, c.apellido";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row["id_cliente"] . "</td>";
                                echo "<td>" . $row["nombre"] . "</td>";
                                echo "<td>" . $row["apellido"] . "</td>";
                                echo "<td>" . $row["total_consumido"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
                        }

                    } catch (Exception $e) {
                        echo "Error en la consulta: " . $e->getMessage();
                    }

                    $conn = null;
                    ?>
                </tbody>
            </table>
        </div>
        <form action="generar_informe.php" method="post">
            <button type="submit" class="btn btn-primary">Descargar Informe en PDF</button>
        </form>
    </div>

    <?php include 'vistas/parte_inferior.php'; ?>
</body>
</html>