<?php
session_start();
require '../modelos/conectar.php';
try {
  if (isset($_POST['id_c'])&&
  isset($_POST['id_p'])&& 
  isset($_POST['id_u'])&&
  isset($_POST['fecha_cita'])&& 
  isset($_POST['hora_inicio'])&&
  isset($_POST['hora_final'])&&
  isset($_POST['estado'])&&
  isset($_POST['descrip'])
  ){
    $id_c=$_POST["id_c"];
    $id_p=$_POST["id_p"];
    $id_u=$_POST["id_u"];
    $fecha_cita=$_POST["fecha_cita"];
    $hora_inicio=$_POST["hora_inicio"];
    $hora_final=$_POST["hora_final"];
    $estado=$_POST["estado"];
    $descrip=strtoupper($_POST['descrip']);
        
        $query=$conexion->prepare
        ("UPDATE TBL_CITAS SET
        PER_CODIGO=:id_p,
        USU_CODIGO=:id_u,
        CIT_FECHA_CITA=:fecha_cita,
        CIT_HORA_INICIO=:hora_inicio,
        CIT_HORA_FINAL=:hora_final,
        CIT_ESTADO=:estado,
        CIT_DESCRIPCION=:descrip
        
      
        WHERE CIT_CODIGO=:id_c");
      
         $query->execute(array(
          ":id_p"=>$id_p,
          ":id_u"=>$id_u,
          ":fecha_cita"=>$fecha_cita,
          ":hora_inicio"=>$hora_inicio,
          ":hora_final"=>$hora_final,
          ":estado"=>$estado,
          ":descrip" =>$descrip,
          ":id_c" =>$id_c
        ));
          if($query){
            $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>29,":accion"=>'EDITAR',":descr"=>'ACTUALIZO UNA CITA',":fecha"=>date("Y-m-d H:i:s")));
            //echo '<script>alert("SE HA ACTUALIZADO PACIENTE CORRECTAMENTE");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO CITA CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_citas_vista.php";
            });
          </script>';
          }else{
            // echo '<script>alert("ERROR NO SE ACTUALIZO REGISTRO");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
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