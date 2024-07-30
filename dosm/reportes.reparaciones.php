<?php
ob_start(); // Inicia el buffer de salida

include_once('fpdf.php');
include_once 'conect.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos
define('FPDF_FONTPATH','font/');

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Listado de Reparaciones', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Verifica si se ha solicitado el reporte
if (isset($_POST['generate_report'])) {
    // Crear un nuevo PDF
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Conectar a la base de datos y obtener los registros
    $query = "SELECT r.id_reparacion, r.id_equipo, r.fecha_ingreso, r.fecha_salida, r.estado, r.descripcion_problema, r.descripcion_reparacion,
                     e.tipo_equipo, e.marca, e.modelo
              FROM Reparaciones r
              JOIN Equipos e ON r.id_equipo = e.id_equipo";
    $stmt = $conn->query($query);
    $registros = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Configurar el contenido del PDF
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 10, 'ID Reparacion', 1);
    $pdf->Cell(20, 10, 'ID Equipo', 1);
    $pdf->Cell(30, 10, 'Fecha Ingreso', 1);
    $pdf->Cell(30, 10, 'Fecha Salida', 1);
    $pdf->Cell(20, 10, 'Estado', 1);
    $pdf->Cell(40, 10, 'Descripcion Problema', 1);
    $pdf->Cell(40, 10, 'Descripcion Reparacion', 1);
    $pdf->Cell(30, 10, 'Tipo Equipo', 1);
    $pdf->Cell(30, 10, 'Marca', 1);
    $pdf->Cell(30, 10, 'Modelo', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10);
    foreach ($registros as $fila) {
        $pdf->Cell(20, 10, $fila->id_reparacion, 1);
        $pdf->Cell(20, 10, $fila->id_equipo, 1);
        $pdf->Cell(30, 10, $fila->fecha_ingreso, 1);
        $pdf->Cell(30, 10, $fila->fecha_salida ?? 'N/A', 1);
        $pdf->Cell(20, 10, $fila->estado, 1);
        $pdf->Cell(40, 10, $fila->descripcion_problema, 1);
        $pdf->Cell(40, 10, $fila->descripcion_reparacion, 1);
        $pdf->Cell(30, 10, $fila->tipo_equipo, 1);
        $pdf->Cell(30, 10, $fila->marca, 1);
        $pdf->Cell(30, 10, $fila->modelo, 1);
        $pdf->Ln();
    }

    ob_end_clean(); // Limpia el buffer de salida

    // Salida del PDF
    $pdf->Output('D', 'Listado_de_Reparaciones.pdf');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Reporte</title>
    <style>
       
    </style>
</head>
<body>
    
</body>
</html>
