<?php
try {
    require '../modelos/conectar.php';
    if (isset($_POST['actualizar_empleado'])) {
        $ide=$_POST['ide'];
        $identidad1=$_POST['numero_de_identidad'];
        $nombres1=strtoupper($_POST['nombres']);
        $apellidos1=strtoupper($_POST['apellidos']);
        $fecha_nacimiento1=$_POST['fecha_de_nacimiento'];
        $edad1=$_POST['edad'];
        $tel_fijo1=$_POST['numero_de_telefono_fijo'];
        $celular1=$_POST['numero_de_celular'];
        $cargo1=strtoupper($_POST['cargo']);
        $fecha_contratacion1=$_POST['fecha_de_contratacion'];
        $genero1=strtoupper($_POST['genero']);
        $correo1=$_POST['correo'];
        $direccion1=strtoupper($_POST['direccion']);
        $nacionalidad1=strtoupper($_POST['nacionalidad']);
        $rtn1=$_POST['rtn'];
        
        $query=$conexion->prepare("UPDATE TBL_EMPLEADOS SET
        EMP_NUMERO_IDENTIDAD=:identidad,
        EMP_NOMBRES=:nombres,
        EMP_APELLIDOS=:apellidos,
        EMP_FECHA_NACIMIENTO=:f_nacimiento,
        EMP_EDAD=:edad,
        EMP_TEL_FIJO=:tel_fijo,
        EMP_CELULAR=:celular,
        EMP_CARGO=:cargo,
        EMP_FECHA_CONTRATACION=:f_contratacion,
        EMP_GENERO=:genero,
        EMP_CORREO=:correo,
        EMP_DIRECCION=:direccion,
        EMP_NACIONALIDAD=:nacionalidad,
        EMP_RTN=:rtn
        
        WHERE EMP_CODIGO=:ide ");
         $query->execute(array(
          ":identidad"=>$identidad1,
          ":nombres"=>$nombres1,
          ":apellidos"=>$apellidos1,
          ":f_nacimiento"=>$fecha_nacimiento1,
          ":edad"=>$edad1,
          ":tel_fijo"=>$tel_fijo1,
          ":celular"=>$celular1,
          ":cargo"=>$cargo1,
          ":f_contratacion"=>$fecha_contratacion1,
          ":genero"=>$genero1,
          ":correo"=>$correo1,
          ":direccion"=>$direccion1,
          ":nacionalidad"=>$nacionalidad1,
          ":rtn"=>$rtn1,
          ":ide"=>$ide )) ;
          if($query){
            //header("location:../vistas/mostrar_empleados_vista.php");
            echo '<script>
            Swal.fire({
            title: "¡BIEN!",
            position: "center",
            text: "SE HA ACTUALIZADO EMPLEADO CORRECTAMENTE",
            icon: "success",
            type: "success"
            }).then(function() {
            window.location = "../vistas/mostrar_empleados_vista.php";
            });
          </script>';
           }else{
             //echo '<script>alert("ERROR NO SE ACTUALIZO REGISTRO");window.location.href="../vistas/mostrar_empleados_vista.php"</script>';
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