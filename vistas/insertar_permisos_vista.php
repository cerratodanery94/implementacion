<?php
session_start();
require_once '../modelos/conectar.php';
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>36,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA AÑADIR PERMISOS',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

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
    <a href="../../index2.html" class="logo">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    ASIGNACION DE PERMISOS
        
      </h1>
      
      
    </section>

    <!-- Main content -->
    <div class="col-100 forgot">
    <div style='float:center;margin:auto;width:500px;' class="row">

           <div class="col-md-10">
           </div>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">ASIGNAR PERMISOS</h3>

          
        </div>
        <div class="box-body">
        
        <form action="" method="POST" role="form" name="Form_registrar">
        <div id="alerta"></div>
<div class="form-group">
        <label for="exampleInputPassword1">ROL</label>
 <select class="form-control" name="rol" id="r">
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
        
        <div class="form-group">
        <label for="exampleInputPassword1">PANTALLA</label>
 <select class="form-control" name="pantalla" id="o">
        <option value="0">SELECCIONE LA PANTALLA:</option>
        <?php
        require '../modelos/conectar.php';
        $resultado = $conexion -> query ("SELECT * FROM TBL_OBJETOS where obj_codigo in (1,11,10,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,33,32,34,35,36,38,40,41,42) ");
        while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$registro["OBJ_CODIGO"].'">'.$registro["OBJ_NOMBRE"].'</option>';
        }
        ?>
</select>
        </div>

        <div class="form-group ">
        <div class="form-group ">
    <label for="exampleInputPassword1">
    
    <input value="1"   type="checkbox" name="a" >
    CONSULTAR
    </label>
    <br>
    <label for="exampleInputPassword1">
    
    <input value="1"   type="checkbox" name="b" >
    INSERTAR
    </label>
    <br>
    <label for="exampleInputPassword1">
    
    <input value="1"   type="checkbox" name="c" >
    ACTUALIZAR
    </label>
    <br>
    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="d" >
    ELIMINAR
    </label>
    <br>

    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="e" >
    ACCESSO USUARIO
    </label>
    <br>

    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="f" >
    ACCESSO EMPLEADOS
    </label>
    <br>

    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="g" >
    ACCESSO PACIENTES
    </label>
    <br>

    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="h" >
    ACCESSO EXP NUTRICIONISTA
    </label>
    <br>

    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="i" >
    ACCESSO EXP MEDICO
    </label>
    <br>

    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="j" >
    ACCESSO CITAS
    </label>
    <br>

    <label for="exampleInputPassword1">
    <input value="1"   type="checkbox" name="k" >
    ACCESSO SEGURIDAD
    </label>
    <br>

   
    </div>
    <div class="box-footer">
      <div class="col text-center">
        <button type="button" onclick="validar_permiso();"  class="btn btn-primary"> CREAR</button>
        
        </div>
      </div>
   
    </form>


       </div>
        

     
  
        </div>
        <!-- /.box-body -->
        
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    
    <!-- /.content -->
    </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
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
</body>
</html>
<?php require "../modelos/insertar_mant_modelo.php" ?>
<?php require "../modelos/insertar_permisos_modelo.php" ?>
