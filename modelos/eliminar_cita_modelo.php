<?php 
session_start();
try {
    require '../modelos/conectar.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $consulta3=$conexion->prepare("UPDATE tbl_citas SET CIT_ESTADO_REGISTRO = 'I' WHERE CIT_CODIGO = :id");
    $consulta3->execute(array(":id"=>$id));
    
    $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
        VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
        $resultado2=$conexion->prepare($sql2);	
        $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>28,":accion"=>'ELIMINAR',":descr"=>'ELIMINO UNA CITA',":fecha"=>date("Y-m-d H:i:s")));

    header('location:../vistas/mostrar_citas_vista.php?m=1');
    

        
   
}
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}



?>