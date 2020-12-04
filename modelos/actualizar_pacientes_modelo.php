<?php

require '../modelos/conectar.php';
try {
    if (isset($_POST['nombres'])&& isset($_POST['apellidos'])) {
        $ide=$_POST['ide'];
        $identidada=$_POST["identidada"];
        $identidadn=$_POST["identidadn"];
        $pasaporte1=$_POST["pasaporte"];
        $nombres1=$_POST["nombres"];
        $apellidos1=$_POST["apellidos"];
        $fecha_de_nacimiento1=$_POST["fecha_de_nacimiento"];
        $fecha_creacion1=$_POST["fecha_creacion"];
        $genero1=$_POST["genero"];
        $numero_de_telefono_fijo1=$_POST["numero_de_telefono_fijo"];
        $numero_de_celular1= $_POST["numero_de_celular"];
        $profesion1=$_POST["profesion"];
        $direccion1=$_POST["direccion"];
        $correo1=  strtolower($_POST["correo"]);
        $nacionalidad1=$_POST["nacionalidad"];
        $rtn1=$_POST["rtn"];
        
        if ($identidada!=$identidadn) {
          $consulta3=$conexion->prepare("SELECT * FROM tbl_personas WHERE PER_NUMERO_IDENTIDAD=:r");
          $consulta3->execute(array(":r"=>$identidadn));
          if($consulta3->rowCount()>=1){
           echo '<script>Swal.fire({
        position: "center",
        icon: "error",
        title: "¡ERROR!",
        text:"INDENTIDAD  YA SE HA  ENCUENTRA REGISTRADA",
        showConfirmButton: false,
        timer: 3000
          })
        </script>';
           exit();
          }else{
            $identidadf=$identidadn;
          }
        } else {
          $identidadf=$identidada;
        }
            
          
        $query=$conexion->prepare
        ("UPDATE TBL_PERSONAS SET
        PAIS_CODIGO=:nacionalidad,
        OCU_CODIGO=:ocupacion,
        PER_NUMERO_IDENTIDAD=:identidad,
        PER_PASAPORTE=:pasaporte,
        PER_NOMBRES=:nombres,
        PER_APELLIDOS=:apellidos,
        PER_FECHA_NACIMIENTO=:fecha_nacimiento,
        PER_FECHA_CREACION=:fecha_creacion,
        PER_GENERO=:genero,
        PER_TEL_FIJO=:tel_fijo,
        PER_CELULAR=:tel_celular,
        PER_DIRECCION=:direccion,
        PER_CORREO=:correo,
        PER_RTN=:rtn
        WHERE PER_CODIGO=:ide");
      
         $query->execute(array(
          ":nacionalidad"=>$nacionalidad1,
          ":ocupacion"=>$profesion1,
          ":identidad"=>$identidadf,
              ":pasaporte"=>$pasaporte1,
              ":nombres"=>$nombres1,
              ":apellidos"=>$apellidos1,
              ":fecha_nacimiento"=>$fecha_de_nacimiento1,
              ":fecha_creacion"=>$fecha_creacion1,
              ":genero"=>$genero1,
              ":tel_fijo"=>$numero_de_telefono_fijo1,
              ":tel_celular"=>$numero_de_celular1,
              ":direccion"=>$direccion1,
              ":correo"=>$correo1,
              
          ":rtn"=>$rtn1,
          ":ide"=>$ide));
          if($query){
            $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
            VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
              $resultado2=$conexion->prepare($sql2);	
            $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>19,":accion"=>'EDITAR',":descr"=>'ACTUALIZO INFORMACION DE PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
            //echo '<script>alert("SE HA ACTUALIZADO PACIENTE CORRECTAMENTE");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO PACIENTE CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_pacientes_vista.php";
            });
          </script>';
          }else{
            // echo '<script>alert("ERROR NO SE ACTUALIZO REGISTRO");window.location.href="../vistas/mostrar_pacientes_vista.php"</script>';
            echo '<script> 
             Swal.fire({
             position: "center",
             icon: "Error",
             title: "¡ALGO SALIÓ MAL!",
             text:"NO SE ACTUALIZO REGISTRO",
             showConfirmButton: false,
             timer: 3000
             })
             </script>';
          }
      
        
      }
      
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}
?>