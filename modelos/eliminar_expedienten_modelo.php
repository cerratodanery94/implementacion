<?php 
session_start();
try {
    require '../modelos/conectar.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $consulta3=$conexion->prepare("DELETE FROM tbl_expediente_nutricionista WHERE NUTRI_CODIGO=:id");
    $consulta3->execute(array(":id"=>$id));

    if($consulta3){
        $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
        VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
        $resultado2=$conexion->prepare($sql2);	
        $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>22,":accion"=>'DELETE',":descr"=>'ELIMINO EXPEDIENTE NUTRICIONISTA EN MANTENIMIENTO',":fecha"=>date("Y-m-d H:m:s")));
        header('location:../vistas/mostrar_expedienten_vista.php?m=1');
    }
    
    
    
   
}
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}



?>