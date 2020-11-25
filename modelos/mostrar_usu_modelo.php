<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require_once '../modelos/conectar.php';
  require_once '../controladores/funciones.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>10,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA EDITAR USUARIOS',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 42;
$PANTALLA = $_SESSION['PANTALLA'];
$sql3 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO = :pantalla ";
$resultado3=$conexion->prepare($sql3);	
$resultado3->execute(array(":rol"=>$ROL,":pantalla"=>$PANTALLA));
$DATOS = $resultado3->fetch(PDO::FETCH_ASSOC);
$CONSULTAR = $DATOS['PERM_CONSULTAR'];
$INSERTAR = $DATOS['PERM_INSERTAR'];
$ELIMINAR = $DATOS['PERM_ELIMINAR'];
$ACTUALIZAR = $DATOS['PERM_ACTUALIZAR'];
$USUARIOS=$DATOS['PERM_USUARIO'];

$PACIENTES=$DATOS['PERM_PACIENTES'];

$NUTRI=$DATOS['PERM_EXP_NUTRI'];
$MEDICO=$DATOS['PERM_EXP_MEDICO'];
$CITAS=$DATOS['PERM_CITAS'];
$SEGURIDAD=$DATOS['PERM_SEGURIDAD'];
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM TBL_USUARIO WHERE USU_CODIGO= :id";
	$resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
       $fila=$resultado->fetch();
       $id_u=$fila['USU_CODIGO'];
       $usuario=$fila['USU_USUARIO'];
       $nombre=$fila['USU_NOMBRES'];
       $apellido=$fila['USU_APELLIDOS'];
       $estado=$fila['USU_ESTADO'];
       $rol=$fila['ROL_CODIGO'];
       $correo=$fila['USU_CORREO'];
       $nacionalidad=$fila['PAIS_CODIGO'];
       $edad=mi_edad($fila['USU_FECHA_NACIMIENTO']);
       $fecha_nacimiento=$fila['USU_FECHA_NACIMIENTO'];
       $celular=$fila['USU_CELULAR'];
       $tel_fijo=$fila['USU_TEL_FIJO'];
       $identidad=$fila['USU_IDENTIDAD'];
       $rtn=$fila['USU_RTN'];
       $genero=$fila['USU_GENERO'];
       $direccion=$fila['USU_DIRECCION'];
       $pasaporte=$fila['USU_PASAPORTE'];
       $fecha_creacion=$fila['USU_FECHA_CREACION'];
       $vencimiento=$fila['USU_FECHA_VENCIMIENTO'];
       
   }
}
} catch (Exception $e) {
  
	echo "Codigo del error" . $e->getLine();
}
?> 



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mostrar información</title>
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
  <link rel="stylesheet" href="../vistas/plugins/sweetalert/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <link rel="icon" href="../vistas/Img/Home.png">

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
  <!-- =============================================== -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1><i class="fa  fa-file-text-o" aria-hidden="true"></i>
