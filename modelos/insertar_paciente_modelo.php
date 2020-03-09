<?php	

	try{
		if (isset($_POST['nombres']) && isset($_POST['apellidos'])&& isset($_POST['edad'])&& isset($_POST['numero_de_identidad'])&& isset($_POST['rtn'])&& isset($_POST['profesion'])&& isset($_POST['pasaporte'])&& isset($_POST['numero_de_telefono_fijo'])&& isset($_POST['numero_de_celular'])&& isset($_POST['fecha_de_nacimiento'])&& isset($_POST['correo'])&& isset($_POST['direccion'])&& isset($_POST['genero'])) {
		require '../modelos/conectar.php';
		$nombres=strtoupper($_POST["nombres"]);
		$apellidos= strtoupper ($_POST["apellidos"]);
		$edad=$_POST["edad"];
		$identidad= $_POST["numero_de_identidad"];
		$rtn= $_POST["rtn"];
		$profesion= strtoupper($_POST["profesion"]);
		$pasaporte= strtoupper($_POST["pasaporte"]);
		$numero_de_celular= $_POST["numero_de_celular"];
		$numero_de_telefono_fijo= $_POST["numero_de_telefono_fijo"];
		$fecha_de_nacimiento= $_POST["fecha_de_nacimiento"];
		$correo= $_POST["correo"];
		$direccion=strtoupper($_POST["direccion"]);
		$genero=$_POST["genero"];
		   
	   $sql="INSERT INTO TBL_PERSONAS (PER_NUMERO_IDENTIDAD,PER_PASAPORTE,PER_NOMBRE,PER_APELLIDO,PER_FECHA_NACIMIENTO,PER_EDAD,PER_GENERO,PER_TEL_FIJO,PER_CELULAR,PER_PROFESION,PER_DIRECCION,PER_CORREO,PER_RTN) 
	   VALUES (:identidad,:pasaporte,:nombres,:apellidos,:fecha_nacimiento,:edad,:genero,:tel_fijo,:tel_celular,:profesion,:direccion,:correo,:rtn)";
	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(":identidad"=>$identidad,":pasaporte"=>$pasaporte,":nombres"=>$nombres,":apellidos"=>$apellidos,":fecha_nacimiento"=>$fecha_de_nacimiento,":edad"=>$edad,":genero" =>$genero, ":tel_fijo"=>$numero_de_telefono_fijo,":tel_celular"=>$numero_de_celular,":profesion"=>$profesion,":direccion"=>$direccion,":correo"=>$correo,":rtn"=>$rtn  ));
	   

	  /* $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
	    $resultado2=$conexion->prepare($sql2);	
	 	$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'NUEVO',":descr"=>'CREO UN USUARIO EN MANTENIMIENTO',":fecha"=>$fecha_vencimiento));*/
		
	   if ($resultado) {
		//echo '<script>alert("Se ha registrado exitosamente");location.href= "../vistas/insertar_mant_vista.php"</script>';_f
		echo '<script>Swal.fire({
			position: "top-end",
			title: "BIEN!",
			text: "SE HA REGISTRADO EXITOSAMENTE EL PACIENTE",
			icon: "success",
			type: "success"
			}).then(function() {
			window.location = "../vistas/insertar_pacientes_vista.php";
			});
		</script>';
		
	}else{
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/insertar_mant_vista.php"</script>';	 
    echo '<script> Swal.fire({
	position: "center",
	icon: "error",
	title: "ERROR DATOS DEL PACIENTE NO SE REGISTRARON ",
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