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
    $this->Cell(60,10,'Reporte de Usuarios y sus Conferencias',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',7);

    $this->Cell(16, 10, utf8_decode('Id usuario'), 1,0,'C',0);
    $this->Cell(18, 10, utf8_decode('Id conferencia'), 1,0,'C',0);
    $this->Cell(75, 10, utf8_decode('Conferencia'), 1,0,'C',0);
    $this->Cell(55, 10, utf8_decode('Conferencista'), 1,0,'C',0);
    $this->Cell(18, 10, utf8_decode('Fecha'), 1,0,'C',0);
    $this->Cell(13, 10, utf8_decode('Hora'), 1,1,'C',0);
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

$consulta = "SELECT u.id_u, c.id_confer, c.nomb_c, cf.nomb_conf, c.fecha_c, c.hora_c
            FROM conferencia c, usuarios u, conferencista cf, conferencia_has_usuarios coh
            where c.id_confer=coh.Conferencia_id_confer and coh.Usuarios_id_u=u.id_u 
            and coh.Conferencia_id_conferencista=cf.id_conf ORDER BY u.id_u;";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(16, 10, utf8_decode($row['id_u']), 1,0,'C',0);
    $pdf->Cell(18, 10, utf8_decode($row['id_confer']), 1,0,'C',0);
    $pdf->Cell(75, 10, utf8_decode($row['nomb_c']), 1,0,'C',0);
    $pdf->Cell(55, 10, utf8_decode($row['nomb_conf']), 1,0,'C',0);
    $pdf->Cell(18, 10, utf8_decode($row['fecha_c']), 1,0,'C',0);
    $pdf->Cell(13, 10, utf8_decode($row['hora_c']), 1,1,'C',0);
}

$pdf->Output();
?>