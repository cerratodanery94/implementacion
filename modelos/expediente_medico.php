<?php
session_start();
require('../vistas/fpdf/fpdf.php');
require('../modelos/conectar.php');
require '../controladores/funciones.php';
if ( $_GET["id"]) {
$id=$_GET["id"];
$consulta=$conexion->prepare("SELECT * FROM tbl_personas p inner join tbl_paises s on p.PAIS_CODIGO=s.PAIS_CODIGO inner join tbl_expedientes e on e.PER_CODIGO = p.PER_CODIGO where P.PER_CODIGO=$id");
$consulta->execute();
$datos=$consulta->fetch();      
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    require('../modelos/conectar.php');
    $id=$_GET["id"];
$consulta=$conexion->prepare("SELECT * FROM tbl_personas p inner join tbl_paises s on p.PAIS_CODIGO=s.PAIS_CODIGO inner join tbl_expedientes e on e.PER_CODIGO = p.PER_CODIGO where P.PER_CODIGO=$id");
$consulta->execute();
$datos=$consulta->fetch(); 
   
   
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(75);
    // Título
    // Logo
    $this->Image('../vistas/reportes/logo.png',170,12,25,25);
    $this->SetY(20);$this->SetX(10);
    $this->Cell(0,0,utf8_decode('CLÍNICA MÉDICA HOMEOPATICA CLIME HOME'),0,0,'C');
    // Salto de línea
    $this->Ln(10);
    $this->SetFont('Arial','B',12);
    $this->Cell(0,0,utf8_decode('FICHA MÉDICA'),0,0,'C');
    $this->SetFont('Arial','BU',10);  
$this->SetY(42);$this->SetX(10);
$this->Cell(192,5,"DATOS GENERALES:",0,1,'');

$this->SetFont('Arial','B',10); 
$this->SetY(49);$this->SetX(10);
$this->Cell(5,5,"NOMBRE COMPLETO:",0,1);
$this->SetFont('Arial','',10);  
$this->SetY(49);$this->SetX(49);
$this->Cell(5,5,utf8_decode($datos['PER_NOMBRES'].' '.$datos['PER_APELLIDOS']));


$this->setY(55);$this->setX(10);
$this->SetFont('Arial','B',10);
$this->Cell(5,5,utf8_decode("NÚMERO DE IDENTIDAD:"));
$this->SetFont('Arial','',10);
$this->setY(55);$this->setX(54);
$this->Cell(5,5,$datos['PER_NUMERO_IDENTIDAD'] );

$this->setY(55);$this->setX(84);
$this->SetFont('Arial','B',10);
$this->Cell(5,5,"EDAD:");
$this->SetFont('Arial','',10);
$this->setY(55);$this->setX(96);
$this->Cell(5,5,mi_edad($datos['PER_FECHA_NACIMIENTO']));

$this->setY(55);$this->setX(102);
$this->SetFont('Arial','B',10);
$this->Cell(5,5,"SEXO:");
$this->SetFont('Arial','',10);
$this->setY(55);$this->setX(114);
$this->Cell(5,5,$datos['PER_GENERO']);

$this->setY(55);$this->setX(137);
$this->SetFont('Arial','B',10);
$this->Cell(5,5,"FECHA DE REGISTRO:");
$this->SetFont('Arial','',10);
$this->setY(55);$this->setX(177);
$this->Cell(5,5,$datos['PER_FECHA_CREACION']);

$this->setY(62);$this->setX(10);
$this->SetFont('Arial','B',10);
$this->Cell(5,5,utf8_decode("TELEFONO:"));
$this->SetFont('Arial','',10);
$this->setY(62);$this->setX(31);
$this->Cell(5,5,$datos['PER_TEL_FIJO'] );

$this->setY(62);$this->setX(50);
$this->SetFont('Arial','B',10);
$this->Cell(5,5,utf8_decode("CELULAR:"));
$this->SetFont('Arial','',10);
$this->setY(62);$this->setX(69);
$this->Cell(5,5,$datos['PER_CELULAR'] );

$this->setY(62);$this->setX(88);
$this->SetFont('Arial','B',10);
$this->Cell(5,5,utf8_decode("CORREO ELECTRONÍCO:"));
$this->SetFont('Arial','',10);
$this->setY(62);$this->setX(132);
$this->Cell(5,5,$datos['PER_CORREO'] );

    
    
    
    /*$this->SetFont('Arial','B',12);
    $this->SetFillColor(45,65,84);
    $this->SetTextColor(255,255,255);
    $this->Cell(93,8,utf8_decode('ATENCION CON'),0,0,'C',1);
    $this->Cell(93,8,utf8_decode('PACIENTE'),0,0,'C',1);
    $this->Cell(26,8,utf8_decode('FECHA'),0,0,'C',1);
    $this->Cell(30,8,utf8_decode('HORA'),0,0,'C',1);
    $this->Cell(35,8,utf8_decode('ESTADO'),0,1,'C',1);*/

    

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(10,10,10,10);
$pdf->AliasNbPages();





$consulta2=$conexion->prepare("SELECT * FROM tbl_personas p inner join tbl_paises s on p.PAIS_CODIGO=s.PAIS_CODIGO inner join tbl_expedientes e on e.PER_CODIGO = p.PER_CODIGO where P.PER_CODIGO=$id");
$consulta2->execute();
while($fila=$consulta2->fetch()){
    
    $pdf->setY(100);$pdf->setX(25);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(45,65,84);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(150,5,utf8_decode("MEDICAMENTO"),1,1,'C',1);
    $pdf->setY(105);$pdf->setX(25);
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(150,7,utf8_decode($fila['EXP_MEDICAMENTO']),1,'J');
    $pdf->Ln();
    $pdf->setY(150);$pdf->setX(25);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(45,65,84);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(150,5,utf8_decode("ANTECEDENTES CLÍNICOS"),1,1,'C',1);
    $pdf->setY(155);$pdf->setX(25);
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(150,7,utf8_decode($fila['EXP_ANTECEDENTES_CLINICOS']),1,'J');
    $pdf->Ln();
    
   }

   
  







}


$pdf->Output('I','CLINICA MEDICA HOMEOPATICA CLIME HOME LISTA DE CITAS.pdf');
?>