Lista de usuarios
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../vistas/mostrar_vista.php"><i class="fa fa-dashboard"></i>Usuarios</a></li>
        <li class="active"><i class="fa fa-file-text-o"></i> Información del usuario</li>
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
        <form action="" method="POST"  name="Formactualizar_mant">
                 <input type="hidden"  class="form-control " name="id1" value="<?php echo $id_u;?>" readonly >
                </div>
                <div Id="alerta_mant"></div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Nombres</span>
                  <input type="text"style="text-transform:uppercase" class="form-control apellidos" placeholder=""  name="nombres" id="nombre" value="<?php echo $nombre?>" readonly >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Apellidos</span>
                  <input type="text" style="text-transform:uppercase" class="form-control nombres" placeholder=""  name="apellidos" id="apellido" value="<?php echo $apellido?>" readonly >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                </div>


                <div class="form-group">
                  <input type="hidden" style="text-transform:uppercase" class="form-control nombres" placeholder="USUARIO"  name="usuarioa" id="usuarioa" value="<?php echo $usuario?>" readonly>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Usuario</span>
                  <input type="text" style="text-transform:uppercase" class="form-control nombres" placeholder=""  name="usuarion" id="usuarion" value="<?php echo $usuario?>" readonly>
                  <span class="	glyphicon glyphicon-option-vertical form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de nacimiento</span>
                  <input type="date" autocomplete="off" class="form-control" placeholder="" name="fecha_de_nacimiento" id="fecha_de_nacimiento" value="<?php echo $fecha_nacimiento?>" readonly>
                  <span class="	glyphicon  glyphicon-gift form-control-feedback"></span>
                </div>
                </div> 

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Edad</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder=""  name="edad" id="edad"value="<?php echo $edad?>"readonly>
                  <span class="	glyphicon glyphicon glyphicon-hourglass form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Identidad</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="IDENTIDAD"  name="numero_de_identidad" id="numero_de_identidad"value="<?php echo $identidad?>" readonly>
                  <span class="	glyphicon glyphicon-credit-card form-control-feedback"></span>
                </div>
                </div>
               
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">RTN</span>
                  <input type="text" autocomplete="off" class="form-control"placeholder="RTN" name="rtn" id="rtn" value="<?php echo $rtn?>" readonly >
                  <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
                </div>
               </div>

               <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Número celular</span>
                  <input type="text" autocomplete="off" class="form-control"placeholder="NUMERO DE CELULAR" name="numero_de_celular" id="numero_de_celular" value="<?php echo $celular?>" readonly>
                  <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                </div>
                 
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Teléfono fijo</span>
                  <input type="text" autocomplete="off" class="form-control"placeholder="TELEFONO FIJO" name="numero_de_telefono_fijo" id="numero_de_telefono_fijo" value="<?php echo $tel_fijo?>" readonly>
                  <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Género</span>
                <select class="form-control" name="genero" id="genero" readonly>
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
                <select class="form-control" name="nacionalidad" id="nacionalidad" readonly>
        <option value="0">SELECCIONE UNA NACIONALIDAD:</option>
                <?php
               
        require '../modelos/conectar.php';
        $resultado_nacionalidad = $conexion -> query ("select * from tbl_usuario tu inner join tbl_paises tp on tu.PAIS_CODIGO = tp.PAIS_CODIGO where tu.USU_CODIGO = $id");
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
                <span class="input-group-addon">Estado</span>
                <select class="form-control" name="estado" id="combox2" readonly>
                 <option value="0">SELECCIONE EL ESTADO:</option>
                 <option value="NUEVO"
                 <?php
                 if ($estado=='NUEVO') {
                    echo 'selected';
                 }
                 ?>
                 >NUEVO</option>
                 <option value="ACTIVO"
                 <?php
                 if ($estado=='ACTIVO') {
                    echo 'selected';
                 }
                 ?>
                 >ACTIVO</option>
                 <option value="BLOQUEADO"
                 <?php
                 if ($estado=='BLOQUEADO') {
                    echo 'selected';
                 }
                 ?>
                 >BLOQUEADO</option>
                 <option value="VACACIONES"
                 <?php
                 if ($estado=='VACACIONES') {
                    echo 'selected';
                 }
                 ?>
                 >VACACIONES</option>
                </select>
                </div>
                </div>
                
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Rol</span>
                <select class="form-control" name="rol_usuario" id="rol_usuario" readonly>
        <option value="0">SELECCIONE UN ROL:</option>
                <?php
               
        require '../modelos/conectar.php';
        $resultado_rol = $conexion -> query ("select * from tbl_usuario tu inner join tbl_rol tp on tu.ROL_CODIGO = tp.ROL_CODIGO where tu.USU_CODIGO = $id");
        $rol = $resultado_rol->fetch(PDO::FETCH_ASSOC);
         $nacionalidad = $rol['ROL_NOMBRE'];
          $resultado = $conexion -> query ("SELECT * FROM tbl_rol");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            $r = ($nacionalidad == $registro["ROL_NOMBRE"]) ? 'selected' : '';
            echo '<option value="'.$registro["ROL_CODIGO"].'"'.$r.'>'.$registro["ROL_NOMBRE"].'</option>';
          }
 
        ?>
        </select>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de creación</span>
                  <input type="text" autocomplete="off" class="form-control nombres" name="fecha_creacion" id="fecha_creacion" value="<?php echo $fecha_creacion?>"  readonly>
                  <span class="	glyphicon glyphicon-time form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de Vencimiento</span>
                  <input type="text" autocomplete="off" class="form-control nombres" name="fecha_vencida" id="fecha_vencida"  value="<?php echo $vencimiento ?> " readonly>
                  <span class="	glyphicon glyphicon-time form-control-feedback"></span>
                </div>
               </div> 

               <div class="form-group col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Correo</span>
                  <input type="email" class="form-control correo" placeholder="CORREO" name="correon" id="correon" value="<?php echo $correo?>" readonly>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                </div>

               <div class="form-group col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Pasaporte</span>
                  <input type="text" autocomplete="off" class="form-control correo" placeholder="PASAPORTE" name="pasaporte" id="pasaporte" value="<?php echo $pasaporte?>" readonly>
                  <span class="	glyphicon glyphicon-book form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Dirección</span>
                  <textarea placeholder="" style="text-transform:uppercase"  class="form-control" readonly  name="direccion" id="direccion" cols="30" rows="5" ><?php echo $direccion?></textarea  >
                  <span class="		glyphicon glyphicon-home form-control-feedback"></span>
                </div>
                </div>
                </>
                <div class="box-footer">
                <div class="col text-center">
                 <a href="../vistas/mostrar_vista.php" class="btn btn-lg btn bg-red" ><i class="fa  fa-arrow-circle-o-left" aria-hidden="true"></i> ATRÁS</a> 
                </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<script src="../vistas/dist/js/demo.js"></script>
</body>
</html> 
<?php require "../modelos/actualizar_usu_modelo.php" ?>

