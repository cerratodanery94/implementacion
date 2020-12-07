<?php

require '../modelos/conectar.php';
try {
  if (isset($_POST['nombre']) &&
  isset($_POST['nombrea']) && 
      isset($_POST['id']) ) {
        $id= $_POST["id"];
        $paisa=strtoupper($_POST["nombrea"]);
        $pais=strtoupper($_POST["nombre"]);
        
        if ($paisa!=$pais) {
          $consulta3=$conexion->prepare("SELECT * FROM tbl_paises WHERE PAIS_NOMBRE=:r");
          $consulta3->execute(array(":r"=>$pais));
          if($consulta3->rowCount()>=1){
           echo '<script>Swal.fire({
        position: "center",
        icon: "error",
        title: "¡ERROR!",
        text:"NACIONALIDAD  YA SE HA  ENCUENTRA REGISTRADA",
        showConfirmButton: false,
        timer: 3000
          })
        </script>';
           exit();
          }else{
            $paisf=$pais;
          }
        } else {
          $paisf=$pais;
        }
            
           
        $query=$conexion->prepare
        ("UPDATE TBL_PAISES SET
           PAIS_NOMBRE=:nombre
           WHERE PAIS_CODIGO=:id");
      
         $query->execute(array(
           ":nombre"=>$paisf,
            ":id"=>$id

        ));
          if($query){
            $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
            VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
              $resultado2=$conexion->prepare($sql2);	
            $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>53,":accion"=>'EDITAR',":descr"=>'ACTUALIZO NACIONALIDADES',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO EL PAIS  CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_paises.php";
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