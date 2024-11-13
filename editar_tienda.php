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

// Inicializar el array de tiendas
$tiendas = [];

// Función para limpiar datos de entrada
function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verificar si se ha enviado el formulario de búsqueda o edición
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["buscar_nombre"])) {
        $nombre = limpiarDatos($_GET["buscar_nombre"]);

        // Preparar la consulta SQL para buscar tiendas por nombre
        $sql = "SELECT * FROM tienda WHERE nombre LIKE ?";
        $stmt = $conn->prepare($sql);
        $nombre = "%" . $nombre . "%";
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tiendas[] = $row;
            }
        }
        $stmt->close();
    } else {
        // Obtener datos de todas las tiendas si no se proporciona un nombre para buscar
        $sql = "SELECT * FROM tienda";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tiendas[] = $row;
            }
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_tienda"])) {
    // Procesar el formulario de edición de tienda
    $id_tienda = limpiarDatos($_POST["id_tienda"]);
    $nombre = limpiarDatos($_POST["editar_nombre"]);
    $direccion = limpiarDatos($_POST["editar_direccion"]);
    $telefono = limpiarDatos($_POST["editar_telefono"]);

    // Preparar la consulta SQL para actualizar la tienda
    $sql = "UPDATE tienda SET nombre=?, direccion=?, telefono=? WHERE id_tienda=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $direccion, $telefono, $id_tienda);
    $stmt->execute();
    $stmt->close();

    // Redireccionar para evitar el reenvío del formulario al recargar la página
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Verificar si se ha enviado la solicitud para eliminar una tienda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_tienda"])) {
    $id_tienda_eliminar = limpiarDatos($_POST["id_tienda_eliminar"]);

    // Preparar la consulta SQL para eliminar la tienda
    $sql_eliminar = "DELETE FROM tienda WHERE id_tienda=?";
    $stmt_eliminar = $conn->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $id_tienda_eliminar);
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
    <title>Editar Tienda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('vistas/parte_superior.php'); ?>
    <div class="container">
        <h2>Editar Tienda</h2>
        <!-- Formulario de búsqueda -->
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="buscar_nombre">Buscar por Nombre:</label>
                <input type="text" class="form-control" id="buscar_nombre" name="buscar_nombre" value="<?php echo isset($_GET['buscar_nombre']) ? $_GET['buscar_nombre'] : ''; ?>" placeholder="Ingrese el nombre de la tienda">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tiendas as $tienda) { ?>
                    <tr>
                        <td><?php echo $tienda['id_tienda']; ?></td>
                        <td><?php echo $tienda['nombre']; ?></td>
                        <td><?php echo $tienda['direccion']; ?></td>
                        <td><?php echo $tienda['telefono']; ?></td>
                        <td>
                            <!-- Botones para eliminar y editar tiendas -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarTienda<?php echo $tienda['id_tienda']; ?>">Eliminar</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarTienda<?php echo $tienda['id_tienda']; ?>">Editar</button>
                        </td>
                    </tr>
                    <!-- Modal de Eliminación de Tienda -->
                    <div class="modal fade" id="eliminarTienda<?php echo $tienda['id_tienda']; ?>" tabindex="-1" role="dialog" aria-labelledby="eliminarTiendaLabel<?php echo $tienda['id_tienda']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eliminarTiendaLabel<?php echo $tienda['id_tienda']; ?>">Eliminar Tienda</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar la tienda "<?php echo $tienda['nombre']; ?>"?
                                </div>

                                    <div class="modal-footer">
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <input type="hidden" name="id_tienda_eliminar" value="<?php echo $tienda['id_tienda']; ?>">
                                            <button type="submit" class="btn btn-danger" name="eliminar_tienda">Eliminar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <!-- Fin del Modal de Eliminación de Tienda -->
                                    <!-- Modal de Edición de Tienda -->
                                    <div class="modal fade" id="editarTienda<?php echo $tienda['id_tienda']; ?>" tabindex="-1" role="dialog" aria-labelledby="editarTiendaLabel<?php echo $tienda['id_tienda']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editarTiendaLabel<?php echo $tienda['id_tienda']; ?>">Editar Tienda</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                        <input type="hidden" name="id_tienda" value="<?php echo $tienda['id_tienda']; ?>">
                                                        <div class="form-group">
                                                            <label for="editar_nombre">Nombre:</label>
                                                            <input type="text" class="form-control" id="editar_nombre" name="editar_nombre" value="<?php echo $tienda['nombre']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editar_direccion">Dirección:</label>
                                                            <input type="text" class="form-control" id="editar_direccion" name="editar_direccion" value="<?php echo $tienda['direccion']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editar_telefono">Teléfono:</label>
                                                            <input type="text" class="form-control" id="editar_telefono" name="editar_telefono" value="<?php echo $tienda['telefono']; ?>">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" name="editar_tienda">Guardar Cambios</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
