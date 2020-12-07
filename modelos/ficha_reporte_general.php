<?php
/// Powered by Evilnapsis go to http://evilnapsis.com
require('../vistas/fpdf/fpdf.php');
require('../modelos/conectar.php');
$codigo_persona = $_GET["id"];
$consulta=$conexion->prepare("SELECT * FROM tbl_personas P inner join tbl_paises s on p.PAIS_CODIGO=s.PAIS_CODIGO where P.PER_CODIGO = $codigo_persona");
$consulta->execute();
$datos = $consulta->fetch();


$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);

// Agregamos los datos de la empresa

$pdf->Cell(192,$textypos,"CLINICA HOMEOPATICA CLIME HOME",0,1,'C');


$pdf->SetFont('Arial','B',13);    
$pdf->setY(22);$pdf->setX(10);
$pdf->Cell(192,$textypos,"FICHA MEDICA",0,1,'C');

$pdf->SetFont('Arial','B',10);    
$pdf->setY(28);$pdf->setX(10);
$pdf->Cell(192,$textypos,"DATOS GENERALES:",0,1,'');


$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Nombre Completo:");
$pdf->SetFont('Arial','B',10);
$pdf->setY(35);$pdf->setX(40);
$pdf->Cell(5,$textypos,$datos['PER_NOMBRES']);




$pdf->SetFont('Arial','',10);
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Numero Identidad:");
$pdf->SetFont('Arial','B',10);
$pdf->setY(40);$pdf->setX(40);
$pdf->Cell(5,$textypos,$datos['PER_NUMERO_IDENTIDAD']);

$pdf->SetFont('Arial','',10);
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Fecha de Nacimiento:");
$pdf->SetFont('Arial','B',10);
$pdf->setY(45);$pdf->setX(44.5);
$pdf->Cell(5,$textypos,$datos["PER_FECHA_NACIMIENTO"]);


$pdf->SetFont('Arial','',10);
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Numero de Celular:");
$pdf->SetFont('Arial','B',10);
$pdf->setY(50);$pdf->setX(41);
$pdf->Cell(5,$textypos,$datos["PER_CELULAR"]);


// Agregamos los datos del cliente
  
$pdf->setY(30);$pdf->setX(75);
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(108);
$pdf->Cell(5,$textypos,"Nacionalidad:");
$pdf->SetFont('Arial','B',10);
$pdf->setY(35);$pdf->setX(130);
$pdf->Cell(5,$textypos,$datos['PAIS_NOMBRE'] );




$pdf->SetFont('Arial','',10);  
$pdf->setY(40);$pdf->setX(108);
$pdf->Cell(5,$textypos,"Genero:");
$pdf->SetFont('Arial','B',10);  
$pdf->setY(40);$pdf->setX(121);
$pdf->Cell(5,$textypos,$datos['PER_GENERO']);

$pdf->SetFont('Arial','',10); 
$pdf->setY(45);$pdf->setX(108);
$pdf->Cell(5,$textypos,"Fecha de registro:");
$pdf->SetFont('Arial','B',10);  
$pdf->setY(45);$pdf->setX(137);
$pdf->Cell(5,$textypos,$datos['PER_FECHA_CREACION'] );


$pdf->SetFont('Arial','',10);  
$pdf->setY(50);$pdf->setX(108);
$pdf->Cell(5,$textypos,"Correo electronico:");
$pdf->SetFont('Arial','B',10);  
$pdf->setY(50);$pdf->setX(138);
$pdf->Cell(5,$textypos,$datos['PER_CORREO'] );

// Agregamos los datos del cliente


/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$consulta2=$conexion->prepare("SELECT * FROM tbl_personas p inner join tbl_expedientes e on e.PER_CODIGO = p.PER_CODIGO where p.PER_CODIGO = $codigo_persona");


$consulta2->execute();
$products = $consulta2->fetchAll();
$pdf->SetFont('Arial','',10); 
$pdf->setY(72.8);$pdf->setX(50);
$header = array( "Medicamento");
//// Arrar de Productos
    
    // Column widths
    $w = array(100);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    $i = 0;
    foreach($products as $row)
    {
        $pdf->setY(80);$pdf->setX(50);
        $pdf->MultiCell(100,5,$row['EXP_MEDICAMENTO'],1,'C');
        $pdf->Ln(10);
       
        $i = $i + 1;
    }


    $consulta2->execute();
$products = $consulta2->fetchAll();
$pdf->setY(135);$pdf->setX(50);
$header = array("ANTECEDENTES");
//// Arrar de Productos
    
    // Column widths
    $w = array(100);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    $i = 0;
    foreach($products as $row)
    {
        $pdf->setY(142);$pdf->setX(50);
        $pdf->MultiCell(100,5,$row['EXP_ANTECEDENTES_CLINICOS'],1,'C');
        $pdf->Ln();
       
        $i = $i + 1;
    }




$pdf->output();