<?php	

	try{
		require '../modelos/conectar.php';
        if (isset($_POST['r']) and 
        isset($_POST['o']) or
        isset($_POST['c']) or 
		isset($_POST['i']) or 
		isset($_POST['a']) or 
		isset($_POST['m']) or 
        isset($_POST['e']) ) {
        $r=$_POST["r"];
        $o=$_POST["o"];
        $c=$_POST["c"];
        $i=$_POST["i"];
        $a=$_POST["a"];
		$e=$_POST["e"];
		$m=$_POST["m"];
         
        if ($_POST['c']==NULL ) {
            $c=0;
           
        }
        if ($_POST['i']==NULL ) {
            $i=0;
           
        }
        if ($_POST['a']==NULL ) {
            $a=0;
           
        }
        if ($_POST['e']==NULL ) {
            $e=0;
           
		}
		
		if ($_POST['m']==NULL ) {
            $m=0;
           
        }
        

		
	
		
	   $sql="INSERT INTO tbl_permisos (
		   ROL_CODIGO,
		   OBJ_CODIGO,
		   PERM_CONSULTAR,
		   PERM_INSERTAR,
           PERM_ACTUALIZAR,	
           PERM_ELIMINAR,
		   PERM_OBJ
		   ) 
		   
	   VALUES (
        :r,
        :o,
		:c,
		:i,
		:a,
		:e,
		:m
		)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
        ":r"=>$r,
        ":o"=>$o,
        ":c"=>$c,
	    ":i"=>$i,
	   ":a"=>$a,
		":e"=>$e,
		":m"=>$m 
	));
	   

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
                    window.location = "../vistas/insertar_permisos_vista.php";s
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