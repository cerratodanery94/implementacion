<?php

require '../modelos/conectar.php';
try {
    if (isset($_POST['nombre']) && 
        isset($_POST['id']) ) {

            $id= $_POST["id"];
            $ocupacion=strtoupper($_POST["nombre"]);
           
        $query=$conexion->prepare
        ("UPDATE TBL_OCUPACIONES SET
           OCU_NOMBRE=:nombre
           WHERE OCU_CODIGO=:id");
      
         $query->execute(array(
           ":nombre"=>$ocupacion,
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
            text: "SE HA ACTUALIZADO LA PREGUNTA  CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_profesiones.php";
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