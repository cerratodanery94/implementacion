<?php	

	try{
		require '../modelos/conectar.php';
        if (isset($_POST['rol']) && 
		isset($_POST['descrip']) ) {
		$rol=strtoupper($_POST["rol"]);
		$descrip=strtoupper($_POST["descrip"]);

		$consulta=$conexion->prepare("SELECT * FROM TBL_ROL WHERE ROL_NOMBRE='$rol'");
        $consulta->execute();
        $num_rows = $consulta->fetchColumn();
        
       if ($num_rows>0){ 
		   echo '<script> Swal.fire({
			position: "center",
			icon: "error",
			title: "ROL YA SE ENCUENTRA REGISTRADO",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';
		}else{
        $sql="INSERT INTO TBL_ROL (
            ROL_NOMBRE,
            ROL_DESCRIPCION
            )	   
        VALUES (
         :rol,
         :descrip)";
 
        $resultado=$conexion->prepare($sql);	
        $resultado->execute(array(
            ":rol"=>$rol,
            ":descrip"=>$descrip));
		
	   if ($resultado) {
		$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
	    $resultado2=$conexion->prepare($sql2);	
		$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>34,":accion"=>'NUEVO',":descr"=>'CREO UN ROL',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
		//echo '<script>alert("Se ha registrado exitosamente");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRO CORRECTAMENTE EL ROL",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_roles_vista.php";
                    });
                  </script>';	
	   } else {
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';	
		echo '<script> Swal.fire({
			position: "center",
			icon: "Error",
			title: "¡ALGO SALIÓ MAL!",
			text:"ERROR AL REGISTRAR ROL",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';
	}
		$resultado->closeCursor();
		$resultado2->closeCursor();
		$consulta->closeCursor();
	}
}
	}catch(Exception $e){			
		
        die('Error: ' . $e->GetMessage());
		echo "Codigo del error" . $e->getCode();	
	}

?>
</body>
</html>