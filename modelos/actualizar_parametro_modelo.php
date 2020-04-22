<?php
session_start();
require '../modelos/conectar.php';
try {
    if (isset($_POST['valor']) && 
        isset($_POST['id_p']) ) {
            $id_p= $_POST["id_p"];
            $valor=strtoupper($_POST["valor"]);
           
        $query=$conexion->prepare
        ("UPDATE TBL_PARAMETROS SET
           PARMT_VALOR=:valor
           WHERE PARMT_CODIGO=:id_p");
      
         $query->execute(array(
           ":valor"=>$valor,
            ":id_p"=>$id_p

        ));
          if($query){
            $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
            VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
              $resultado2=$conexion->prepare($sql2);	
            $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>35,":accion"=>'EDITAR',":descr"=>'ACTUALIZO PARAMETRO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO PARAMETRO CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_parametros_vista.php";
            });
          </script>';
          }else{
            
            echo '<script> 
             Swal.fire({
             position: "center",
             icon: "Error",
             title: "¡ALGO SALIÓ MAL!",
             text:"NO SE ACTUALIZO REGISTRO",
             showConfirmButton: false,
             timer: 3000
             })
             </script>';
          }
      
        
      }
      
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}
?>