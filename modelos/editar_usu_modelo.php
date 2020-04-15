<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require_once '../modelos/conectar.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>10,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA EDITAR USUARIOS',":fecha"=>date("Y-m-d H:i:s")));

$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 10;
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
  <title>Editar Usuarios</title>
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
        LISTA DE USUARIOS
        
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
        <form action="" method="POST"  name="Formactualizar_mant">
                 <input type="hidden"  class="form-control " name="id1" value="<?php echo $id_u;?>" >
                </div>
                <div Id="alerta_mant"></div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">NOMBRES</label>
                  <input type="text"style="text-transform:uppercase" class="form-control apellidos" placeholder="NOMBRE"  name="nombres" id="nombre" value="<?php echo $nombre?>" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">APELLIDOS</label>
                  <input type="text" style="text-transform:uppercase" class="form-control nombres" placeholder="APELLIDO"  name="apellidos" id="apellido" value="<?php echo $apellido?>" >
                </div>
                <div class="form-group">
                  <input type="hidden" style="text-transform:uppercase" class="form-control nombres" placeholder="USUARIO"  name="usuarioa" id="usuarioa" value="<?php echo $usuario?>">
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputEmail1">USUARIO</label>
                  <input type="text" style="text-transform:uppercase" class="form-control nombres" placeholder="USUARIO"  name="usuarion" id="usuarion" value="<?php echo $usuario?>">
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="exampleInputPassword1">ESTADO</label>
                <select class="form-control" name="estado" id="combox2">
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
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="exampleInputPassword1">ROL</label>
                <select class="form-control" name="rol_usuario" id="combox">
                 <option value="0">SELECCIONE ROL:</option>
                 <option value="1"
                 <?php
                 if ($rol==1) {
                    echo 'selected';
                 }
                 ?>
                 >ADMINISTRADOR</option>
                 <option value="2"
                 <?php
                 if ($rol==2) {
                    echo 'selected';
                 }
                 ?>
                 >DEFAULT</option>
      
                </select>
                </div>

                 <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="exampleInputPassword1">CORREO</label>
                  <input type="email" class="form-control correo" placeholder="CORREO" name="correon" id="correon" value="<?php echo $correo?>" >
                </div>
                </div>
                <div class="box-footer">
                <div class="col text-center">
                
    
                <button type="button" name="update" class="btn btn-primary btn-flat margin" onclick="Validar_actualizar_mant();">ACTUALIZAR</button>
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

