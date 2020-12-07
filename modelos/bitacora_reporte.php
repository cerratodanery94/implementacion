<?php
session_start();
require('../vistas/fpdf/fpdf.php');
require('../modelos/conectar.php');
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>60,":accion"=>'CONSULTAR',":descr"=>'GENERO REPORTE DINAMICO DE BITACORA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
if (isset($_GET['d']) && 
isset($_GET['h']) ) {
$_SESSION["desde"]=$_GET["d"];
$_SESSION["hasta"]=$_GET["h"];
$consulta=$conexion->prepare("SELECT * FROM tbl_bitacora b INNER JOIN tbl_usuario u on b.usu_codigo = u.usu_codigo INNER JOIN tbl_objetos o ON b.obj_codigo=o.obj_codigo WHERE b.bit_fecha BETWEEN '$_SESSION[desde]' AND '$_SESSION[hasta]' ORDER BY b.bit_fecha ASC");
$consulta->execute();
      $i=1;      
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
   
   
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(75);
    // Título
    // Logo
    $this->Image('../vistas/reportes/logo.png',250,8,25,25);
    $this->Cell(125,15,utf8_decode('CLÍNICA MÉDICA HOMEOPATICA CLIME HOME'),0,0,'C');
    // Salto de línea
    $this->Ln(10);
    $this->SetFont('Arial','',12);
    $this->Cell(270,15,utf8_decode('BÍTACORA DEL SISTEMA DESDE '.$_SESSION["desde"].' HASTA '.$_SESSION["hasta"]),0,0,'C');
    //$this->Cell(270,15,utf8_decode('BÍTACORA DEL SISTEMA'),0,0,'C');
    $this->Ln(10);
    $this->Cell(20,15,'FECHA: ',0,0,'L',0);
    $this->Cell(25,15,date('Y/m/d'),0,0,'L',0);
    $this->Cell(18,15,'HORA: ',0,0,'L',0);
    $this->SetFont('Arial','',12);
    $this->Cell(25,15,date('H:i:s'),0,0,'L',0);
    $this->Ln(20);
    $this->SetFont('Arial','B',12);
    $this->SetFillColor(45,65,84);
    $this->SetTextColor(255,255,255);
    $this->Cell(60,8,utf8_decode('USUARIO'),0,0,'C',1);
    $this->Cell(95,8,utf8_decode('PANTALLA'),0,0,'C',1);
    $this->Cell(60,8,utf8_decode('ACCION'),0,0,'C',1);
    $this->Cell(30,8,utf8_decode('FECHA'),0,0,'C',1);
    $this->Cell(30,8,utf8_decode('HORA'),0,1,'C',1);

    

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

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(10,10,10,10);
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);
    

while($fila=$consulta->fetch()){
    if($i%2==0){
        $pdf->SetFillColor(243,243,243);
    }else{
        $pdf->SetFillColor(255,255,255);
    }
    $pdf->Cell(60,8,utf8_decode($fila['USU_USUARIO']),0,0,'C',1);
    $pdf->Cell(95,8,utf8_decode($fila['OBJ_NOMBRE']),0,0,'C',1);
    $pdf->Cell(60,8,utf8_decode($fila['BIT_ACCION']),0,0,'C',1);
    $pdf->Cell(30,8,utf8_decode($fila['BIT_FECHA']),0,0,'C',1);
    $pdf->Cell(30,8,utf8_decode($fila['BIT_HORA']),0,1,'C',1);
    $i++;
   }
}
$pdf->Output('D','CLINICA MEDICA HOMEOPATICA CLIME HOME BITACORA DEL SISTEMA.pdf');
?>