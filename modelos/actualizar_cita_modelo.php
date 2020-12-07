<?php

require '../modelos/conectar.php';
try {
  if (isset($_POST['id_c'])&&
  isset($_POST['id_p'])&& 
  isset($_POST['id_u'])&&
  isset($_POST['fecha_cita'])&& 
  isset($_POST['hora'])&&
  isset($_POST['estado'])&&
  isset($_POST['descrip'])
  ){
    $id_c=$_POST["id_c"];
    $id_p=$_POST["id_p"];
    $id_u=$_POST["id_u"];
    $fecha_cita=$_POST["fecha_cita"];
    $hora=$_POST["hora"];
    $estado=$_POST["estado"];
    $descrip=strtoupper($_POST['descrip']);
    $hoy=date('Y-m-d');
		if ($fecha_cita < $hoy) {
			echo '<script> Swal.fire({
				position: "center",
				icon: "error",
				title: "NO SE PUEDE REGISTRAR CITA CON UNA FECHA INFERIOR A LA ACTUAL",
				showConfirmButton: false,
				timer: 3000
			  })
        </script>';
        
    }

    $consulta=$conexion->prepare("SELECT * FROM TBL_CITAS WHERE CIT_FECHA_CITA='$fecha_cita' and HOR_CODIGO='$id_h' and USU_CODIGO='$id_u'");
        $consulta->execute();
        $num_rows = $consulta->fetchColumn();
    if($num_rows>0){
      echo '<script> Swal.fire({
        position: "center",
        icon: "error",
        title: "NO SE PUEDE REGISTRAR CITA YA ESTA RESERVADA EN ESA FECHA Y HORA",
        showConfirmButton: false,
        timer: 3000
        })
        </script>';
    }else{ 

      $consulta3=$conexion->prepare("select COUNT(HOR_CODIGO) hora_repetida from tbl_citas WHERE PER_CODIGO = ".$id_p." and CIT_FECHA_CITA = '".$fecha_cita."' and HOR_CODIGO = ".$id_h);
        $consulta3->execute();
		$fila = $consulta3->fetchAll();
		
	

    $contar_cita = $fila[0][0] ;
    if ($contar_cita> 0) {
			echo '<script> Swal.fire({
				position: "center",
				icon: "error",
				title: "USUARIO NO PUEDE TENER 2 CITAS A LA MISMA HORA",
				showConfirmButton: false,
				timer: 3000
			  })
        </script>'; }
        else{ 

        $query=$conexion->prepare
        ("UPDATE TBL_CITAS SET
        PER_CODIGO=:id_p,
        USU_CODIGO=:id_u,
        HOR_CODIGO=:id_h,
        CIT_FECHA_CITA=:fecha_cita,
        CIT_ESTADO=:estado,
        CIT_DESCRIPCION=:descrip
        
      
        WHERE CIT_CODIGO=:id_c");
      
         $query->execute(array(
          ":id_p"=>$id_p,
          ":id_u"=>$id_u,
          ":id_h"=>$hora,
          ":fecha_cita"=>$fecha_cita,
          ":estado"=>$estado,
          ":descrip" =>$descrip,
          ":id_c" =>$id_c
        ));
          if($query){
            $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>29,":accion"=>'EDITAR',":descr"=>'ACTUALIZO UNA CITA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
            //echo '<script>alert("SE HA ACTUALIZADO PACIENTE CORRECTAMENTE");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO CITA CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_citas_vista.php";
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
    }
  }
      
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}
?>