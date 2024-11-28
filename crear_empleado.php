<?php
session_start(); // Iniciar sesión para usar variables de sesión
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Habilitar reportes de errores

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtener datos del formulario
    $nombre = limpiarDatos($_POST["nombre"]);
    $apellido = limpiarDatos($_POST["apellido"]);
    $telefono = limpiarDatos($_POST["telefono"]);
    $correo = limpiarDatos($_POST["email"]);
    $rol = limpiarDatos($_POST["rol"]);
    $clave = limpiarDatos($_POST["contraseña"]);
    $tienda = limpiarDatos($_POST["tienda_id_tienda"]);

    // Validar datos
    if (empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($rol) || empty($tienda)) {
        $_SESSION['error_message'] = "Todos los campos son obligatorios.";
    } else {
        // Preparar la consulta SQL
        $sql = "INSERT INTO empleado (nombre, apellido, telefono, email, rol, contraseña, tienda_id_tienda) VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar la consulta
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("sssssi", $nombre, $apellido, $telefono, $correo, $rol,$clave,$tienda);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Mensaje de éxito
                $_SESSION['success_message'] = "Empleado creado de manera exitosa!";
            } else {
                // Capturar el mensaje de error
                $_SESSION['error_message'] = "Error: " . $stmt->error;
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Error al preparar la consulta: " . $conn->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}

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
    <title>Crear Empleado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include('vistas/parte_superior.php'); ?>
    <div class="container">
        <h2>Crear Empleado</h2>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <input type="text" class="form-control" id="rol" name="rol" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="text" class="form-control" id="contraseña" name="contraseña" required>
            </div>
            <div class="form-group">
                <label for="tienda_id_tienda">Id Tienda:</label>
                <input type="text" class="form-control" id="tienda_id_tienda" name="tienda_id_tienda" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Empleado</button>
        </form>
        <!-- Mostrar mensaje de éxito si existe -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success_message']; ?>
            </div>
            <?php unset($_SESSION['success_message']); // Limpiar el mensaje de éxito ?>
        <?php endif; ?>
        <!-- Mostrar mensaje de error si existe -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error_message']; ?>
            </div>
            <?php unset($_SESSION['error_message']); // Limpiar el mensaje de error ?>
        <?php endif; ?>
    </div>

    <?php include('vistas/parte_inferior.php'); ?>
</body>
</html>
