<?php
session_start();
require '../modelos/conectar.php';
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE INSERTAR MANTENIMIENTO',":fecha"=>date("Y-m-d H:m:s")));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar Empleado</title>
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
<script type="text/javascript">
$(function() {
$("#text").change(function(){

  <?php
session_start();
require_once "../modelos/conectar.php"; 
   
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>1,":accion"=>'SALIO',":descr"=>'SALIO DE PANTALLA MANTENIMIENTO',":fecha"=>date("Y-m-d H:m:s")));         

?>

alert("texto cambiado");
});

});	

</script>

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

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="../vistas/img/User_icono1.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["usu"];?></p>
          </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Barra de Navegación</li>
       
       <!-- Titulo de Usuario -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Usuarios</span>
        </a>
        <!-- subtitulos de Usuario -->
        <ul class="treeview-menu">
          <li><a href="../vistas/insertar_mant_vista.php"><i class="fa fa-plus-square"></i>Añadir Usuarios</a></li>
          <li><a href="../vistas/mostrar_vista.php"><i class="fa fa-list"></i>Lista de Usuarios</a></li>
         

        </ul>
      </li>
       <!-- Titulo de Empleados -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Empleados</span>

        </a>
        <!-- subtitulos de Empleados -->
        <ul class="treeview-menu">
        <li><a href="../vistas/insertar_empleado_vista.php"><i class="fa fa-plus-square"></i>Añadir Empleado</a></li>
          <li><a href="../vistas/mostrar_empleados_vista.php"><i class="fa fa-list"></i> Lista de Empleados</a></li>

        </ul>
      </li>
     
      <!-- Titulo de Pacientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Pacientes</span>

        </a>
        <!-- subtitulos de Pacientes -->
        <ul class="treeview-menu">
          <li><a href="../vistas/insertar_pacientes_vista.php"><i class="fa fa-plus-square"></i>Añadir Paciente</a></li>
          <li><a href="../vistas/mostrar_pacientes_vista.php"><i class="fa fa-list"></i>Lista de Pacientes</a></li>
          
        </ul>
      </li>
      <!-- Titulo de Expedientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open-o"></i>
          <span>Expedientes</span>

          </a>
        <!-- subtitulos de Expedientes -->
        <ul class="treeview-menu">
        <li><a href="../vistas/insertar_expedienten_vista.php"><i class="fa fa-plus-square"></i>Expediente Nutricional</a></li>
          <li><a href="../vistas/mostrar_expedienten_vista.php"><i class="fa fa-list"></i>Mostrar Expediente Nutricional</a></li>
          <li><a href="../vistas/insertar_expediented_vista.php"><i class="fa fa-plus-square"></i>Expediente Médico </a></li>
          <li><a href="../vistas/mostrar_expediented_vista.php"><i class="fa fa fa-list"></i>Mostrar Expediente Médico </a></li>

        </ul>
      </li>
      <!-- Titulo de Citas -->
      <li class="treeview">
        <a href="../vistas/citas_vista.php">
          <i class="fa fa-calendar"></i>
          <span>Citas</span>
          </a>
        <ul class="treeview-menu">
          <li><a href="../vistas/insertar_cita_vista.php"><i class="fa fa-plus-square"></i>Añadir cita</a></li>
          <li><a href="../vistas/mostrar_citas_vista.php"><i class="fa fa-list"></i>Lista de citas</a></li>

        </ul>
      </li>
        </a>
      </li>
 <!-- Titulo de Seguridad -->
 <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-lock"></i>
          <span>Seguridad</span>

        </a>
        <!-- subtitulos de Seguridad -->
        <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_parametros_vista.php"><i class="fa fa-list"></i>Lista de Parámetros</a></li>
          <li><a href="../vistas/mostrar_roles_vista.php"><i class="fa fa-list"></i>Lista de Roles</a></li>
          <li><a href="#"><i class="glyphicon glyphicon-cloud-upload"></i>Backup</a></li>
          <li><a href="../vistas/bitacora_vista.php"><i class="fa fa-list"></i>Bitácora</a></li>
        </ul>
      </li>
   
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        REGISTRAR EMPLEADO
        
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
        <form action=""  method="POST" name="form_empleados">
          <div  id="alerta"></div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputEmail1">NOMBRES</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="NOMBRES"  name="nombres" id="nombres">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">APELLIDOS</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="APELLIDOS"  name="apellidos" id="apellidos" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">EDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="EDAD"  name="edad" id="edad">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="IDENTIDAD"  name="numero_de_identidad" id="numero_de_identidad"">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">RTN</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="RTN" name="rtn" id="rtn"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">CARGO</label>
                  <input type="text" style="text-transform:uppercase" autocomplete="off" class="form-control"placeholder="CARGO" name="cargo" id="cargo"  >
                </div>

                
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1"> CELULAR</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="NUMERO DE CELULAR" name="numero_de_celular" id="numero_de_celular">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1"> TELEFONO FIJO</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="TELEFONO FIJO" name="numero_de_telefono_fijo" id="numero_de_telefono_fijo">
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA DE NACIMIENTO</label>
                  <input type="date" autocomplete="off" class="form-control" placeholder="FECHA DE NACIMIENTO" name="fecha_de_nacimiento" id="fecha_de_nacimiento">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA DE CONTRATACION</label>
                  <input type="date" autocomplete="off" class="form-control" placeholder="FECHA DE CONTRATACION" name="fecha_de_contratacion" id="fecha_de_contratacion">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">CORREO</label>
                  <input type="email" autocomplete="off" class="form-control" placeholder="CORREO" name="correo" id="correo" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">NACIONALIDAD</label>
                  <input type="text" style="text-transform:uppercase" autocomplete="off" class="form-control" placeholder="NACIONALIDAD" name="nacionalidad" id="nacionalidad" >
                </div>
                 
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="exampleInputPassword1">GENERO</label>
                <select class="form-control" name="genero" id="genero">
                 <option value="0">SELECCIONE EL GENERO:</option>
                 <option value="MUJER">FEMENINO</option>
                 <option value="MASCULINO">MASCULINO</option>
                 <option value="OTRO">OTRO</option>

                </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">Direccion</label>
                  <textarea placeholder="DIRECCIÓN" style="text-transform:uppercase"  class="form-control"  name="direccion" id="direccion" cols="30" rows="5" ></textarea >
                </div>
              
                <div class="col text-center">
                <button type="button" onclick="validar_empleado();" class="btn btn-primary btn-flat margin">CREAR</button>
                <a href="../vistas/mostrar_empleados_vista.php" class="btn bg-red btn-flat margin" >CANCELAR</a>
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
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2020 <a>SYSTEM 32</a>.</strong> All rights
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
      $("#edad").mask("00");
    $("#numero_de_identidad").mask("0000-0000-00000");
    $("#numero_de_celular").mask("0000-0000");
    $("#numero_de_telefono_fijo").mask("0000-0000");
    $("#rtn").mask("00000000000000");
    
});
</script>
</body>
</html>
<?php require "../modelos/insertar_empleado_modelo.php" ?>
