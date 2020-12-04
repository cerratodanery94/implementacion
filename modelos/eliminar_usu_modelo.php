<?php 
session_start();
try {
    require '../modelos/conectar.php';
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $consulta3=$conexion->prepare("DELETE FROM tbl_usuario WHERE USU_CODIGO=:id");
        $consulta3->execute(array(":id"=>$id));
        
        $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
        VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
        $resultado2=$conexion->prepare($sql2);	
        $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>11,":accion"=>'ELIMINAR',":descr"=>'ELIMINO UN USUARIO',":fecha"=>date("Y-m-d H:i:s")));
            
        header('location:../vistas/mostrar_vista.php?m=1');
    }  
} catch (Exception $e) {
    if($e->getCode()==23000){
        header('location:../vistas/Error_usuario.php');
    }
}



?>