<?php	
	try{
		require '../modelos/conectar.php';
        if (isset($_POST['prov']) && 
        isset($_POST['correo']) && 
        isset($_POST['direccion']) && 
        isset($_POST['tel_prov']) && 
        isset($_POST['nom_repre'])&& 
        isset($_POST['cel_repre'])) {
		$prov=strtoupper($_POST["prov"]);
        $correo= $_POST["correo"];
        $direccion=strtoupper($_POST["direccion"]);
        $tel_prov= $_POST["tel_prov"];
        $nom_repre=strtoupper($_POST["nom_repre"]);
		$cel_repre= $_POST["cel_repre"];
		
	   $sql="INSERT INTO TBL_PROVEEDORES (
		   PROV_NOMBRE,
		   PROV_CONTACTO,
		   PROV_TELEFONO_CONTACTO,
		   PROV_DIRECCION,
		   PROV_CORREO,
		   PROV_TELEFONO)	   
	   VALUES (
		:prov,
		:nom_repre,
		:cel_repre,
		:direccion,
		:correo,
		:tel_prov)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
		   ":prov"=>$prov,
		   ":nom_repre"=>$nom_repre,
		   ":cel_repre"=>$cel_repre,
		   ":direccion"=>$direccion,
		   ":correo"=>$correo,
		   ":tel_prov"=>$tel_prov));
	   

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
                    text: "SE REGISTRO CORRECTAMENTE EL PROVEEDOR",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_prov_vista.php";
                    });
                  </script>';	
	   } else {
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';	
		echo '<script> Swal.fire({
			position: "center",
			icon: "Error",
			title: "¡ALGO SALIÓ MAL!",
			text:"ERROR AL REGISTRAR PROVEEDOR",
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