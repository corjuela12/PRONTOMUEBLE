<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saboresydelicias";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar el array de tiendas
$tiendas = [];

// Verificar si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tienda = limpiarDatos($_POST["id_tienda"]);
    $nombre = limpiarDatos($_POST["nombre"]);

    // Preparar la consulta SQL
    if (!empty($id_tienda)) {
        $sql = "SELECT * FROM tienda WHERE id_tienda = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_tienda);
    } elseif (!empty($nombre)) {
            $sql = "SELECT * FROM tienda WHERE nombre LIKE ?";
            $stmt = $conn->prepare($sql);
            $nombre = "%" . $nombre . "%";  // Para permitir búsquedas parciales
            $stmt->bind_param("s", $nombre);
    } else{
            $sql = "SELECT * FROM tienda";
            $stmt = $conn->prepare($sql);
        }
    }

    // Ejecutar la consulta
    if (isset($stmt) && $stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tiendas[] = $row;
            }
        }
        $stmt->close();
    }


$conn->close();

// Función para limpiar datos de entrada
function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Tiendas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('vistas/parte_superior.php'); ?>

    <div class="container">
        <h2>Consultar Tiendas</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="id_tienda">ID Tienda:</label>
                <input type="text" class="form-control" id="id_tienda" name="id_tienda">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tiendas)) { ?>
                    <?php foreach ($tiendas as $tienda) { ?>
                        <tr>
                            <td><?php echo $tienda['id_tienda']; ?></td>
                            <td><?php echo $tienda['nombre']; ?></td>
                            <td><?php echo $tienda['direccion']; ?></td>
                            <td><?php echo $tienda['telefono']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="4">No se encontraron tiendas.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include('vistas/parte_inferior.php'); ?>
</body>
</html>