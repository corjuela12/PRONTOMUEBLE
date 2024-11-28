<?php
require('fpdf/fpdf.php');
require_once 'BD/conexionPDO.php';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/logo.png', 10, 8, 33); 
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'Informe de Clientes', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Conexión a la base de datos
$conn = conexion::Conectar();

$sql = "SELECT c.id_cliente, c.nombre, c.apellido, SUM(p.`valor total`) AS total_consumido 
        FROM cliente c 
        JOIN pedido p ON c.id_cliente = p.cliente_id_cliente 
        GROUP BY c.id_cliente, c.nombre, c.apellido";
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $pdf->Cell(20, 10, 'ID', 1);
    $pdf->Cell(50, 10, 'Nombre', 1);
    $pdf->Cell(50, 10, 'Apellido', 1);
    $pdf->Cell(50, 10, 'Total Consumido', 1);
    $pdf->Ln();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(20, 10, $row['id_cliente'], 1);
        $pdf->Cell(50, 10, $row['nombre'], 1);
        $pdf->Cell(50, 10, $row['apellido'], 1);
        $pdf->Cell(50, 10, $row['total_consumido'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron resultados', 1, 1, 'C');
}

$pdf->Output();
?>

