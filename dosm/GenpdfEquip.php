<?php
ob_start(); // Inicia el buffer de salida

require('fpdf.php');
include_once 'conect.php'; // Conectar a la base de datos
define('FPDF_FONTPATH','font/');

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Listado de Equipos', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Función para ajustar el contenido de una celda
    function MultiCellRow($data, $widths) {
        // Calcular la altura máxima de la fila
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($widths[$i], $data[$i]));
        }
        $h = 10 * $nb;
        // Salto de página si es necesario
        $this->CheckPageBreak($h);
        // Dibujar las celdas de la fila
        for ($i = 0; $i < count($data); $i++) {
            $w = $widths[$i];
            $a = 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
            $this->MultiCell($w, 10, $data[$i], 0, $a);
            $this->SetXY($x + $w, $y);
        }
        $this->Ln($h);
    }

    // Verificar salto de página
    function CheckPageBreak($h) {
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
        }
    }

    // Calcular el número de líneas
    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }
}

// Crear un nuevo PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Configurar el contenido del PDF
$pdf->SetFont('Arial', 'B', 12);
$widths = [20, 30, 35, 30, 30, 40]; // Anchos de las columnas
$headers = ['ID', 'Cliente ID', 'Tipo de Equipo', 'Marca', 'Modelo', 'Numero de Serie'];

// Dibujar cabecera
$pdf->MultiCellRow($headers, $widths);

$pdf->SetFont('Arial', '', 12);

// Conectar a la base de datos y obtener los registros
$query = "SELECT * FROM Equipos"; // Cambia la tabla según sea necesario
$stmt = $conn->query($query);
$registros = $stmt->fetchAll(PDO::FETCH_OBJ);

// Dibujar filas
foreach ($registros as $fila) {
    $data = [
        $fila->id_equipo,
        $fila->id_cliente,
        $fila->tipo_equipo,
        $fila->marca,
        $fila->modelo,
        $fila->numero_serie
    ];
    $pdf->MultiCellRow($data, $widths);
}

ob_end_clean(); // Limpia el buffer de salida

// Salida del PDF
$pdf->Output('D', 'equipos.pdf');
?>
