<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si usas otro nombre de usuario
$password = "";      // Cambia esto si tienes contraseña en tu base de datos
$dbname = "pronto_mueble";  // Nombre de tu base de datos

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST["nombre"];
    $identificacion = $_POST["identificacion"];
    $direccion = $_POST["direccion"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $fecha_registro = date("Y-m-d"); // Fecha actual

    // Validar datos antes de insertar
    if (!empty($nombre) && !empty($identificacion) && !empty($direccion) && !empty($correo) && !empty($telefono)) {
        // Sentencia preparada para insertar datos en la tabla 'cliente'
        $sql = "INSERT INTO cliente (nombre, identificacion, direccion, correo, telefono, fecha_registro) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        // Preparar la sentencia
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetros (s para string)
            $stmt->bind_param("ssssss", $nombre, $identificacion, $direccion, $correo, $telefono, $fecha_registro);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Nuevo cliente agregado correctamente";
            } else {
                echo "Error al agregar cliente: " . $stmt->error;
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }

    // Cerrar la conexión
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
                <label for="identificacion">Identificación:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Cliente</button>
        </form>
    </div>
    <?php include('vistas/parte_inferior.php'); ?>
</body>
</html>
