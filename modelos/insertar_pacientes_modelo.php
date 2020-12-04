<?php	

	try{
		require '../modelos/conectar.php';
		if (isset($_POST['nombres'])&& isset($_POST['apellidos'])) {
		$nombres=strtoupper($_POST["nombres"]);
		$apellidos= strtoupper ($_POST["apellidos"]);
		$identidad= $_POST["numero_de_identidad"];
		$rtn= $_POST["rtn"];
		$profesion= $_POST["profesion"];
		$pasaporte= strtoupper($_POST["pasaporte"]);
		$numero_de_celular= $_POST["numero_de_celular"];
		$numero_de_telefono_fijo= $_POST["numero_de_telefono_fijo"];
		$fecha_de_nacimiento= $_POST["fecha_de_nacimiento"];
		$correo=  strtolower($_POST["correo"]);
		$direccion=strtoupper($_POST["direccion"]);
		$genero=$_POST["genero"];
		$fecha_creacion= date("Y-m-d H:m:s");
		$nacionalidad=$_POST["nacionalidad"];

		$consulta=$conexion->prepare("SELECT * FROM TBL_PERSONAS WHERE PER_NUMERO_IDENTIDAD='$identidad'");
        $consulta->execute();
        $num_rows = $consulta->fetchColumn();
        
       if ($num_rows>0){ 
		   //echo '<script>alert("Usuario  ya se encuentran registrados ");location.href= "../vistas/insertar_mant_vista.php"</script>';
		   echo '<script> Swal.fire({
			position: "center",
			icon: "error",
			title: "LA IDENTIDAD DEL YA SE ENCUENTRA REGISTRADA ",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';

       }else{	
		
	   $sql="INSERT INTO TBL_PERSONAS (
		   PAIS_CODIGO,
		   OCU_CODIGO,
		   PER_NUMERO_IDENTIDAD,
		   PER_PASAPORTE,
		   PER_NOMBRES,
		   PER_APELLIDOS,
		   PER_FECHA_NACIMIENTO,
		   PER_FECHA_CREACION,
		   PER_GENERO,
		   PER_TEL_FIJO,
		   PER_CELULAR,
		   PER_DIRECCION,
		   PER_CORREO,
		   PER_RTN) 
		   
	   VALUES (
		:nacionalidad,
		:profesion,
		:identidad,
		:pasaporte,
		:nombres,
		:apellidos,
		:fecha_nacimiento,
		:fecha_creacion,
		:genero,
		:tel_fijo,
		:tel_celular,
		:direccion,
		:correo,
		:rtn)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
		   ":nacionalidad"=>$nacionalidad,
		   ":profesion"=>$profesion,
		   ":identidad"=>$identidad,
		   ":pasaporte"=>$pasaporte,
		   ":nombres"=>$nombres,
		   ":apellidos"=>$apellidos,
		   ":fecha_nacimiento"=>$fecha_de_nacimiento,
		   ":fecha_creacion"=>$fecha_creacion,
		   ":genero" =>$genero, 
		   ":tel_fijo"=>$numero_de_telefono_fijo,
		   ":tel_celular"=>$numero_de_celular,
		   ":direccion"=>$direccion,
		   ":correo"=>$correo,
		   ":rtn"=>$rtn));
	   

		
	   if ($resultado) {
		$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
	    $resultado2=$conexion->prepare($sql2);	
		$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>16,":accion"=>'NUEVO',":descr"=>'CREO UN PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRO CORRECTAMENTE EL PACIENTE",
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
			text:"ERROR AL REGISTRAR PACIENTE",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';
	}
		$resultado->closeCursor();
		$resultado2->closeCursor();
 }
}
	}catch(Exception $e){			
		
        die('Error: ' . $e->GetMessage());
		echo "Codigo del error" . $e->getCode();	
	}

?>
</body>
</html>