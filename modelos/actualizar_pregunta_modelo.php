<?php

require '../modelos/conectar.php';
try {
  if (isset($_POST['nombre']) &&
  isset($_POST['nombrea']) && 
      isset($_POST['id']) ) {

          $id= $_POST["id"];
          $prega=strtoupper($_POST["nombrea"]);
          $preg=strtoupper($_POST["nombre"]);
          if ($prega!=$preg) {
            $consulta3=$conexion->prepare("SELECT * FROM tbl_preguntas WHERE PRE_NOMBRE=:r");
            $consulta3->execute(array(":r"=>$preg));
            if($consulta3->rowCount()>=1){
             echo '<script>Swal.fire({
          position: "center",
          icon: "error",
          title: "¡ERROR!",
          text:"PREGUNTA  YA SE HA  ENCUENTRA REGISTRADA",
          showConfirmButton: false,
          timer: 3000
            })
          </script>';
             exit();
            }else{
              $pregf=$preg;
            }
          } else {
            $pregf=$preg;
          }

        $query=$conexion->prepare
        ("UPDATE TBL_PREGUNTAS SET
           PRE_NOMBRE=:nombre
           WHERE PRE_CODIGO=:id");
      
         $query->execute(array(
           ":nombre"=>$pregf,
            ":id"=>$id

        ));
          if($query){
            $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
            VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
              $resultado2=$conexion->prepare($sql2);	
            $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>48,":accion"=>'EDITAR',":descr"=>'ACTUALIZO PREGUNTAS',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO LA PREGUNTA  CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_preguntas.php";
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