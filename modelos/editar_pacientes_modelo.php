<?php
session_start();
try {
  require '../modelos/conectar.php';
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
       $fecha_creacion=$fila['PER_FECHA_CREACION'];
       $edad=$fila['PER_EDAD'];
       $genero=$fila['PER_GENERO'];
       $tel_fijo=$fila['PER_TEL_FIJO'];
       $celular=$fila['PER_CELULAR'];
       $cargo=$fila['PER_PROFESION'];
       $direccion=$fila['PER_DIRECCION'];
       $correo=$fila['PER_CORREO'];
       $nacionalidad=$fila['PER_NACIONALIDAD'];
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
  <title>Editar Paciente</title>
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
      ACTUALIZAR INFORMACIÓN DEL PACIENTE
        
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
        <form action=""  method="POST" name="form_editar_paciente">
        <div id="alerta1"></div>
        <div class="form-group">
                 
                 <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control"   name="ide" id="ide" value="<?php echo $id_u?>">
              </div>

              <div class="form-group col-lg-6 col-md-6 col-xs-12">

                 <label for="exampleInputEmail1">NOMBRES</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="NOMBRES"  name="nombres" id="nombres"value="<?php echo $nombres?>"   >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">APELLIDOS</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="APELLIDOS"  name="apellidos" id="apellidos" value="<?php echo $apellidos?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">EDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="EDAD"  name="edad" id="edad" value="<?php echo $edad?>"   >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="IDENTIDAD"  name="numero_de_identidad" id="numero_de_identidad" value="<?php echo $identidad?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">RTN</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="RTN" name="rtn" id="rtn" value="<?php echo $rtn?>"    >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">NACIONALIDAD</label>
                  <input style="text-transform:uppercase" type="text" autocomplete="off" class="form-control"placeholder="NACIONALIDAD" name="nacionalidad" id="nacionalidad" value="<?php echo $nacionalidad?>"   >
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">PROFESION/OCUPACION</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control"placeholder="PROFESION" name="profesion" id="profesion" value="<?php echo $cargo?>"    >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">PASAPORTE</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="PASAPORTE"  name="pasaporte" id="pasaporte" value="<?php echo $pasaporte?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1"> CELULAR</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="NUMERO DE CELULAR" name="numero_de_celular" id="numero_de_celular" value="<?php echo $celular?>"  >
                </div>
     
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1"> TELEFONO FIJO</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="TELEFONO FIJO" name="numero_de_telefono_fijo" id="numero_de_telefono_fijo" value="<?php echo $tel_fijo?>"  >
                </div>
                  
                
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">FECHA DE NACIMIENTO</label>
                  <input type="date" autocomplete="off" class="form-control" placeholder="FECHA DE NACIMIENTO" name="fecha_de_nacimiento" id="fecha_de_nacimiento"value="<?php echo $fecha_nacimiento?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">FECHA DE CREACION</label>
                  <input type="date" autocomplete="off" class="form-control" placeholder="FECHA DE CREACION" name="fecha_creacion" id="fecha_creacion" value="<?php echo $fecha_creacion?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">CORREO</label>
                  <input type="email" autocomplete="off" class="form-control " placeholder="CORREO" name="correo" id="correo" value="<?php echo $correo?>"   >
                </div>
                 
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                <label for="exampleInputPassword1">GENERO</label>
                <select class="form-control" name="genero" id="genero">
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
   
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">Direccion</label>
                  <textarea placeholder="DIRECCIÓN" style="text-transform:uppercase"  class="form-control"  name="direccion" id="direccion" cols="30" rows="5" ><?php echo $direccion?></textarea >
                </div>
                
                <div class="box-footer"> 

                <div class="col text-center">
                <button type="button"  onclick="validar_editar_paciente();" class="btn btn-primary btn-flat margin">EDITAR</button>
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
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2020 <a>System 32</a>.</strong> All rights
    reserved.
  </footer>

>

 
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
<script src="../vistas/Js/Validar_sistema.js"></script>
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
    
});
</script>
</body>
</html>
<?php require "../modelos/actualizar_pacientes_modelo.php" ?>
