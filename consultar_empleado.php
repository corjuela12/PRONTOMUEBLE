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

// Inicializar el array de empleados
$empleados = [];

// Verificar si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empleado = limpiarDatos($_POST["id_empleado"]);
    $nombre = limpiarDatos($_POST["nombre"]);
    $apellido = limpiarDatos($_POST["apellido"]);

    // Preparar la consulta SQL
    if (!empty($id_empleado)) {
        $sql = "SELECT * FROM empleado WHERE id_empleado = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_empleado);
    } elseif (!empty($nombre)) {
        $sql = "SELECT * FROM empleado WHERE nombre LIKE ?";
        $stmt = $conn->prepare($sql);
        $nombre = "%" . $nombre . "%";  // Para permitir búsquedas parciales
        $stmt->bind_param("s", $nombre);
    } elseif (!empty($apellido)) {
        $sql = "SELECT * FROM empleado WHERE apellido LIKE ?";
        $stmt = $conn->prepare($sql);
        $apellido = "%" . $apellido . "%";  // Para permitir búsquedas parciales
        $stmt->bind_param("s", $apellido);
    } else {
        $sql = "SELECT * FROM empleado";
        $stmt = $conn->prepare($sql);
    }

    // Ejecutar la consulta
    if (isset($stmt) && $stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $empleados[] = $row;
            }
        }
        $stmt->close();
    }
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
    <title>Consultar Empleados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('vistas/parte_superior.php'); ?>

    <div class="container">
        <h2>Consultar Empleados</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="id_empleado">Id Empleado:</label>
                <input type="text" class="form-control" id="id_empleado" name="id_empleado">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Clave</th>
                    <th>Id tienda</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($empleados)) { ?>
                    <?php foreach ($empleados as $empleado) { ?>
                        <tr>
                            <td><?php echo $empleado['id_empleado']; ?></td>
                            <td><?php echo $empleado['nombre']; ?></td>
                            <td><?php echo $empleado['apellido']; ?></td>
                            <td><?php echo $empleado['telefono']; ?></td>
                            <td><?php echo $empleado['email']; ?></td>
                            <td><?php echo $empleado['rol']; ?></td>
                            <td><?php echo $empleado['contraseña']; ?></td>
                            <td><?php echo $empleado['tienda_id_tienda']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7">No se encontró información.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include('vistas/parte_inferior.php'); ?>
</body>
</html>
