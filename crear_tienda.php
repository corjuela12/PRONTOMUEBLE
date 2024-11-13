<?php
session_start(); // Iniciar sesión para usar variables de sesión

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
    $direccion = limpiarDatos($_POST["direccion"]);
    $telefono = limpiarDatos($_POST["telefono"]);

    // Validar datos
    if (empty($nombre) || empty($direccion) || empty($telefono)) {
        echo "Todos los campos son obligatorios.";
    } else {

        // Preparar la consulta SQL
        $sql = "INSERT INTO tienda (nombre, direccion, telefono) VALUES (?, ?, ?)";
        
        // Preparar la consulta
        $stmt = $conn->prepare($sql);
        
        // Vincular parámetros
        $stmt->bind_param("sss", $nombre, $direccion, $telefono);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
        
        // Mensaje de éxito
        $_SESSION['success_message'] = "¡Tienda creada de manera exitosa!";
        } else {
            // Capturar el mensaje de error
            $_SESSION['error_message'] = "Error: " . $stmt->error;
            // Verificar si el error es por entrada duplicada
            if ($stmt->errno == 1062) {
            $_SESSION['error_message'] = "Error: Datos duplicados.";
            }
        }

        // Cerrar la consulta preparada
        $stmt->close();
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
    <title>Crear Tienda</title>
</head>
<body>
<?php include('vistas/parte_superior.php'); ?>
    <div class="container">
        <h2>Crear Tienda</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="direccion">Direccion:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Tienda</button>
        </form>
        <!-- Mostrar mensaje de éxito si existe -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success_message']; ?>
            </div>
            <?php unset($_SESSION['success_message']); // Limpiar el mensaje de éxito ?>
        <?php endif; ?>
    </div>
    <?php include('vistas/parte_inferior.php'); ?>
</body>
</html>
<!-- Mostrar mensaje de éxito si existe -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); // Limpiar el mensaje de éxito ?>
<?php endif; ?>

<!-- Mostrar mensaje de error si existe -->
<?php if (isset($_SESSION['error_message'])): ?>
    <div class="modal" tabindex="-1" role="dialog" id="errorModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-primary">Volver a intentar</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Mostrar el modal de error al cargar la página
        document.addEventListener("DOMContentLoaded", function() {
            $('#errorModal').modal('show');
        });
    </script>
    <?php unset($_SESSION['error_message']); // Limpiar el mensaje de error ?>
<?php endif; ?>