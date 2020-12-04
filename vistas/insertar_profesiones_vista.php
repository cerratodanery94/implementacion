<?php
session_start();
require_once '../modelos/conectar.php';

$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA AÑADIR USUARIOS',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar Usuarios</title>
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
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">
  <link rel="icon" href="Img/Home.png">
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
    <h1><i class="fa fa-user-plus" aria-hidden="true"></i>
        Registrar usuarios
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="mostrar_vista.php"><i class="fa fa-user"></i>Usuarios</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Registrar usuarios</li>
      </ol>
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
        <form action="" method="POST" role="" name="">
        <div id="alerta"></div>
        
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
        <div class="input-group">
                <span class="input-group-addon">Ingresar una profesion</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="profesion/ocupacion "  name="profesion" id="profesion" >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
       </div>
                </div>

                <button type="submit"  class="btn btn-lg btn btn-primary">  <i class="fa fa-check-circle-o" aria-hidden="true"></i> CREAR</button>

              
      <!-- /.row -->
    </section>
    </form>
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
<script src="../vistas/js/validar_sistema.js"></script>
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
<!-- AdminLTE for demo purposes -->
<script src="../vistas/dist/js/demo.js"></script>
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<script src="../vistas/plugins/jQuery/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
    $("#numero_de_identidad").mask("0000-0000-00000");
    $("#numero_de_celular").mask("0000-0000");
    $("#numero_de_telefono_fijo").mask("0000-0000");
    $("#rtn").mask("00000000000000");

});
</script>
</body>
</html>
<?php require "../modelos/insertar_profesiones_modelo.php" ?>
