<?php
require '../modelos/conectar.php';
try {
  if (isset($_POST['peso'])&& 
  isset($_POST['estatura'])&& 
  isset($_POST['presion'])&& 
  isset($_POST['temperatura'])&& 
  isset($_POST['antecedentes'])&& 
  isset($_POST['dieta'])&& 
  isset($_POST['id_e'])&&
  isset($_POST['fecha_de_creacion'])&& 
  isset($_POST['id'])
  ){
  $id_e=$_POST["id_e"];  
  $id=$_POST["id"];
  $peso=$_POST["peso"];
  $estatura=$_POST["estatura"];
  $presion=$_POST["presion"];
  $temperatura=$_POST["temperatura"];
  $antecedentes=$_POST["antecedentes"];
  $dieta=$_POST["dieta"];
  $fecha_de_creacion= $_POST["fecha_de_creacion"];
        
      
        $query=$conexion->prepare
        ("UPDATE TBL_EXPEDIENTE_NUTRICIONISTA SET
        PER_CODIGO=:codigo,
        NUTRI_FECHA_CREACION=:creacion,
        NUTRI_ANTECEDENTES_CLINICOS=:antecedentes,
        NUTRI_PESO=:peso,
        NUTRI_ALTURA=:altura,
        NUTRI_PRESION_ARTERIAL=:presion,
        NUTRI_TEMPERATURA=:temperatura,
        NUTRI_DIETA=:dieta
        
      
        WHERE NUTRI_CODIGO=:id_e");
      
         $query->execute(array(
          ":codigo"=>$id,
              ":creacion"=>$fecha_de_creacion,
              ":antecedentes"=>$antecedentes,
              ":peso"=>$peso,
              ":altura"=>$estatura,
              ":presion"=>$presion,
              ":temperatura"=>$temperatura,
              ":dieta"=>$dieta,
              ":id_e"=>$id_e ));
          if($query){
            //echo '<script>alert("SE HA ACTUALIZADO PACIENTE CORRECTAMENTE");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO EXPEDIENTE CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_expedienten_vista.php";
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