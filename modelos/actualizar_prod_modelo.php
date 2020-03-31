<?php
require '../modelos/conectar.php';
try {
    if (isset($_POST['prod']) && 
        isset($_POST['descrip']) && 
        isset($_POST['precio']) &&
        isset($_POST['f_venc']) ) {
            $id_p= $_POST["id_p"];
            $prod=strtoupper($_POST["prod"]);
            $descrip=strtoupper($_POST["descrip"]);
            $precio= $_POST["precio"];
            $f_venc= $_POST["f_venc"];
        
      
        $query=$conexion->prepare
        ("UPDATE TBL_PRODUCTOS SET
           PROD_NOMBRE=:prod,
		   PROD_DESCRIPCION=:descrip,
		   PROD_PRECIO=:precio,
		   PROD_FECHA_VENCIMIENTO=:f_venc
        WHERE PROD_CODIGO=:id_p");
      
         $query->execute(array(
           ":prod"=>$prod,
       ":descrip"=>$descrip,
		   ":precio"=>$precio,
		   ":f_venc"=>$f_venc,
            ":id_p"=>$id_p

        ));
          if($query){
            //echo '<script>alert("SE HA ACTUALIZADO PACIENTE CORRECTAMENTE");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO PRODUCTO CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_prod_vista.php";
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