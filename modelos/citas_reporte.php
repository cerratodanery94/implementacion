<?php
require('../vistas/fpdf/fpdf.php');
require('../modelos/conectar.php');
if (isset($_POST['desde']) && 
isset($_POST['hasta']) &&
isset($_POST['estado'])
 ) {
$_SESSION["est_c"]=$_POST["estado"];
$_SESSION["desde"]=$_POST["desde"];
$_SESSION["hasta"]=$_POST["hasta"];
$consulta=$conexion->prepare("SELECT * from tbl_citas c INNER JOIN tbl_personas p on c.per_codigo = p.per_codigo INNER JOIN tbl_usuario u  ON c.usu_codigo=u.usu_codigo INNER JOIN tbl_horario h ON c.hor_codigo=h.hor_codigo WHERE c.cit_estado IN ($_SESSION[est_c]) AND c.cit_fecha_cita BETWEEN '$_SESSION[desde]' AND '$_SESSION[hasta]' AND c.cit_estado_registro = 'A'");
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
    $this->Cell(270,15,utf8_decode('LISTA DE CITAS DESDE '.$_SESSION["desde"].' HASTA '.$_SESSION["hasta"]),0,0,'C');
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
    $this->Cell(93,8,utf8_decode('ATENCION CON'),0,0,'C',1);
    $this->Cell(93,8,utf8_decode('PACIENTE'),0,0,'C',1);
    $this->Cell(26,8,utf8_decode('FECHA'),0,0,'C',1);
    $this->Cell(30,8,utf8_decode('HORA'),0,0,'C',1);
    $this->Cell(35,8,utf8_decode('ESTADO'),0,1,'C',1);

    

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
    $pdf->Cell(93,8,utf8_decode($fila['USU_NOMBRES']." ". $fila['USU_APELLIDOS']),0,0,'C',1);
    $pdf->Cell(93,8,utf8_decode($fila['PER_NOMBRES']." ". $fila['PER_APELLIDOS']),0,0,'C',1);
    $pdf->Cell(26,8,utf8_decode($fila['CIT_FECHA_CITA']),0,0,'C',1);
    $pdf->Cell(30,8,utf8_decode($fila['HOR_HORA']),0,0,'C',1);
    $pdf->Cell(35,8,utf8_decode($fila['CIT_ESTADO']),0,1,'C',1);
    $i++;
   }
}
$pdf->Output('D','CLINICA MEDICA HOMEOPATICA CLIME HOME LISTA DE CITAS.pdf');
?>