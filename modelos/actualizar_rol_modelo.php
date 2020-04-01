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