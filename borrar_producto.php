<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['id'];
    
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "saboresydelicias";

    // Crear conexión
    $conexion = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    // Verificar si se recibió un ID de producto válido
 if(isset($idProducto)) {
    // Obtener el ID del producto desde la URL
    $idProducto = $idProducto;

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM producto WHERE id_producto = $idProducto";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        $result = true;
        //echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar el producto: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se proporcionó un ID de producto válido en la URL, mostrar un mensaje de error o redirigir a otra página
    echo "Error: ID de producto no proporcionado";
} 
  

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
    

?>
