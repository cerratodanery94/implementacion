<?php	

	try{
		require '../modelos/conectar.php';
        if (isset($_POST['id_p'])&& 
        isset($_POST['id_u'])&&
		isset($_POST['fecha_cita'])&& 
		isset($_POST['hora_inicio'])&&
        isset($_POST['hora_final'])&&
        isset($_POST['estado'])){
        $id_p=$_POST["id_p"];
        $id_u=$_POST["id_u"];
		$fecha_cita=$_POST["fecha_cita"];
		$hora_inicio=$_POST["hora_inicio"];
        $hora_final=$_POST["hora_final"];
        $estado=$_POST["estado"];
        $descrip='';

		
	
		
	   $sql="INSERT INTO tbl_citas (
		   PER_CODIGO,
		   USU_CODIGO,
		   CIT_FECHA_CITA,
		   CIT_HORA_INICIO,
		   CIT_HORA_FINAL,
           CIT_ESTADO,
           CIT_DESCRIPCION) 
		   
	   VALUES (
		:id_p,
		:id_u,
		:fecha_cita,
		:hora_inicio,
		:hora_final,
        :estado,
        :descrip
	
		)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
        ":id_p"=>$id_p,
	    ":id_u"=>$id_u,
	    ":fecha_cita"=>$fecha_cita,
        ":hora_inicio"=>$hora_inicio,
        ":hora_final"=>$hora_final,
        ":estado"=>$estado,
        ":descrip"=>NULL));
	   

	  /* $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
	    $resultado2=$conexion->prepare($sql2);	
	 	$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'NUEVO',":descr"=>'CREO UN USUARIO EN MANTENIMIENTO',":fecha"=>$fecha_vencimiento));*/
		
	   if ($resultado) {
		//echo '<script>alert("Se ha registrado exitosamente");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRO CORRECTAMENTE LA CITA",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_citas_vista.php";
                    });
                  </script>';	
	   } else {
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';	
		echo '<script> Swal.fire({
			position: "center",
			icon: "Error",
			title: "¡ALGO SALIÓ MAL!",
			text:"ERROR AL REGISTRAR CITA",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';
	}
		$resultado->closeCursor();
		$resultado2->closeCursor();
}
	}catch(Exception $e){			
		
        die('Error: ' . $e->GetMessage());
		echo "Codigo del error" . $e->getCode();	
	}

?>
</body>
</html>