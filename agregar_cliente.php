<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "saboresydelicias";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $fecha_registro = $_POST["fecha_registro"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"];
    $area = $_POST["area"];
    $empleado_id_empleado = $_POST["empleado_id_empleado"];

    // Validar datos antes de insertar
    if (!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($fecha_registro) && !empty($telefono) && !empty($cedula) && !empty($area) && !empty($empleado_id_empleado)) {
        $sql = "INSERT INTO cliente (nombre, apellido, correo, fecha_registro, telefono, cedula, area, empleado_id_empleado) VALUES ('$nombre', '$apellido', '$correo', '$fecha_registro', '$telefono', '$cedula', '$area', '$empleado_id_empleado')";

        if ($conn->query($sql) === TRUE) {
            echo "Nuevo cliente agregado correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="path_to_your_css_file.css"> 
</head>
<body>
    <?php include('vistas/parte_superior.php'); ?>
    <div class="container">
        <h2>Agregar Cliente</h2>
        <form method="POST" action="agregar_cliente.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control" id="   correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="fecha_registro">Fecha de Registro:</label>
                <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" class="form-control" id="cedula" name="cedula" required>
            </div>
            <div class="form-group">
                <label for="area">Área:</label>
                <input type="text" class="form-control" id="area" name="area" required>
            </div>
            <div class="form-group">
                <label for="empleado_id_empleado">ID Empleado:</label>
                <input type="text" class="form-control" id="empleado_id_empleado" name="empleado_id_empleado" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Cliente</button>
        </form>
    </div>
    <?php include('vistas/parte_inferior.php'); ?>
</body>
</html>