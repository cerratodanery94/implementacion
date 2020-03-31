<?php	

	try{
		require '../modelos/conectar.php';
		if (isset($_POST['id'])&& 
		isset($_POST['apuntes'])&& 
		isset($_POST['medicamento'])&&
		isset($_POST['fecha_de_creacion'])&&
		isset($_FILES['foto'] )
		){
		$id=$_POST["id"];
		$apuntes=strtoupper ($_POST["apuntes"]);
		$medicamento=strtoupper($_POST["medicamento"]);
		$fecha_de_creacion=$_POST["fecha_de_creacion"];
		$file=$_FILES["foto"];
		$nombre=$file["name"];
		$ruta_provisional=$file["tmp_name"];
		$carpeta="fotos/";
		
		$src=$carpeta.$nombre;
		move_uploaded_file($ruta_provisional,$src);
		$imagen="fotos/".$nombre;
		
	   $sql="INSERT INTO tbl_expedientes (
		   PER_CODIGO,
		   EXP_FECHA_CREACION,
		   EXP_ANTECEDENTES_CLINICOS,
		   EXP_MEDICAMENTO,
		   EXP_FOTO) 
		   
	   VALUES (
		:id,
		:fecha_creacion,
		:apuntes,
		:medicamento,
		:foto
	
		)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
		   ":id"=>$id,
		   ":fecha_creacion"=>$fecha_de_creacion,
		   ":apuntes"=>$apuntes,
		   ":medicamento"=>$medicamento, 
		   ":foto"=>$imagen));
	   

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
                    text: "SE REGISTRO CORRECTAMENTE EL EXPEDIENTE",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_expediented_vista.php";
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