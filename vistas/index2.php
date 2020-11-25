<?php
require_once '../modelos/conectar.php';
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>38,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA PRINCIPAL ADMINISTRADOR',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
//pantallas
$_SESSION['u']=11;
$_SESSION['pac']=18;
$_SESSION['ed']=24;
$_SESSION['en']=22;
$_SESSION['cit']=28;
$_SESSION['param']=30;
$_SESSION['roles']=31;
$_SESSION['bit']=33;
$_SESSION['back']=40;
$_SESSION['perm']=36;

//Permisos usuarios
$sql = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado=$conexion->prepare($sql);	
$resultado->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['u']));
$datos = $resultado->fetch(PDO::FETCH_ASSOC);
 $p= $datos['OBJ_CODIGO'];
 $_SESSION['cu']= $datos['PERM_CONSULTAR'];
 $_SESSION['iu'] = $datos['PERM_INSERTAR'];
 $_SESSION['eu'] = $datos['PERM_ELIMINAR'];
 $_SESSION['mu']= $datos['PERM_ACTUALIZAR'];
//Permisos pacientes
 $sql1 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado1=$conexion->prepare($sql1);	
$resultado1->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['pac']));
$datos1 = $resultado1->fetch(PDO::FETCH_ASSOC);
 $p= $datos1['OBJ_CODIGO'];
 $_SESSION['cpac']= $datos1['PERM_CONSULTAR'];
 $_SESSION['ipac'] = $datos1['PERM_INSERTAR'];
 $_SESSION['epac'] = $datos1['PERM_ELIMINAR'];
 $_SESSION['mpac']= $datos1['PERM_ACTUALIZAR'];
 //Permisos expediente doctora
 $sql2 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['ed']));
$datos2 = $resultado2->fetch(PDO::FETCH_ASSOC);
 $p= $datos2['OBJ_CODIGO'];
 $_SESSION['ced']= $datos2['PERM_CONSULTAR'];
 $_SESSION['ied'] = $datos2['PERM_INSERTAR'];
 $_SESSION['eed'] = $datos2['PERM_ELIMINAR'];
 //Permisos expediente nutricionistas
 $sql3 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado3=$conexion->prepare($sql3);	
$resultado3->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['en']));
$datos3 = $resultado3->fetch(PDO::FETCH_ASSOC);
 $p= $datos3['OBJ_CODIGO'];
 $_SESSION['cen']= $datos3['PERM_CONSULTAR'];
 $_SESSION['ien'] = $datos3['PERM_INSERTAR'];
 $_SESSION['een'] = $datos3['PERM_ELIMINAR'];
 //Permisos citas
 $sql4 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado4=$conexion->prepare($sql4);	
$resultado4->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['cit']));
$datos4 = $resultado4->fetch(PDO::FETCH_ASSOC);
 $p= $datos4['OBJ_CODIGO'];
 $_SESSION['ccit']= $datos4['PERM_CONSULTAR'];
 $_SESSION['icit'] = $datos4['PERM_INSERTAR'];
 $_SESSION['ecit'] = $datos4['PERM_ELIMINAR'];
 $_SESSION['mcit']= $datos4['PERM_ACTUALIZAR'];
 //Parametros
 $sql5 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado5=$conexion->prepare($sql5);	
$resultado5->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['param']));
$datos5 = $resultado5->fetch(PDO::FETCH_ASSOC);
 $p= $datos5['OBJ_CODIGO'];
 $_SESSION['cparam']= $datos5['PERM_CONSULTAR'];
 $_SESSION['mparam']= $datos5['PERM_ACTUALIZAR'];
 //Permisos roles
 $sql6 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado6=$conexion->prepare($sql6);	
$resultado6->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['roles']));
$datos6 = $resultado6->fetch(PDO::FETCH_ASSOC);
 $p= $datos6['OBJ_CODIGO'];
 $_SESSION['croles']= $datos6['PERM_CONSULTAR'];
 $_SESSION['iroles'] = $datos6['PERM_INSERTAR'];
 $_SESSION['eroles'] = $datos6['PERM_ELIMINAR'];
 $_SESSION['mroles']= $datos6['PERM_ACTUALIZAR'];
 //Permisos bitacora
 $sql7 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado7=$conexion->prepare($sql7);	
$resultado7->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['bit']));
$datos7 = $resultado7->fetch(PDO::FETCH_ASSOC);
 $p= $datos7['OBJ_CODIGO'];
 $_SESSION['cbit']= $datos7['PERM_CONSULTAR'];
 //Permisos backup
 $sql8 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado8=$conexion->prepare($sql8);	
$resultado8->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['back']));
$datos8 = $resultado8->fetch(PDO::FETCH_ASSOC);
 $p= $datos8['OBJ_CODIGO'];
 $_SESSION['cback']= $datos8['PERM_CONSULTAR'];
 //Permisos
 $sql9 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
$resultado9=$conexion->prepare($sql9);	
$resultado9->execute(array(":rol"=>$_SESSION['ROL'],":pantalla"=>$_SESSION['perm']));
$datos9 = $resultado9->fetch(PDO::FETCH_ASSOC);
 $p= $datos9['OBJ_CODIGO'];
 $_SESSION['cperm']= $datos9['PERM_CONSULTAR'];
 $_SESSION['iperm'] = $datos9['PERM_INSERTAR'];
 $_SESSION['eperm'] = $datos9['PERM_ELIMINAR'];
 $_SESSION['mperm']= $datos9['PERM_ACTUALIZAR'];
 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pantalla Principal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="icon" href="Img/Home.png">


</head>
<body class="hold-transition skin-blue sidebar-mini">
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
  
  <!-- =============================================== -->
 <?php require '../vistas/barra.php';  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
      Panel de control
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../vistas/index2.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrador</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-navy">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Usuarios</span>
              <span class="info-box-number">6</span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>
            
            <div class="info-box-content">
              <span class="info-box-text">Pacientes</span>
              <span class="info-box-number">3</span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
          <!-- /.info-box -->
        </div>
        </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-clipboard"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Medicina General</span>
              <span class="info-box-number">3</span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-clipboard"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Nutricionista</span>
              <span class="info-box-number">3</span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- Main content -->

    
          <section class="content">
          <ol class="breadcrumb">
        <li><a href="#"><i class=""></i>Configuraciones</a></li>
        <li class="active">Administrar</li>
      </ol>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h2>USUARIOS</h2>
              <P> CLIMEHOME </P>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="../vistas/mostrar_vista.php" class="small-box-footer">ADMINISTRAR <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h2>PACIENTES</h2>
              <P> CLIMEHOME </P>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="../vistas/mostrar_pacientes_vista.php" class="small-box-footer">ADMINISTRAR <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h2>EXPEDIENTES</h2>
            <P> MÉDICO </P>
            </div>
            <div class="icon">
              <i class="fa fa-clipboard"></i>
            </div>
            <a href="../vistas/mostrar_expediented_vista.php" class="small-box-footer">ADMINISTRAR <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h2>EXPEDIENTES</h2>
              <P> NUTRICIONALES </P>
            </div>
            <div class="icon">
              <i class="fa fa-clipboard"></i>
            </div>
            <a href="../vistas/mostrar_expedienten_vista.php" class="small-box-footer">ADMINISTRAR<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

    </section>
  </div>
  </div>
         
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

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
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

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
        <!--LIBRERIAS -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
