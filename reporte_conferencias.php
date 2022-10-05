<?php
require('./fpdf/fpdf.php');
require('conexion.inc.php');
$con = new Conexion();
$mysqli=$con->conectar();
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(60,10,'Reporte de Conferencias',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',7);

    $this->Cell(13, 10, utf8_decode('Id'), 1,0,'C',0);
    $this->Cell(30, 10, utf8_decode('Nombre'), 1,0,'C',0);
    $this->Cell(30, 10, utf8_decode('Conferencista'), 1,0,'C',0);
    $this->Cell(20, 10, utf8_decode('Fecha'), 1,0,'C',0);
    $this->Cell(18, 10, utf8_decode('Hora'), 1,0,'C',0);
    $this->Cell(82, 10, utf8_decode('Link'), 1,1,'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$consulta = "SELECT c.id_confer,c.nomb_c, cf.nomb_conf, c.fecha_c,c.hora_c, c.link_c 
FROM conferencia c, conferencista cf 
where c.id_conferencista=cf.id_conf ORDER BY c.fecha_c";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(13, 10, utf8_decode($row['id_confer']), 1,0,'C',0);
    $pdf->Cell(30, 10, utf8_decode($row['nomb_c']), 1,0,'C',0);
    $pdf->Cell(30, 10, utf8_decode($row['nomb_conf']), 1,0,'C',0);
    $pdf->Cell(20, 10, utf8_decode($row['fecha_c']), 1,0,'C',0);
    $pdf->Cell(18, 10, utf8_decode($row['hora_c']), 1,0,'C',0);
    $pdf->Cell(82, 10, utf8_decode($row['link_c']), 1,1,'C',0);
}

$pdf->Output();
?>