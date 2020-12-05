<?php	

	try{
		require '../modelos/conectar.php';
		
        if (isset($_POST['id_p'])&& 
        isset($_POST['id_u'])&&
		isset($_POST['fecha_cita'])&& 
		isset($_POST['id_h'])&&
        isset($_POST['estado'])){
        $id_p=$_POST["id_p"];
		$id_u=$_POST["id_u"];
		$id_h=$_POST['id_h'];
		$fecha_cita=$_POST["fecha_cita"];
        $estado=$_POST["estado"];
		$descrip='';
		$hoy=date('Y-m-d');
		if ($fecha_cita < $hoy) {
			echo '<script> Swal.fire({
				position: "center",
				icon: "error",
				title: "NO SE PUEDE REGISTRAR CITA CON UNA FEHA INFERIOR A LA ACTUAL",
				showConfirmButton: false,
				timer: 3000
			  })
			  </script>';
		}else{ 
		
		$consulta=$conexion->prepare("SELECT * FROM TBL_CITAS WHERE CIT_FECHA_CITA='$fecha_cita' and HOR_CODIGO='$id_h' and USU_CODIGO='$id_u'");
        $consulta->execute();
        $num_rows = $consulta->fetchColumn();
        
       if ($num_rows>0){ 
		   //echo '<script>alert("Usuario  ya se encuentran registrados ");location.href= "../vistas/insertar_mant_vista.php"</script>';
		   echo '<script> Swal.fire({
			position: "center",
			icon: "error",
			title: "NO SE PUEDE REGISTRAR CITA YA ESTA RESERVADA EN ESA FECHA Y HORA",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';

       }else{	

		$consulta3=$conexion->prepare("select COUNT(HOR_CODIGO) hora_repetida from tbl_citas WHERE PER_CODIGO = ".$id_p." and CIT_FECHA_CITA = '".$fecha_cita."' and HOR_CODIGO = ".$id_h);
        $consulta3->execute();
		$fila = $consulta3->fetchAll();
		
	

		$contar_cita = $fila[0][0] ;
		
		if ($contar_cita> 0) {
			echo '<script> Swal.fire({
				position: "center",
				icon: "error",
				title: "USUARIO NO PUEDE TENER 2 CITAS A LA MISMA HORA",
				showConfirmButton: false,
				timer: 3000
			  })
			  </script>';
		} else {

			$sql="INSERT INTO tbl_citas (
				PER_CODIGO,
				USU_CODIGO,
				HOR_CODIGO,
				CIT_FECHA_CITA,
				CIT_ESTADO,
				CIT_DESCRIPCION,
				CIT_ESTADO_REGISTRO) 
				
			VALUES (
			 :id_p,
			 :id_u,
			 :id_h,
			 :fecha_cita,
			 :estado,
			 :descrip,
			 :er
			  )";
	 
			$resultado=$conexion->prepare($sql);	
			$resultado->execute(array(
			 ":id_p"=>$id_p,
			 ":id_u"=>$id_u,
			 ":id_h"=>$id_h,
			 ":fecha_cita"=>$fecha_cita,
			 ":estado"=>$estado,
			 ":descrip"=>NULL,
			  "er"=>'A'));
			 
			if ($resultado) {
			 $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
			 VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
			 $resultado2=$conexion->prepare($sql2);	
			 $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>27,":accion"=>'NUEVO',":descr"=>'CREO UNA CITA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
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
	   
}
}
}
	}catch(Exception $e){			
		
        die('Error: ' . $e->GetMessage());
		echo "Codigo del error" . $e->getCode();	
	}

?>
</body>
</html>