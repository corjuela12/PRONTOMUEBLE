<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saboresydelicias";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cliente WHERE id_cliente = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Cliente no encontrado.";
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $fecha_registro = $_POST['fecha_registro'];
    $telefono = $_POST['telefono'];
    $cedula = $_POST['cedula'];
    $area = $_POST['area'];
    $empleado_id_empleado = $_POST['empleado_id_empleado'];

    $sql = "UPDATE cliente SET nombre='$nombre', apellido='$apellido', correo='$correo', fecha_registro='$fecha_registro', telefono='$telefono', cedula='$cedula', area='$area', empleado_id_empleado='$empleado_id_empleado' WHERE id_cliente=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente actualizado correctamente.";
        header('Location: consultar_clientes.php');
        exit();
    } else {
        echo "Error actualizando cliente: " . $conn->error;
    }
} else {
    echo "ID de cliente no proporcionado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="path_to_your_css">
</head>
<body>
    <?php include 'vistas/parte_superior.php'; ?>

    <div class="container mt-5">
        <h1>Editar Cliente</h1>
        <form method="post" action="editar_cliente.php">
            <input type="hidden" name="id" value="<?php echo $row['id_cliente']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_registro">Fecha de Registro</label>
                <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo $row['fecha_registro']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $row['cedula']; ?>" required>
            </div>
            <div class="form-group">
                <label for="area">Área</label>
                <input type="text" class="form-control" id="area" name="area" value="<?php echo $row['area']; ?>" required>
            </div>
            <div class="form-group">
                <label for="empleado_id_empleado">Empleado ID</label>
                <input type="text" class="form-control" id="empleado_id_empleado" name="empleado_id_empleado" value="<?php echo $row['empleado_id_empleado']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>

    <?php include 'vistas/parte_inferior.php'; ?>
</body>
</html>