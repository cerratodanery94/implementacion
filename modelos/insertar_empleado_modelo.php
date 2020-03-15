<?php	
	try{
		require '../modelos/conectar.php'; 
		if (isset($_POST['insertar_emp']) ) {
			$nombres=strtoupper($_POST["nombres"]);
			$apellidos= strtoupper ($_POST["apellidos"]);
			$edad=$_POST["edad"];
			$identidad= $_POST["numero_de_identidad"];
			$rtn= $_POST["rtn"];
			$cargo= strtoupper($_POST["cargo"]);
			$numero_de_celular= $_POST["numero_de_celular"];
			$numero_de_telefono_fijo= $_POST["numero_de_telefono_fijo"];
			$fecha_de_nacimiento= $_POST["fecha_de_nacimiento"];
			$fecha_de_contratacion= $_POST["fecha_de_contratacion"];
			$correo= $_POST["correo"];
			$nacionalidad= strtoupper($_POST["nacionalidad"]);
			$direccion=strtoupper($_POST["direccion"]);
			$genero=$_POST["genero"];
			
	   $sql="INSERT INTO TBL_EMPLEADOS (EMP_NUMERO_IDENTIDAD,EMP_NOMBRES,EMP_APELLIDOS,EMP_FECHA_NACIMIENTO,EMP_EDAD,EMP_TEL_FIJO,EMP_CELULAR,EMP_CARGO,EMP_FECHA_CONTRATACION,EMP_GENERO,EMP_CORREO,EMP_DIRECCION,EMP_NACIONALIDAD,EMP_RTN) 
	   VALUES (:identidad,:nombres,:apellidos,:fecha_nacimiento,:edad,:tel_fijo,:tel_celular,:cargo,:fecha_contratacion,:genero,:correo,:direccion,:nacionalidad,:rtn)";
	   $resultado=$conexion->prepare($sql);	
	  
	   $resultado->execute(array(
	   ":identidad"=>$identidad,
	   ":nombres"=>$nombres,
	   ":apellidos"=>$apellidos,
	   ":fecha_nacimiento"=>$fecha_de_nacimiento,
	   ":edad"=>$edad,
	   ":tel_fijo"=>$numero_de_telefono_fijo,
	   ":tel_celular"=>$numero_de_celular,
	   ":cargo"=>$cargo,
	   ":fecha_contratacion"=>$fecha_de_contratacion,
	   ":genero"=>$genero,
	   ":correo"=>$correo,
	   ":direccion"=>$direccion,
	   ":nacionalidad"=>$nacionalidad,
	   ":rtn"=>$rtn ));
	  /* $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
	    $resultado2=$conexion->prepare($sql2);	
	 	$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'NUEVO',":descr"=>'CREO UN USUARIO EN MANTENIMIENTO',":fecha"=>$fecha_vencimiento));*/
		
	   if ($resultado) {
		//echo '<script>alert("Se ha registrado exitosamente");location.href= "../vistas/mostrar_empleados_vista.php"</script>';
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRADO EMPLEADO CORRECTAMENTE",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_empleados_vista.php";
                    });
                  </script>';	
	   } else {
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/insertar_mant_vista.php"</script>';	
		echo '<script> Swal.fire({
			position: "center",
			icon: "Error",
			title: "¡ALGO SALIÓ MAL!",
			text:"ERROR AL REGISTRAR EMPLEADO",
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