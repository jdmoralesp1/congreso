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
    $this->Cell(60,10,'Reporte de Conferencistas',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',10);

    $this->Cell(50, 10, utf8_decode('Identificación'), 1,0,'C',0);
    $this->Cell(70, 10, utf8_decode('Nombre'), 1,0,'C',0);
    $this->Cell(70, 10, utf8_decode('Correo'), 1,1,'C',0);
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

$consulta = "SELECT *
            FROM conferencista
            where estado_co=1";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(50, 10, utf8_decode($row['id_conf']), 1,0,'C',0);
    $pdf->Cell(70, 10, utf8_decode($row['nomb_conf']), 1,0,'C',0);
    $pdf->Cell(70, 10, utf8_decode($row['correo_c']), 1,1,'C',0);
}

$pdf->Output();
?>