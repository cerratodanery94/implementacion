<?php

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
    $fecha_nacimiento=$_POST['fecha_de_nacimiento'];
    $identidad=$_POST['numero_de_identidad'];
    $rtn=$_POST['rtn'];
    $celular=$_POST['numero_de_celular'];
    $tel_fijo=$_POST['numero_de_telefono_fijo'];
    $genero=$_POST['genero'];
    $nacionalidad=$_POST['nacionalidad'];
    $fecha_creacion=$_POST['fecha_creacion'];
    $fecha_vencimiento=$_POST['fecha_vencida'];
    $pasaporte=$_POST['pasaporte'];
    $direccion=$_POST['direccion'];
    
    


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
    $consulta2=$conexion->prepare("UPDATE tbl_usuario SET 
     PAIS_CODIGO=:nacionalidad,
     USU_USUARIO=:usuario,
     USU_NOMBRES=:nombre,
     USU_APELLIDOS=:apellido,
     USU_ESTADO=:estado,
     ROL_CODIGO=:rol,
     USU_CORREO=:correo,
     USU_FECHA_NACIMIENTO=:fecha_nacimiento,
     USU_CELULAR=:celular,
     USU_TEL_FIJO=:tel_fijo,
     USU_IDENTIDAD=:identidad,
     USU_RTN=:rtn,
     USU_GENERO=:genero,
     USU_DIRECCION=:direccion,
     USU_PASAPORTE=:pasaporte


     WHERE USU_CODIGO=:id");
			$consulta2->execute(array(
        ":nacionalidad"=>$nacionalidad,
        ":usuario"=>$usuariof,
        ":nombre"=>$nombres,
        ":apellido"=>$apellidos,
        ":estado"=>$estado1,
        ":rol"=>$rol1,
        ":correo"=>$correon,
        ":fecha_nacimiento"=>$fecha_nacimiento,
        ":celular"=>$celular,
        ":tel_fijo"=>$tel_fijo,
        ":identidad"=>$identidad,
        ":rtn"=>$rtn,
        ":genero"=>$genero,
        ":direccion"=>$direccion,
        ":pasaporte"=>$pasaporte,
        ":id"=>$id1

      
      ));

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