<?php
include_once "../BD/conexionMYSQLI.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos enviados por el formulario de edición
    $id_mueble = $_POST['id_mueble'];  // Recibir el id_mueble
    $nombre = $_POST['nombre'];  // Recibir el nombre del mueble
    $dimension = $_POST['dimension'];  // Recibir la dimensión del mueble
    $img = $_POST['img'];  // Recibir la imagen del mueble
    $precio = $_POST['precio'];  // Recibir el precio del mueble (tipo decimal)
    $stock = $_POST['stock'];  // Recibir el stock del mueble (tipo entero)
    $cod_tipo_mueble = $_POST['cod_tipo_mueble'];  // Recibir el código del tipo de mueble (tipo entero)
    $cod_color = $_POST['cod_color'];  // Recibir el código del color del mueble (tipo entero)
    $cod_material = $_POST['cod_material'];  // Recibir el código del material del mueble (tipo entero)
 

    // Consulta SQL para actualizar el mueble
    $query = "UPDATE mueble SET nombre = ?, dimension = ?, img = ?, precio = ?, stock = ?, cod_tipo_mueble = ?, cod_color = ?, cod_material = ? WHERE id_mueble = ?";
    $stmt = $enlace->prepare($query);
    
    // Enlazar los parámetros correctamente con sus tipos:
    // 's' para strings (nombre, dimension, img)
    // 'd' para decimales (precio)
    // 'i' para enteros (stock, cod_tipo_mueble, cod_color, cod_material, id_mueble)
    $stmt->bind_param("sssdiiiii", $nombre, $dimension, $img, $precio, $stock, $cod_tipo_mueble, $cod_color, $cod_material, $id_mueble);

    $response = [];
    if ($stmt->execute()) {
        // Si la actualización es exitosa
        $response['success'] = true;
    } else {
        // Si hay un error en la ejecución
        $response['success'] = false;
        $response['error'] = $enlace->error; // Capturar el error
    }

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
}
?>
