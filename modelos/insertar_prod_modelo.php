<?php	
	try{
		require '../modelos/conectar.php';
        if (isset($_POST['prod']) && 
        isset($_POST['descrip']) && 
        isset($_POST['precio']) && 
        isset($_POST['f_venc']) ) {
		$prod=strtoupper($_POST["prod"]);
        $descrip=strtoupper($_POST["descrip"]);
        $precio= $_POST["precio"];
		$f_venc= $_POST["f_venc"];
		
	   $sql="INSERT INTO TBL_PRODUCTOS (
		   PROD_NOMBRE,
		   PROD_DESCRIPCION,
		   PROD_PRECIO,
		   PROD_FECHA_VENCIMIENTO
		   )	   
	   VALUES (
		:prod,
		:descrip,
		:precio,
		:f_venc)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
		   ":prod"=>$prod,
		   ":descrip"=>$descrip,
		   ":precio"=>$precio,
		   ":f_venc"=>$f_venc));
	   

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
                    text: "SE REGISTRO CORRECTAMENTE EL PRODUCTO",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_prod_vista.php";
                    });
                  </script>';	
	   } else {
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';	
		echo '<script> Swal.fire({
			position: "center",
			icon: "Error",
			title: "¡ALGO SALIÓ MAL!",
			text:"ERROR AL REGISTRAR PRODUCTO",
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