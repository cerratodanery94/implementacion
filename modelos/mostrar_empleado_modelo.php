<?php
session_start();
try {
  require '../modelos/conectar.php';
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM TBL_EMPLEADOS WHERE EMP_CODIGO= :id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
       $fila=$resultado->fetch();
       $id_u=$fila['EMP_CODIGO'];
       $identidad=$fila['EMP_NUMERO_IDENTIDAD'];
       $nombres=$fila['EMP_NOMBRES'];
       $apellidos=$fila['EMP_APELLIDOS'];
       $fecha_nacimiento=$fila['EMP_FECHA_NACIMIENTO'];
       $edad=$fila['EMP_EDAD'];
       $tel_fijo=$fila['EMP_TEL_FIJO'];
       $celular=$fila['EMP_CELULAR'];
       $cargo=$fila['EMP_CARGO'];
       $fecha_contratacion=$fila['EMP_FECHA_CONTRATACION'];
       $genero=$fila['EMP_GENERO'];
       $correo=$fila['EMP_CORREO'];
       $direccion=$fila['EMP_DIRECCION'];
       $nacionalidad=$fila['EMP_NACIONALIDAD'];
       $rtn=$fila['EMP_RTN'];
   
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
 
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
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
        INFORMACION GENERAL DEL EMPLEADO
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
          <h3 class="box-title">EMPLEADO</h3>
        </div>
        <div class="box-body">
        <form action=""  method="POST" name="form_empleados">
        <div class="form-group">
                 
                  <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres"   name="ide" id="ide" value="<?php echo $id_u?>" readonly >
        </div>

             <div class="form-group">
                  <label for="exampleInputEmail1">NOMBRES</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="nombres" id="nombres"value="<?php echo $nombres?>" readonly>
              </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">APELLIDOS</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="APELLIDOS"  name="apellidos" id="apellidos"value="<?php echo $apellidos?>" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">EDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="EDAD"  name="edad" id="edad" value="<?php echo $edad?>" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="numero_de_identidad" id="numero_de_identidad" value="<?php echo $identidad?>" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">RTN</label>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE RTN" name="rtn" id="rtn" value="<?php echo $rtn?>" readonly >
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">CARGO</label>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="CARGO" name="cargo" id="cargo" value="<?php echo $cargo?>" readonly >
                </div>

                
                <div class="form-group">
                  <label for="exampleInputPassword1"> CELULAR</label>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE TELEFONO CELULAR" name="numero_de_celular" id="numero_de_celular"value="<?php echo $celular?>" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1"> TELEFONO FIJO</label>
                  <input type="text" autocomplete="off" class="form-control nombres"placeholder="NUMERO DE TELEFONO FIJO" name="numero_de_telefono_fijo" id="numero_de_telefono_fijo"value="<?php echo $tel_fijo?>" readonly>
                </div>
                  
                
                <div class="form-group">
                  <label for="exampleInputPassword1">FECHA DE NACIMIENTO</label>
                  <input type="date" autocomplete="off" class="form-control nombres" placeholder="FECHA DE NACIMIENTO" name="fecha_de_nacimiento" id="fecha_de_nacimiento"value="<?php echo $fecha_nacimiento?>" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">FECHA DE CONTRATACION</label>
                  <input type="date" autocomplete="off" class="form-control nombres" placeholder="FECHA DE CONTRATACION" name="fecha_de_contratacion" id="fecha_de_contratacion" value="<?php echo $fecha_contratacion?>" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">CORREO</label>
                  <input type="email" autocomplete="off" class="form-control correo" placeholder="CORREO" name="correo" id="correo" value="<?php echo $correo?>" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">NACIONALIDAD</label>
                  <input type="text" autocomplete="off" class="form-control correo" placeholder="NACIONALIDAD" name="nacionalidad" id="nacionalidad" value="<?php echo $nacionalidad?>"readonly>
                </div>
                 
                <div class="form-group">
                <label for="exampleInputPassword1">GENERO</label>
                <select class="form-control" name="genero" id="genero" disabled>
                 <option value="0">SELECCIONE UN GENERO:</option>
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
                
                <div class="form-group">
                  <label for="exampleInputPassword1" >Direccion</label>

                  <textarea class="form-control" name="direccion" id="direccion" rows="10" cols="50" readonly > <?php echo $direccion?>     
                
                </textarea >
                </div>

                
                <div class="box-footer"> 

                <div class="col text-center">
                <div id="alerta"></div>
              <a href="../vistas/mostrar_empleados_vista.php" class="btn bg-blue btn-flat margin" >ATRAS</a>
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
