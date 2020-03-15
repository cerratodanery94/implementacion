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

  <header class="main-header ">
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
            <span class="hidden-xs">SALIR</span>
            </a>
            <ul class="dropdown-menu">
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../vistas/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["usu"];?></p>
        
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Barra de Navengacion</li>
       
       <!-- Titulo de Usuario -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Usuarios</span>
        </a>
        <!-- subtitulos de Usuario -->
        <ul class="treeview-menu">
          <li><a href="../vistas/insertar_mant_vista.php"><i class="fa fa-plus-square"></i>Crear Usuarios</a></li>
          <li><a href="../vistas/mostrar_vista.php"><i class="fa fa-minus-square"></i>lista de usuarios</a></li>
         

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
          <li><a href="../vistas/mostrar_empleados_vista.php"><i class="fa fa-minus-square"></i> Mostrar Empleado</a></li>

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
          <li><a href="../vistas/insertar_pacientes_vista.php"><i class="fa fa-plus-square"></i>Añadir Pacientes</a></li>
          <li><a href="../vistas/mostrar_pacientes_vista.php"><i class="fa fa-minus-square"></i>Mostar Pacientes</a></li>
          
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
          <li><a href="#"><i class="fa fa-circle-o"></i>Nutricionista</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i>Doctora </a></li>

        </ul>
      </li>
       <!-- Titulo de Citas -->
       <li class="treeview">
        <a href="#">
          <i class="fa fa-calendar"></i>
          <span>Citas</span>

        </a>
        <!-- subtitulos de Citas -->
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-eye"></i>Ver las Citas del Dia</a></li>
          <li><a href="#"><i class="fa fa-plus-square"></i> Agregar Cita</a></li>
          <li><a href="#"><i class="fa fa-check-square-o"></i> Actualizar Cita</a></li>

        </ul>
      </li>
      <!-- Titulo de Proveedores -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-truck"></i>
          <span>Proveedores</span>

          <!-- subtitulos de proveedores -->
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>Ver todos los Proveedores</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Agregar Proveedores</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Actualizar Pro</a></li>

        </ul>
      </li>
      <!-- Titulo de compras -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-shopping-cart"></i>
          <span>Compras</span>

        </a>
        <!-- subtitulos de compras -->
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>Ver todos las Compras</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Agregar Compras</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Actualizar Compras</a></li>

        </ul>
      </li>
      <!-- Titulo de ventas -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-credit-card-alt"></i>
          <span>Ventas</span>

        </a>
        <!-- subtitulos de ventas -->
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>Ver todos las Ventas</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Agregar Venta</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Actualizar Ventas</a></li>

        </ul>
      </li>
      <!-- Titulo de Inventario -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-line-chart"></i>
          <span>Inventario</span>

        </a>
        <!-- subtitulos de inventario -->
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>Ver inventario Disponible</a></li>

          <li><a href="#"><i class="fa fa-circle-o"></i> Actualizar Ventas</a></li>

        </ul>
      </li>

    <!-- Titulo de Admin -->
    <li class="treeview">
        <a href="#">
          <i class="fa fa-credit-card-alt"></i>
          <span>Administrador</span>

        </a>
        <!-- subtitulos de ventas -->
        <ul class="treeview-menu">
          <li><a href="administradores.php"><i class="fa fa-circle-o"></i>Agregar Administrador</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Agregar Venta</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Actualizar Ventas</a></li>
 
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      REGISTRO DE EMPLEADOS
        <small>Llena el formulario para crear un empleado</small>
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
          <h3 class="box-title">CREAR EMPLEADO</h3>

          
        </div>
        <div class="box-body">
        
        <form action=""  method="POST" name="form_empleados">
        <div class="form-group">
                  <label for="exampleInputEmail1">NOMBRES</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="nombres" id="nombres">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">APELLIDOS</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="APELLIDOS"  name="apellidos" id="apellidos" >
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">EDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="EDAD"  name="edad" id="edad">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="numero_de_identidad"" id="numero_de_identidad"">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">RTN</label>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE RTN" name="rtn" id="rtn"  >
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">CARGO</label>
                  <input type="text" style="text-transform:uppercase" autocomplete="off" class="form-control nombres"placeholder="CARGO" name="cargo" id="cargo"  >
                </div>

                
                <div class="form-group">
                  <label for="exampleInputPassword1"> CELULAR</label>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE TELEFONO CELULAR" name="numero_de_celular" id="numero_de_celular">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1"> TELEFONO FIJO</label>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE TELEFONO FIJO" name="numero_de_telefono_fijo" id="numero_de_telefono_fijo">
                </div>
                  
                
                <div class="form-group">
                  <label for="exampleInputPassword1">FECHA DE NACIMIENTO</label>
                  <input type="date" autocomplete="off" class="form-control nombres" placeholder="FECHA DE NACIMIENTO" name="fecha_de_nacimiento" id="fecha_de_nacimiento">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">FECHA DE CONTRATACION</label>
                  <input type="date" autocomplete="off" class="form-control nombres" placeholder="FECHA DE CONTRATACION" name="fecha_de_contratacion" id="fecha_de_contratacion">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">CORREO</label>
                  <input type="email" autocomplete="off" class="form-control correo" placeholder="CORREO" name="correo" id="correo" >
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">NACIONALIDAD</label>
                  <input type="text" style="text-transform:uppercase" autocomplete="off" class="form-control correo" placeholder="NACIONALIDAD" name="nacionalidad" id="nacionalidad" >
                </div>
                 
                <div class="form-group">
                <label for="exampleInputPassword1">GENERO</label>
                <select class="form-control" name="genero" id="genero">
                 <option value="0">SELECCIONE EL GENERO:</option>
                 <option value="MUJER">FEMENINO</option>
                 <option value="MASCULINO">MASCULINO</option>
                 <option value="OTRO">OTRO</option>

                </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Direccion/Domicilo</label>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1" >Direccion</label>

                  <textarea style="text-transform:uppercase" class="form-control" name="direccion" id="direccion" rows="10" cols="50"  >     
                
                </textarea >
                </div>
              
                <div class="col text-center">
                <div id="alerta"></div>
                <button type="submit" onclick="validar_empleados();" name="insertar_emp" class="btn btn-primary">CREAR</button>
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
<?php require "../modelos/insertar_empleado_modelo.php" ?>
