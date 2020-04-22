<?php
session_start();
require_once "../modelos/conectar.php"; 
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>37,":accion"=>'SALIO',":descr"=>'CERRO SESION',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
session_destroy();
header("location:../vistas/login_vista.php");
?>