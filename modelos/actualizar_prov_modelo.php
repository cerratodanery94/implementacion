<?php
require '../modelos/conectar.php';
try {
    if (isset($_POST['prov']) && 
    isset($_POST['correo']) &&
    isset($_POST['id_p']) && 
    isset($_POST['direccion']) && 
    isset($_POST['tel_prov']) && 
    isset($_POST['nom_repre'])&& 
    isset($_POST['cel_repre'])) {
    $id_p=$_POST["id_p"];
    $prov=strtoupper($_POST["prov"]);
    $correo= $_POST["correo"];
    $direccion=strtoupper($_POST["direccion"]);
    $tel_prov= $_POST["tel_prov"];
    $nom_repre=strtoupper($_POST["nom_repre"]);
    $cel_repre= $_POST["cel_repre"];
        
      
        $query=$conexion->prepare
        ("UPDATE TBL_PROVEEDORES SET
           PROV_NOMBRE=:prov,
		   PROV_CONTACTO=:nom_repre,
		   PROV_TELEFONO_CONTACTO=:cel_repre,
		   PROV_DIRECCION=:direccion,
		   PROV_CORREO=:correo,
		   PROV_TELEFONO=:tel_prov
        WHERE PROV_CODIGO=:id_p");
      
         $query->execute(array(
            ":prov"=>$prov,
            ":nom_repre"=>$nom_repre,
            ":cel_repre"=>$cel_repre,
            ":direccion"=>$direccion,
            ":correo"=>$correo,
            ":tel_prov"=>$tel_prov,
            ":id_p"=>$id_p

        ));
          if($query){
            //echo '<script>alert("SE HA ACTUALIZADO PACIENTE CORRECTAMENTE");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO PROVEEDOR CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_prov_vista.php";
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