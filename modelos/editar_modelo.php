<?php
require'../modelos/conectar.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM TBL_USUARIO WHERE USU_CODIGO= :id";
	$resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
       $fila=$resultado->fetch();
       $id_u=$fila['USU_CODIGO'];
       $usuario=$fila['USU_USUARIO'];
       $nombre=$fila['USU_NOMBRES'];
       $apellido=$fila['USU_APELLIDOS'];
       $estado=$fila['USU_ESTADO'];
       $rol=$fila['ROL_CODIGO'];
       $correo=$fila['USU_CORREO'];
   }
}
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
        //echo "ERROR: USUARIO  YA EXISTE";
       // echo '<script>alert("ERROR: USUARIO  YA EXISTE");location.href="../vistas/mostrar_vista.php"</script>';
       echo '<script>Swal.fire({
        title: "¡ALGO SALIO MAL!",
        position: "top-end",
        text: "USUARIO YA SE ENCUENTRA REGISTRADO",
        icon: "error",
        type: "error"
        }).then(function() {
        window.location = "../vistas/mostrar_vista.php";
        });
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
echo '<script>alert("SE HA ACTUALIZADO REGISTRO CORRECTAMENTE");location.href="../vistas/mostrar_vista.php"</script>';
            }else{
              echo '<script>alert("ERROR NO SE ACTUALIZO REGISTRO");location.href="../vistas/mostrar_vista.php"</script>';
            }

}
?> 
<?php require"../vistas/editar_vista.php" ?>