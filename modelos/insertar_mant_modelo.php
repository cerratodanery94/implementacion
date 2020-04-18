<?php	


if (!isset($_SESSION["id_us"])) {
	header('location:../vistas/login_vista.php');
  }
// Importar clases PHPMailer en el espacio de nombres global
// Deben estar en la parte superior de su script, no dentro de una función
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vistas/PHPMailer/Exception.php';
require '../vistas/PHPMailer/PHPMailer.php';
require '../vistas/PHPMailer/SMTP.php';

// La creación de instancias y pasar `true` permite excepciones
$mail = new PHPMailer(true);
//creo un token 

$caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$pass ="";
for($i=0;$i<8;$i++) {
$pass .=substr($caracteres,rand(0,53),1);
}

	try{
		require '../modelos/conectar.php';
		if (isset($_POST['rol_usuario']) && isset($_POST['nacionalidad']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['usuario']) && isset($_POST['correo'])) {
		$idrol=$_POST['rol_usuario'];
		$nombres= strtoupper ($_POST["nombres"]);
		$apellidos=strtoupper ( $_POST["apellidos"]);
		$usuario= strtoupper($_POST["usuario"]);
		$pass_cifrado=password_hash($pass,PASSWORD_DEFAULT,array("cost"=>12));
		$estado="NUEVO";
		$fecha_creacion= date("Y-m-d H:m:s");
		$fecha_vencimiento= date("Y-m-d H:m:s",strtotime("+1 years"));
		$correo= $_POST["correo"];
		$nacionalidad= $_POST["nacionalidad"];
		$identidad= $_POST["numero_de_identidad"];
		$rtn= $_POST["rtn"];
		$fecha_de_nacimiento= $_POST["fecha_de_nacimiento"];
		$numero_de_celular= $_POST["numero_de_celular"];
		$numero_de_telefono_fijo= $_POST["numero_de_telefono_fijo"];
		$genero=$_POST["genero"];
		$direccion=strtoupper($_POST["direccion"]);
		$pasaporte=strtoupper($_POST["pasaporte"]);
		

		$consulta=$conexion->prepare("SELECT * FROM TBL_USUARIO WHERE USU_USUARIO='$usuario'");
        $consulta->execute();
        $num_rows = $consulta->fetchColumn();
        
       if ($num_rows>0){ 
		   //echo '<script>alert("Usuario  ya se encuentran registrados ");location.href= "../vistas/insertar_mant_vista.php"</script>';
		   echo '<script> Swal.fire({
			position: "center",
			icon: "error",
			title: "USUARIO YA SE ENCUENTRA REGISTRADO",
			showConfirmButton: false,
			timer: 3000
		  })
		  </script>';

       }else{	
		$template_correo=file_get_contents('../vistas/template_correo.php');
		$template_correo=str_replace("{{pass}}",$pass,$template_correo);
		$template_correo=str_replace("{{year}}",date('Y'),$template_correo);
		
		$mail->SMTPDebug = 0;                       // Habilitar salida de depuración detallada
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();                                            // Enviar usando SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Configure el servidor SMTP para enviar a través de
		$mail->SMTPAuth   = true;                                   // Habilitar autenticación SMTP
		$mail->Username   = 'system32unah@gmail.com';                     // SMTP usuario
		$mail->Password   = 'coronavirus2020';                               // SMTP contraseña
		$mail->SMTPSecure = 'tsl';         // Habilitar el cifrado TLS; `PHPMailer :: ENCRYPTION_SMTPS` también aceptado
		$mail->Port       = 587;                                    // Puerto TCP para conectarse

		//Destinatarios
		$mail->setFrom('system32unah@gmail.com', 'System32');    //desde donde se va enviar
		$mail->addAddress( $correo);     // Agregar un destinatario

		$mail->isHTML(true);                                  // Establecer formato de correo electrónico a HTML
		$mail->Subject = 'Recuperar Contraseña';
		$mail->Body    = $template_correo;

		$mail->send();
		   
	   $sql="INSERT INTO TBL_USUARIO (
	   ROL_CODIGO,
	   PAIS_CODIGO,
	   USU_USUARIO,
	   USU_NOMBRES,
	   USU_APELLIDOS,
	   USU_PASSWORD,
	   USU_ESTADO,
	   USU_FECHA_CREACION,
	   USU_FECHA_VENCIMIENTO,
	   USU_TOKEN,
	   USU_FECHA_TOKEN,
	   USU_CORREO,
	   USU_FECHA_NACIMIENTO,
	   USU_CELULAR,
	   USU_TEL_FIJO,
	   USU_IDENTIDAD,
	   USU_RTN,
	   USU_GENERO,
	   USU_DIRECCION,
	   USU_PASAPORTE
	   
	   ) 

	   VALUES (
		:rol,
		:nacionalidad,
		:usuario,
		:nombres,
		:apellidos,
		:contra,
		:estado,
		:fecha_creacion,
		:fecha_vencimiento,
		'',
		'',
		:correo,
		:fecha_nacimiento,
		:tel_celular,
		:tel_fijo,
		:identidad,
		:rtn,
		:genero,
		:direccion,
		:pasaporte)";
	  
	 
	 
	  $resultado=$conexion->prepare($sql);	
	   $resultado->execute(array(
		   ":rol"=>$idrol,
		   ":nacionalidad"=>$nacionalidad,
		   ":usuario"=>$usuario,
		   ":nombres"=>$nombres,
		   ":apellidos"=>$apellidos,
		   ":contra"=>$pass_cifrado,
		   ":estado"=>$estado,
		   ":fecha_creacion" =>$fecha_creacion,
			":fecha_vencimiento"=>$fecha_vencimiento,
			":correo"=>$correo,
			":fecha_nacimiento"=>$fecha_de_nacimiento,
			":tel_celular"=>$numero_de_celular,
			":tel_fijo"=>$numero_de_telefono_fijo,
			":identidad"=>$identidad,
			":rtn"=>$rtn,
			":genero"=>$genero,
			":direccion"=>$direccion,
			":pasaporte"=>$pasaportes


		));
	   

	   
		
	   if ($resultado) {
		$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
		VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
	    $resultado2=$conexion->prepare($sql2);	
		$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'NUEVO',":descr"=>'CREO UN USUARIO',":fecha"=>date("Y-m-d H:i:s")));
		echo '<script>
                    Swal.fire({
                    title: "¡BIEN!",
                    position: "center",
                    text: "SE REGISTRO CORRECTAMENTE EL USUARIO",
                    icon: "success",
                    type: "success"
                    }).then(function() {
                    window.location = "../vistas/mostrar_vista.php";
                    });
                  </script>';
	   } else {
		
	//echo '<script>alert("Error al registrarse");location.href= "../vistas/insertar_mant_vista.php"</script>';	
	echo '<script> Swal.fire({
		position: "center",
		icon: "Error",
		title: "¡ALGO SALIÓ MAL!",
		text:"ERROR AL REGISTRAR USUARIO",
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