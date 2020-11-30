<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require '../modelos/conectar.php';
  require '../controladores/funciones.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>18,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA MOSTRAR INFORMACION DEL PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));         
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>18,":accion"=>'CONSULTA',":descr"=>'MUESTRA LA INFORMACION DEL PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM TBL_PERSONAS WHERE PER_CODIGO= :id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
       $fila=$resultado->fetch();
       $id_u=$fila['PER_CODIGO'];
       $identidad=$fila['PER_NUMERO_IDENTIDAD'];
       $pasaporte=$fila['PER_PASAPORTE'];
       $nombres=$fila['PER_NOMBRES'];
       $apellidos=$fila['PER_APELLIDOS'];
       $fecha_nacimiento=$fila['PER_FECHA_NACIMIENTO'];
       $edad=mi_edad($fila['PER_FECHA_NACIMIENTO']);
       $fecha_creacion=$fila['PER_FECHA_CREACION'];
       $genero=$fila['PER_GENERO'];
       $tel_fijo=$fila['PER_TEL_FIJO'];
       $celular=$fila['PER_CELULAR'];
       
       $direccion=$fila['PER_DIRECCION'];
       $correo=$fila['PER_CORREO'];
       
       $rtn=$fila['PER_RTN'];
     
   }
  }
  
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}

