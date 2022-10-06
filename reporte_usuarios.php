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
    $this->Cell(60,10,'Reporte de Usuarios',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',7);

    $this->Cell(18, 10, utf8_decode('Identificación'), 1,0,'C',0);
    $this->Cell(32, 10, 'Nombre', 1,0,'C',0);
    $this->Cell(29, 10, 'Apellido', 1,0,'C',0);
    $this->Cell(43, 10, utf8_decode('Institución'), 1,0,'C',0);
    $this->Cell(40, 10, 'Correo', 1,0,'C',0);
    $this->Cell(20, 10, 'Telefono', 1,1,'C',0);
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

$consulta = "SELECT u.id_u, u.nomb_u, u.apel_u, u.univ_u, u.correo_u, t.telefono, u.clave_u
            FROM usuarios u, telefonousuarios t
            where u.id_u=t.idUsu and";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(18, 10, utf8_decode($row['id_u']), 1,0,'C',0);
    $pdf->Cell(32, 10, utf8_decode($row['nomb_u']), 1,0,'C',0);
    $pdf->Cell(29, 10, utf8_decode($row['apel_u']), 1,0,'C',0);
    $pdf->Cell(43, 10, utf8_decode($row['univ_u']), 1,0,'C',0);
    $pdf->Cell(40, 10, utf8_decode($row['correo_u']), 1,0,'C',0);
    $pdf->Cell(20, 10, utf8_decode($row['telefono']), 1,1,'C',0);
}

$pdf->Output();
?>