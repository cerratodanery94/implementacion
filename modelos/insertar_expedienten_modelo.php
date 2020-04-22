<?php	

	try{
		require '../modelos/conectar.php';
		if (isset($_POST['peso'])&& 
		isset($_POST['estatura'])&& 
		isset($_POST['presion'])&& 
		isset($_POST['temperatura'])&& 
		isset($_POST['antecedentes'])&& 
		isset($_POST['dieta'])&& 
		isset($_POST['fecha_de_creacion'])&& 
		isset($_POST['id'])
		){
		$id=$_POST["id"];
		$peso=$_POST["peso"];
		$estatura=$_POST["estatura"];
		$presion=$_POST["presion"];
		$temperatura=$_POST["temperatura"];
		$antecedentes=strtoupper($_POST["antecedentes"]);
		$dieta=strtoupper ($_POST["dieta"]);
		$fecha_de_creacion=date("Y-m-d H:m:s");
		
	
		
	   $sql="INSERT INTO TBL_EXPEDIENTE_NUTRICIONISTA (
		   PER_CODIGO,
		   NUTRI_FECHA_CREACION,
		   NUTRI_ANTECEDENTES_CLINICOS,
		   NUTRI_PESO,
		   NUTRI_ALTURA,
		   NUTRI_PRESION_ARTERIAL,
		   NUTRI_TEMPERATURA,
		   NUTRI_DIETA) 
		   
	   VALUES (
		:id,
		:fecha_creacion,
		:antecedentes,
		:peso,
		:estatura,
		:presion,
		:temperatura,
		:dieta
	
		)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
		   ":id"=>$id,
		   ":fecha_creacion"=>$fecha_de_creacion,
		   ":antecedentes"=>$antecedentes,
		   ":peso"=>$peso,
		   ":estatura"=>$estatura,
		   ":presion"=>$presion,
		   ":temperatura"=>$temperatura,
		   ":dieta"=>$dieta));
	   

	  /* $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
	    $resultado2=$conexion->prepare($sql2);	
	 	$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'NUEVO',":descr"=>'CREO UN USUARIO EN MANTENIMIENTO',":fecha"=>$fecha_vencimiento));*/
		
	   if ($resultado) {
		$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
	    $resultado2=$conexion->prepare($sql2);	
		$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>20,":accion"=>'NUEVO',":descr"=>'CREO UN EXPEDIENTE NUTRICIONISTA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
		//echo '<script>alert("Se ha registrado exitosamente");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRO CORRECTAMENTE EL EXPEDIENTE",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_pacientes_vista.php";
                    });
                  </script>';	
	   } else {
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';	
		echo '<script> Swal.fire({
			position: "center",
			icon: "Error",
			title: "¡ALGO SALIÓ MAL!",
			text:"ERROR AL REGISTRAR EXPEDIENTE",
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