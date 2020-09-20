<?php

try{
	require '../modelos/conectar.php';
	if (isset($_POST['login']) && isset($_POST['contra2'])) {
	$login=strtoupper(htmlentities(addslashes($_POST["login"])));
	$password=htmlentities(addslashes($_POST["contra2"]));
	$estado='BLOQUEADO';
	$contador=0;
	$sql="SELECT * FROM TBL_USUARIO WHERE USU_USUARIO= :login";
	$resultado=$conexion->prepare($sql);	
	$resultado->execute(array(":login"=>$login));
	session_start();
	if (!isset($_SESSION['cont_inte'])){
		$_SESSION['cont_inte']=0;
		 } 
		 $sql5='SELECT * FROM TBL_PARAMETROS WHERE PARMT_CODIGO=2';
	        $resultado5=$conexion->query($sql5);	
		     while($registro5=$resultado5->fetch(PDO::FETCH_ASSOC)){			
				$_SESSION['parametro']=	$registro5['PARMT_VALOR'];
            }
		while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){			
				if (password_verify($password,$registro['USU_PASSWORD'])) {
					$_SESSION["id_us"]=$registro['USU_CODIGO'];
					$_SESSION["usu"]=$registro['USU_USUARIO'];
					$_SESSION["est"]=$registro['USU_ESTADO'];
					$_SESSION["ROL"]=$registro['ROL_CODIGO'];
					$contador++;
				}	
		}
		if ($contador>0){
		
				if ($_SESSION["est"]=="NUEVO" and $_SESSION["ROL"]==2) {
					    $sql8="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado8=$conexion->prepare($sql8);	
						$resultado8->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
                         
						$sql9="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado9=$conexion->prepare($sql9);	
						$resultado9->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
				
					header("location:../vistas/preguntas_vista.php"); 

				}elseif ($_SESSION["est"]=="ACTIVO" and $_SESSION["ROL"]==2) {
					$sql10="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
					VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
					$resultado10=$conexion->prepare($sql10);	
					$resultado10->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

					$sql11="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
					VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
					$resultado11=$conexion->prepare($sql11);	
					$resultado11->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
					
					header("location:../vistas/index.php");

					}elseif ($_SESSION["est"]=="ACTIVO" and $_SESSION["ROL"]==1) {
						$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado2=$conexion->prepare($sql2);	
						$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

						$sql7="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado7=$conexion->prepare($sql7);	
						$resultado7->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

						header("location:../vistas/index2.php"); 

					}elseif ($_SESSION["est"]=="NUEVO" and $_SESSION["ROL"]==1) {
						$sql17="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado17=$conexion->prepare($sql17);	
						$resultado17->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
	
						$sql18="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado18=$conexion->prepare($sql18);	
						$resultado18->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
						
						header("location:../vistas/preguntas_vista.php"); 
					
					}elseif ($_SESSION["est"]=="ACTIVO" and $_SESSION["ROL"]==3) {
						$sql15="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado15=$conexion->prepare($sql15);	
						$resultado15->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

						$sql16="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado16=$conexion->prepare($sql16);	
						$resultado16->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
					
						header("location:../vistas/index2.php");  
					
					}elseif ($_SESSION["est"]=="NUEVO" and $_SESSION["ROL"]==3) {
						$sql19="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado19=$conexion->prepare($sql19);	
						$resultado19->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
	
						$sql20="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado20=$conexion->prepare($sql20);	
						$resultado20->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
						
						header("location:../vistas/preguntas_vista.php"); 

					}elseif ($_SESSION["est"]=="ACTIVO" and $_SESSION["ROL"]==4) {
							$sql23="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
							VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
							$resultado23=$conexion->prepare($sql23);	
							$resultado23->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
	
							$sql24="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
							VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
							$resultado24=$conexion->prepare($sql24);	
							$resultado24->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
						header("location:../vistas/index2.php");
					
					}elseif ($_SESSION["est"]=="NUEVO" and $_SESSION["ROL"]==4) {
						$sql21="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado21=$conexion->prepare($sql21);	
						$resultado21->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'INGRESO',":descr"=>'INGRESO A LA PANTALLA DE LOGIN',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
	
						$sql22="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
						VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
						$resultado22=$conexion->prepare($sql22);	
						$resultado22->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>2,":accion"=>'CONSULTA',":descr"=>'VERIFICA LAS CREDENCIALES DEL USUARIO',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
						
						header("location:../vistas/preguntas_vista.php"); 
					
					}
					
					
					elseif ($_SESSION["est"]=="BLOQUEADO" ) {
						echo '<script> Swal.fire({
							position: "center",
							icon: "info",
							title: "SU USUARIO HA SIDO BLOQUEADO. CONTACTE CON EL ADMINISTRADOR",
							showConfirmButton: false,
							timer: 3000
						  })
						  </script>';    
					}
	
		}else{
			
				
				if ($_SESSION['cont_inte']<$_SESSION['parametro']){
					++$_SESSION['cont_inte'];
					echo '<script> Swal.fire({
						position: "center",
						icon: "error",
						title: "USUARIO O CONTRASEÑA INCORRECTA",
						showConfirmButton: false,
						timer: 3000
					  })
					  </script>';
				}else {
					$sql3=("UPDATE TBL_USUARIO SET  USU_ESTADO=:estado WHERE USU_USUARIO=:usu");
					$resultado3=$conexion->prepare($sql3);
					$resultado3->execute(array(":estado"=>$estado,":usu"=>$login));
					unset($_SESSION['cont_inte']); 
				   echo '<script> Swal.fire({
					position: "center",
					icon: "warning",
					title: "HAZ SUPERADO EL NÚMERO DE INTENTOS Y EL ACCESO A ESTA CUENTA HA SIDO BLOQUEADO. CONTACTE CON EL ADMINISTRADOR",
					showConfirmButton: false,
					timer: 5000
				  })
				  </script>';     
				}
			   
		}
		$resultado->closeCursor();
		
		}
}catch(Exception $e){
    die('Error: ' . $e->GetMessage());
    echo "Codigo del error" . $e->getCode();
}