<?php
require '../modelos/conectar.php';
try {
    if (isset($_POST['id_r']) && 
        isset($_POST['descrip']) && 
        isset($_POST['rol']) ) {
            $id_r= $_POST["id_r"];
            $rol=strtoupper($_POST["rol"]);
            $descrip=strtoupper($_POST["descrip"]);
            
        
      
        $query=$conexion->prepare
        ("UPDATE TBL_ROL SET
           ROL_NOMBRE=:rol,
		   ROL_DESCRIPCION=:descrip
		   
        WHERE ROL_CODIGO=:id_r");
      
         $query->execute(array(
           ":rol"=>$rol,
           ":descrip"=>$descrip,
           ":id_r"=>$id_r

        ));
          if($query){
            $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>32,":accion"=>'EDITAR',":descr"=>'ACTUALIZO ROL',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
            //echo '<script>alert("SE HA ACTUALIZADO PACIENTE CORRECTAMENTE");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO ROL CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_roles_vista.php";
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