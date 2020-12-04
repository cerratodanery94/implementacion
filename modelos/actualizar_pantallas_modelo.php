<?php

require '../modelos/conectar.php';
try {
    if (
        isset($_POST['id'])&& 
        isset($_POST['descripcion'])) {

            $id= $_POST["id"];
            $descripcion=strtoupper($_POST["descripcion"]);

            
           
        $query=$conexion->prepare
        ("UPDATE TBL_OBJETOS SET
           OBJ_DESCRIPCION=:descripcion
           WHERE OBJ_CODIGO=:id");
      
         $query->execute(array(
           ":descripcion"=>$descripcion,
            ":id"=>$id

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
            text: "SE HA ACTUALIZADO LA DESCRIPCION DE LA PANTALLA  CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_pantallas.php";
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