<?php
session_start();
require '../modelos/conectar.php';
try {
  if (isset($_POST['nombres']) && isset($_POST['apellidos'])) {
    $id1=$_POST['id1'];
    $usuarioa=strtoupper($_POST['usuarioa']);
    $nombres=strtoupper($_POST['nombres']);
    $usuarion=strtoupper($_POST['usuarion']);
    $apellidos=strtoupper($_POST['apellidos']);
    $estado1=strtoupper($_POST['estado']);
		$correon=$_POST['correon'];
    $rol1=$_POST['rol_usuario'];
    if ($usuarioa!=$usuarion) {
      $consulta3=$conexion->prepare("SELECT * FROM tbl_usuario WHERE USU_USUARIO=:user");
      $consulta3->execute(array(":user"=>$usuarion));
      if($consulta3->rowCount()>=1){
       echo '<script>Swal.fire({
		position: "center",
		icon: "error",
		title: "¡ERROR!",
		text:"USUARIO  YA SE HA  ENCUENTRA REGISTRADO",
		showConfirmButton: false,
		timer: 3000
	    })
		</script>';
       exit();
			}else{
        $usuariof=$usuarion;
			}
    } else {
      $usuariof=$usuarioa;
    }
    $consulta2=$conexion->prepare("UPDATE tbl_usuario SET USU_USUARIO=:usuario, USU_NOMBRES=:nombre,USU_APELLIDOS=:apellido,USU_ESTADO=:estado,ROL_CODIGO=:rol,USU_CORREO=:correo WHERE USU_CODIGO=:id");
			$consulta2->execute(array(":usuario"=>$usuariof,":nombre"=>$nombres,":apellido"=>$apellidos,":estado"=>$estado1,":rol"=>$rol1,":correo"=>$correon,":id"=>$id1));
            if($consulta2){
              $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>10,":accion"=>'EDITAR',":descr"=>'ACTUALIZO USAURIO',":fecha"=>date("Y-m-d H:i:s")));
                echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE HA ACTUALIZADO REGISTRO CORRECTAMENTE",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_vista.php";
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