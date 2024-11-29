<?php
include_once  "BD/conexionPDO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['id'];
    
    // Verificar si se recibió un ID de producto válido
if(isset($idProducto)) {
    // Obtener el ID del producto desde la URL
    $idProducto = $idProducto;

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM proveedor WHERE id_proveedor = $idProducto";

    // Ejecutar la consulta
    if ($enlace->query($sql) === TRUE) {
        $result = true;
        //echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar el producto: " . $enlace->error;
    }

    // Cerrar la conexión
    $enlace->close();
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
