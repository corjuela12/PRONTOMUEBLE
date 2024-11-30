<?php
include_once "../BD/conexionMYSQLI.php";

if (isset($_GET['id_mueble'])) {  // Cambié 'id' por 'id_mueble' para que coincida con el parámetro de la URL
    $id_mueble = $_GET['id_mueble'];  // Recibir el id_mueble de la URL

    $query = "SELECT * FROM mueble WHERE id_mueble = ?";  // Consulta SQL que busca el mueble por su id
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("i", $id_mueble);  // Bind del id_mueble para evitar inyecciones SQL
    $stmt->execute();
    $result = $stmt->get_result();
    $mueble = $result->fetch_assoc();  // Obtener el mueble como un array asociativo

    echo json_encode($mueble);  // Devolver el mueble en formato JSON
}
?>
