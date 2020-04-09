<?php	

	try{
		require '../modelos/conectar.php';
        if (isset($_POST['a']) and 
        isset($_POST['b']) or
        isset($_POST['c']) or 
		isset($_POST['d']) or 
		isset($_POST['e']) or 
		isset($_POST['f']) or 
		isset($_POST['g']) or
		isset($_POST['h']) or 
		isset($_POST['i']) or 
		isset($_POST['j']) or 
		isset($_POST['k']) or
		isset($_POST['rol']) or
		isset($_POST['pantalla']) 

		
		) {
        $a=$_POST["a"];
        $b=$_POST["b"];
        $c=$_POST["c"];
        $d=$_POST["d"];
        $e=$_POST["e"];
		$f=$_POST["f"];
		$g=$_POST["g"];
		$h=$_POST["h"];
		$i=$_POST["i"];
		$j=$_POST["j"];
		$k=$_POST["k"];
		$rol=$_POST["rol"];
		$pantalla=$_POST["pantalla"];
		
         
        if ($_POST['a']==NULL ) {
            $a=0;
           
        }
        if ($_POST['b']==NULL ) {
            $b=0;
           
        }
        if ($_POST['c']==NULL ) {
            $c=0;
           
        }
        if ($_POST['d']==NULL ) {
            $d=0;
           
		}
		
		if ($_POST['e']==NULL ) {
            $e=0;
           
		}
		
		if ($_POST['f']==NULL ) {
            $f=0;
           
		}
		
		if ($_POST['g']==NULL ) {
            $g=0;
           
		}
		
		if ($_POST['h']==NULL ) {
            $h=0;
           
		}
		
		if ($_POST['i']==NULL ) {
            $i=0;
           
		}
		
		if ($_POST['j']==NULL ) {
            $j=0;
           
		}
		
		if ($_POST['k']==NULL ) {
            $k=0;
           
        }
        

		
	
		
	   $sql="INSERT INTO tbl_permisos (
		   ROL_CODIGO,
		   OBJ_CODIGO,
		   PERM_CONSULTAR,
		   PERM_INSERTAR,
           PERM_ACTUALIZAR,	
           PERM_ELIMINAR,
		   PERM_USUARIO,
		   PERM_EMPLEADOS,
		   PERM_PACIENTES,
		   PERM_EXP_NUTRI,
		   PERM_EXP_MEDICO,
		   PERM_CITAS,
		   PERM_SEGURIDAD


		   ) 
		   
	   VALUES (
		:rol,
		:pantalla,   
        :a,
        :b,
		:c,
		:d,
		:e,
		:f,
		:g,
		:h,
		:i,
		:j,
		:k
		)";

	   $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
		":rol"=>$rol,
		":pantalla"=>$pantalla,  
        ":a"=>$a,
        ":b"=>$b,
        ":c"=>$c,
	    ":d"=>$d,
	    ":e"=>$e,
		":f"=>$f,
		":g"=>$g, 
		":h"=>$h,
		":i"=>$i,
		":j"=>$j,
		":k"=>$k
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