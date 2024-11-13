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

    // Eliminar cliente
    $sql = "DELETE FROM cliente WHERE id_cliente = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente eliminado correctamente.";
        header('Location: consultar_clientes.php');
        exit();
    } else {
        echo "Error eliminando cliente: " . $conn->error;
    }
} else {
    echo "ID de cliente no proporcionado.";
    exit();
}

$conn->close();
?>