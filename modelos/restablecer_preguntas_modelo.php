<?php


try {
    require '../modelos/conectar.php';
    if (isset($_POST['nueva_contrap'])) {
    $id_u=$_SESSION['id_u'];
    $nueva_contra2= $_POST["nueva_contrap"];
    $pass_nueva_cifrado2=password_hash($nueva_contra2,PASSWORD_DEFAULT,array("cost"=>12));
    $sql=("UPDATE TBL_USUARIO SET USU_PASSWORD=:nueva_contrap WHERE USU_CODIGO=:id_u");
    $resultado=$conexion->prepare($sql);
    $resultado->execute(array(":nueva_contrap"=>$pass_nueva_cifrado2,":id_u"=>$id_u));
    $sql4="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
    VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
    $resultado4=$conexion->prepare($sql4);	
    $resultado4->execute(array(":id"=>NULL,":usuc"=>$id_u,":objeto"=>9,":accion"=>'UPDATE',":descr"=>'ACTUALIZO LA CONTRASEÑA POR PREGUNTAS DE SEGURIDAD',":fecha"=>date("Y-m-d H:m:s")));
    session_destroy();
    // echo '<script>alert("SE HA CAMBIADO LA CONTRASEÑA CORRECTAMENTE");window.location="../vistas/login_vista.php"</script>';
    echo '<script>Swal.fire({
        title: "BIEN!",
        text: "SE HA REESTABLECIDO SU CONTRASEÑA CORRECTAMENTE",
        icon: "success",
        type: "success"
        }).then(function() {
        window.location = "../vistas/login_vista.php";
        });
    </script>';
      }
    }catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    echo "Codigo del error" . $e->getCode();
}
?>