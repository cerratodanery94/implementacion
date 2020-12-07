<?php	

	try{
		require '../modelos/conectar.php';
        if (isset($_POST['profesion']) )
		 {
		$profesion=strtoupper($_POST["profesion"]);
		
		$consulta=$conexion->prepare("SELECT * FROM TBL_OCUPACIONES WHERE OCU_NOMBRE='$profesion'");
        $consulta->execute();
        $num_rows = $consulta->fetchColumn();
        
       if ($num_rows>0){ 
		  
		   echo '<script> Swal.fire({
			position: "center",
			icon: "error",
			title: "PROFESION O OCUPACIÓN YA SE ENCUENTRA REGISTRADA",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';

       }else{	
        $sql="INSERT INTO TBL_OCUPACIONES (
			OCU_NOMBRE)	  

        VALUES (
         :profesion)";
 
        $resultado=$conexion->prepare($sql);	
        $resultado->execute(array(
            ":profesion"=>$profesion));
       
	   

	  /* $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
	    $resultado2=$conexion->prepare($sql2);	
	 	$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'NUEVO',":descr"=>'CREO UN USUARIO EN MANTENIMIENTO',":fecha"=>$fecha_vencimiento));*/
		
	   if ($resultado) {
		$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
	    $resultado2=$conexion->prepare($sql2);	
		$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>44,":accion"=>'NUEVO',":descr"=>'CREO UNA PROFESION/OCUPACION',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
		//echo '<script>alert("Se ha registrado exitosamente");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRO CORRECTAMENTA LA PROFESIÓN | OCUPACIÓN",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_profesiones.php";
                    });
                  </script>';	
	   } else {
		//echo '<script>alert("Error al registrarse");location.href= "../vistas/mostrar_pacientes_vista.php"</script>';	
		echo '<script> Swal.fire({
			position: "center",
			icon: "Error",
			title: "¡ALGO SALIÓ MAL!",
			text:"ERROR AL REGISTRAR LA PREGUNTA",
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