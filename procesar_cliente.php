<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saborydelicia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$fecha_registro = $_POST['fecha_registro'];
$telefono = $_POST['telefono'];
$cedula = $_POST['cedula'];
$area = $_POST['area'];
$empleado_id = $_POST['empleado_id'];

// Insertar datos en la base de datos
$sql = "INSERT INTO cliente (nombre, apellido, correo, fecha_registro, telefono, cedula, area, empleado_id) 
        VALUES ('$nombre', '$apellido', '$correo', '$fecha_registro', '$telefono', '$cedula', '$area', '$empleado_id')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo cliente agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>