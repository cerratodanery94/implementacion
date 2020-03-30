<?php
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