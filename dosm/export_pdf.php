<?php
require('fpdf.php');
include_once 'conect.php';

// Crea una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Agrega el título
$pdf->Cell(0, 10, 'Listado de Clientes', 0, 1, 'C');

// Agrega los encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'Cliente', 1);
$pdf->Cell(50, 10, 'Nombre', 1);
$pdf->Cell(50, 10, 'Direccion', 1);
$pdf->Cell(30, 10, 'Telefono', 1);
$pdf->Cell(40, 10, 'Email', 1);
$pdf->Ln();

// Obtén los datos de la base de datos
$query = "SELECT * FROM Clientes";
$stmt = $conn->query($query);
$registros = $stmt->fetchAll(PDO::FETCH_OBJ);

// Agrega los datos de la tabla
$pdf->SetFont('Arial', '', 10);
foreach($registros as $fila) {
    $pdf->Cell(30, 10, $fila->id_cliente, 1);
    $pdf->Cell(50, 10, $fila->nombre, 1);
    $pdf->Cell(50, 10, $fila->direccion, 1);
    $pdf->Cell(30, 10, $fila->telefono, 1);
    $pdf->Cell(40, 10, $fila->email, 1);
    $pdf->Ln();
}

// Envía el archivo PDF al navegador
$pdf->Output('D', 'Listado_Clientes.pdf');
?>
