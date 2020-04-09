<?php
session_start();
require '../modelos/conectar.php';
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE INSERTAR MANTENIMIENTO',":fecha"=>date("Y-m-d H:m:s")));

$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 1;
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
$EMPLEADOS=$DATOS['PERM_EMPLEADOS'];
$PACIENTES=$DATOS['PERM_PACIENTES'];
$NUTRI=$DATOS['PERM_EXP_NUTRI'];
$MEDICO=$DATOS['PERM_EXP_MEDICO'];
$CITAS=$DATOS['PERM_CITAS'];
$SEGURIDAD=$DATOS['PERM_SEGURIDAD'];


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
      <h1>
        REGISTRAR USUARIO
        
      </h1>
      
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
        <form action="" method="POST" role="form" name="Form_registrar">
        <div id="alerta"></div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">NOMBRES</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="NOMBRE"  name="nombres" id="nombre" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">APELLIDOS</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="APELLIDO"  name="apellidos" id="apellido">
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputEmail1">USUARIO</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="USUARIO"  name="usuario" id="usum">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="exampleInputPassword1">ROL</label>
                <select class="form-control" name="rol_usuario" id="combox">
        <option value="0">SELECCIONE ROL:</option>
                <?php
        require '../modelos/conectar.php';
          $resultado = $conexion -> query ("SELECT * FROM TBL_ROL");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="'.$registro["ROL_CODIGO"].'">'.$registro["ROL_NOMBRE"].'</option>';
          }
        ?>
        </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA CREACION</label>
                  <input type="text" autocomplete="off" class="form-control nombres" name="fecha_creacion" id="fecha_creacion" value="<?php echo date("m/d/Y"); ?> " readonly>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA DE VENCIMIENTO</label>
                  <input type="text" autocomplete="off" class="form-control nombres" name="fecha_vencida" id="fecha_vencida"  value="<?php echo date("m/d/Y",strtotime("+1 years")); ?> " readonly>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">CORREO</label>
                  <input type="email" autocomplete="off" class="form-control correo" placeholder="CORREO" name="correo" id="correo" >
                </div>
              <div class="box-footer">
              <div class="col text-center">
                <button type="button"  class="btn btn-primary  btn-flat margin" onclick="validar_matenimiento();">CREAR</button>
                <a href="../vistas/mostrar_vista.php" class="btn bg-red btn-flat margin" >CANCELAR</a>
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
<script src="../vistas/js/validaciones.js"></script>
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
</body>
</html>
<?php require "../modelos/insertar_mant_modelo.php" ?>
