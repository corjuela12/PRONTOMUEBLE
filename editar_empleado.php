<?php
session_start(); // Iniciar sesión para usar variables de sesión

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

// Función para limpiar datos de entrada
function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verificar si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["buscar_nombre"])) {
    $nombre = limpiarDatos($_GET["buscar_nombre"]);

    // Preparar la consulta SQL para buscar empleados por nombre
    $sql = "SELECT * FROM empleado WHERE nombre LIKE ?";
    $stmt = $conn->prepare($sql);
    $nombre = "%" . $nombre . "%";
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
    }
    $stmt->close();
} else {
    // Obtener datos de todos los empleados si no se proporciona un nombre para buscar
    $sql = "SELECT * FROM empleado";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
    }
}

// Procesar el formulario de edición de empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_empleado"])) {
    $id_empleado = limpiarDatos($_POST["id_empleado"]);
    $nombre = limpiarDatos($_POST["editar_nombre"]);
    $apellido = limpiarDatos($_POST["editar_apellido"]);
    $telefono = limpiarDatos($_POST["editar_telefono"]);
    $email = limpiarDatos($_POST["editar_email"]);
    $rol = limpiarDatos($_POST["editar_rol"]);
    $contraseña = limpiarDatos($_POST["editar_contraseña"]);
    $id_tienda = limpiarDatos($_POST["editar_id_tienda"]);

    // Preparar la consulta SQL para actualizar el empleado
    $sql = "UPDATE empleado SET nombre=?, apellido=?, telefono=?, email=?, rol=?, contraseña=?, tienda_id_tienda=? WHERE id_empleado=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssii", $nombre, $apellido, $telefono, $email, $rol, $contraseña, $id_tienda, $id_empleado);
    $stmt->execute();
    $stmt->close();

    // Redireccionar para evitar el reenvío del formulario al recargar la página
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Verificar si se ha enviado la solicitud para eliminar un empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_empleado"])) {
    $id_empleado = limpiarDatos($_POST["id_empleado_eliminar"]);

    // Preparar la consulta SQL para eliminar el empleado
    $sql_eliminar = "DELETE FROM empleado WHERE id_empleado=?";
    $stmt_eliminar = $conn->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $id_empleado);
    $stmt_eliminar->execute();
    $stmt_eliminar->close();

    // Redireccionar para evitar el reenvío del formulario al recargar la página
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('vistas/parte_superior.php'); ?>
    <div class="container">
        <h2>Editar Empleado</h2>
        <!-- Formulario de búsqueda -->
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="buscar_nombre">Buscar por Nombre:</label>
                <input type="text" class="form-control" id="buscar_nombre" name="buscar_nombre" value="<?php echo isset($_GET['buscar_nombre']) ? $_GET['buscar_nombre'] : ''; ?>" placeholder="Nombre del empleado">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Mostrar tabla de empleados -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Contraseña</th>
                    <th>ID de Tienda</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
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
                        <td>
                            <!-- Botones para eliminar y editar empleados -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarEmpleado<?php echo $empleado['id_empleado']; ?>">Eliminar</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarEmpleado<?php echo $empleado['id_empleado']; ?>">Editar</button>
                        </td>
                    </tr>
                    <!-- Modal de Eliminación de Empleado -->
                    <div class="modal fade" id="eliminarEmpleado<?php echo $empleado['id_empleado']; ?>" tabindex="-1" role="dialog" aria-labelledby="eliminarEmpleadoLabel<?php echo $empleado['id_empleado']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eliminarEmpleadoLabel<?php echo $empleado['id_empleado']; ?>">Eliminar Empleado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar al empleado "<?php echo $empleado['nombre']; ?>"?
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="id_empleado_eliminar" value="<?php echo $empleado['id_empleado']; ?>">
                                        <button type="submit" class="btn btn-danger" name="eliminar_empleado">Eliminar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin del Modal de Eliminación de Empleado -->
                    <!-- Modal de Edición de Empleado -->
                    <div class="modal fade" id="editarEmpleado<?php echo $empleado['id_empleado']; ?>" tabindex="-1" role="dialog" aria-labelledby="editarEmpleadoLabel<?php echo $empleado['id_empleado']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarEmpleadoLabel<?php echo $empleado['id_empleado']; ?>">Editar Empleado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="id_empleado" value="<?php echo $empleado['id_empleado']; ?>">
                                        <div class="form-group">
                                            <label for="editar_nombre">Nombre:</label>
                                            <input type="text" class="form-control" id="editar_nombre" name="editar_nombre" value="<?php echo $empleado['nombre']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="editar_apellido">Apellido:</label>
                                            <input type="text" class="form-control" id="editar_apellido" name="editar_apellido" value="<?php echo $empleado['apellido']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="editar_telefono">Teléfono:</label>
                                            <input type="text" class="form-control" id="editar_telefono" name="editar_telefono" value="<?php echo $empleado['telefono']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="editar_email">Email:</label>
                                            <input type="email" class="form-control" id="editar_email" name="editar_email" value="<?php echo $empleado['email']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="editar_rol">Rol:</label>
                                            <input type="text" class="form-control" id="editar_rol" name="editar_rol" value="<?php echo $empleado['rol']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="editar_contraseña">Contraseña:</label>
                                            <input type="password" class="form-control" id="editar_contraseña" name="editar_contraseña" value="<?php echo $empleado['contraseña']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="editar_id_tienda">ID de Tienda:</label>
                                            <input type="text" class="form-control" id="editar_id_tienda" name="editar_id_tienda" value="<?php echo $empleado['tienda_id_tienda']; ?>">
                                        </div>
                                            <button type="submit" class="btn btn-primary" name="editar_empleado">Guardar Cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin del Modal de Edición de Empleado -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <?php include('vistas/parte_inferior.php'); ?>
        </body>
        </html>