?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mostrar Información</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../vistas/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.min.css">
  <link rel="icon" href="../vistas/Img/Home.png">

  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>H</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CLIME</b>HOME</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="../modelos/cerrar_sesion_modelo.php">  
            <i class="fa fa-sign-out"></i>
            SALIR
            </a>
            <ul class="dropdown-menu">
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <?php require '../vistas/barra.php';  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1><i class="fa fa-file-text-o" aria-hidden="true"></i>
      Información del paciente
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="../vistas/mostrar_pacientes_vista.php"><i class="fa fa-users"></i>Pacientes</a></li>
        <li class="active"><i class="fa fa-file-text-o"></i> Información del paciente</li>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <!--llamar funciones-->
            <div class="box-body">
           <div>

           <div class="form-group col-lg-6 col-md-6 col-xs-12">
        <div class="input-group">
                <span class="input-group-addon">Nombres</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder=""  name="nombres" id="nombres"value="<?php echo $nombres?>" readonly  >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Apellidos</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder=""  name="apellidos" id="apellidos" value="<?php echo $apellidos?>" readonly >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  </div>
                </div>
            
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Identidad</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="EDAD"  name="numero_de_identidad" id="numero_de_identidad" value="<?php echo $identidad?>" readonly >
                  <span class="	glyphicon glyphicon-credit-card form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de nacimiento</span>
                  <input type="date" autocomplete="off" class="form-control nombres" placeholder="FECHA DE NACIMIENTO" name="fecha_de_nacimiento" id="fecha_de_nacimiento"value="<?php echo $fecha_nacimiento?>" readonly >
                  </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Edad</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="EDAD"  name="edad" id="edad"value="<?php echo $edad?>"readonly>
                  <span class="glyphicon glyphicon-hourglass form-control-feedback"></span>
                </div>
                </div>


               <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Género</span>
                <select class="form-control" name="genero" id="genero" disabled>
                 <option value="0">Seleccione un género:</option>
                 <option value="FEMENINO"
                 <?php
                 if ($genero=='FEMENINO') {
                    echo 'selected';
                 }
                 ?>
                 >FEMENINO</option>
                 <option value="MASCULINO"
                 <?php
                 if ($genero=='MASCULINO') {
                    echo 'selected';
                 }
                 ?>
                 >MASCULINO</option>
                 
                </select>
                </div>
                </div>


                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Nacionalidad</span>
                <select class="form-control" name="nacionalidad" id="nacionalidad" disabled>
        <option value="0">Seleccione una nacionalidad</option>
                <?php
               
        require '../modelos/conectar.php';
        $resultado_nacionalidad = $conexion -> query ("select * from tbl_personas tu inner join tbl_paises tp on tu.PAIS_CODIGO = tp.PAIS_CODIGO where tu.PER_CODIGO = $id");
        $pais = $resultado_nacionalidad->fetch(PDO::FETCH_ASSOC);
         $nacionalidad = $pais['PAIS_NOMBRE'];
          $resultado = $conexion -> query ("SELECT * FROM tbl_paises");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            $r = ($nacionalidad == $registro["PAIS_NOMBRE"]) ? 'selected' : '';
            echo '<option value="'.$registro["PAIS_CODIGO"].'"'.$r.'>'.$registro["PAIS_NOMBRE"].'</option>';
          }
 
        ?>
        </select>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Profesión/ocupación</span>
                <select class="form-control" name="profesion" id="profesion" disabled>
        <option value="0">Seleccione una profesión/ocupación:</option>
                <?php
               
        require '../modelos/conectar.php';
        $resultado_profesion = $conexion -> query ("select * from tbl_personas tu inner join tbl_ocupaciones toc on tu.OCU_CODIGO = toc.OCU_CODIGO where tu.PER_CODIGO = $id");
        $profesion = $resultado_profesion->fetch(PDO::FETCH_ASSOC);
         $profesion = $profesion['OCU_NOMBRE'];
          $resultado = $conexion -> query ("SELECT * FROM tbl_ocupaciones");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            $r = ($profesion == $registro["OCU_NOMBRE"]) ? 'selected' : '';
            echo '<option value="'.$registro["OCU_CODIGO"].'"'.$r.'>'.$registro["OCU_NOMBRE"].'</option>';
          }
 
        ?>
        </select>
                </div>
                </div>


                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">RTN</span>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE RTN" name="rtn" id="rtn" value="<?php echo $rtn?>" readonly   >
                  <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Pasaporte</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="PASAPORTE"  name="pasaporte" id="pasaporte" value="<?php echo $pasaporte?>" readonly >
                  <span class="	glyphicon glyphicon-book form-control-feedback"></span>
                </div>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Número celular</span>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE CELULAR" name="numero_de_celular" id="numero_de_celular" value="<?php echo $celular?>" readonly >
                  <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Teléfono fijo</span>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE TELEFONO FIJO" name="numero_de_telefono_fijo" id="numero_de_telefono_fijo" value="<?php echo $tel_fijo?>" readonly >
                  <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                </div>
                </div>

                
                <div class="form-group col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Correo</span>
                  <input type="email" autocomplete="off" class="form-control correo" placeholder="CORREO" name="correo" id="correo" value="<?php echo $correo?>" readonly  >
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de registro</span>
                  <input type="text" autocomplete="off" class="form-control" placeholder="FECHA DE CREACION" name="fecha_creacion" id="fecha_creacion" value="<?php echo date("m/d/Y"); ?> " readonly>
                  <span class="	glyphicon glyphicon-time form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Dirección</span>
                  <textarea class="form-control" name="direccion" id="direccion" rows="10" cols="50" readonly > <?php echo $direccion?>     
                </textarea >
                <span class="		glyphicon glyphicon-home form-control-feedback"></span>
                </div>
                </div>
                </div>

                
                <div class="box-footer"> 
                <div class="col text-center">
                <div id="alerta"></div>

                <a href="../vistas/mostrar_pacientes_vista.php" class="btn btn-lg btn bg-red" ><i class="fa  fa-arrow-circle-o-left" aria-hidden="true"></i> ATRÁS</a> 

                </div>
              </div>
            </form>
            
        </div>
        <!-- /.box-body --> 
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    <!-- /.content -->
    </div>
    </div>
  </div>
  </div>
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2020 <a>System 32</a>.</strong> All rights
    reserved.
  </footer>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../vistas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../vistas/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../vistas/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../vistas/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../vistas/dist/js/app.min.js"></script>
<script src="../vistas/Js/Validaciones.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../vistas/dist/js/demo.js"></script>
</body>
</html>
