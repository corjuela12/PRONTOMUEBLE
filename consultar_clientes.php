<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pronto_mueble";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Ajusta la consulta SQL para buscar en los campos disponibles
$sql = "SELECT * FROM cliente WHERE nombre LIKE '%$searchTerm%' OR correo LIKE '%$searchTerm%' OR identificacion LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'vistas/parte_superior.php'; ?>
    
    <div class="container mt-5">
        <h1>Consultar Clientes</h1>
        <form method="post" action="consultar_clientes.php">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar clientes">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Fecha de Registro</th>
                        <th>Identificación</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["nombre"] . "</td>";
                            echo "<td>" . $row["correo"] . "</td>";
                            echo "<td>" . $row["telefono"] . "</td>";
                            echo "<td>" . $row["fecha_registro"] . "</td>";
                            echo "<td>" . $row["identificacion"] . "</td>";
                            echo "<td>" . $row["direccion"] . "</td>";
                            echo "<td>";
                            echo '<div class="btn-group" role="group">';
                            echo '<a href="editar_cliente.php?id=' . $row["id"] . '" class="btn btn-primary">Editar</a>';
                            echo '<button class="btn btn-danger" onclick="confirmDelete(' . $row["id"] . ')">Borrar</button>';
                            echo '</div>';
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No se encontraron resultados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este cliente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="#" id="deleteButton" class="btn btn-danger">Borrar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmDelete(id) {
            $('#deleteButton').attr('href', 'borrar_cliente.php?id=' + id);
            $('#confirmDeleteModal').modal('show');
        }
    </script>

    <?php include 'vistas/parte_inferior.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
