<?php
session_start();
try {
  require '../modelos/conectar.php';
  if(isset($_GET['id'])){
    $id=$_GET['id'];

    
    $sql="SELECT * from tbl_citas c INNER JOIN tbl_personas p on c.per_codigo = p.per_codigo INNER JOIN tbl_usuario u  ON c.usu_codigo=u.usu_codigo WHERE CIT_CODIGO=:id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
    $fila=$resultado->fetch();
    $id_c=$fila['CIT_CODIGO']; 
    $id_p=$fila['PER_CODIGO']; 
    $id_u=$fila['USU_CODIGO'];
    $nombres=$fila['PER_NOMBRES'];
    $apellidos=$fila['PER_APELLIDOS'];
    $edad=$fila['PER_EDAD'];
    $identidad=$fila['PER_NUMERO_IDENTIDAD'];
    $fecha_cita=$fila['CIT_FECHA_CITA'];
    $hora_inicio=$fila['CIT_HORA_INICIO'];
    $hora_final=$fila['CIT_HORA_FINAL'];
    $estado=$fila['CIT_ESTADO']; 
    $descrip=$fila['CIT_DESCRIPCION'];  
   }
  }
  
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}
$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 29;
$PANTALLA = $_SESSION['PANTALLA'];
$sql3 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO = :pantalla ";
$resultado3=$conexion->prepare($sql3);	
$resultado3->execute(array(":rol"=>$ROL,":pantalla"=>$PANTALLA));
$DATOS = $resultado3->fetch(PDO::FETCH_ASSOC);
 $CONSULTAR = $DATOS['PERM_CONSULTAR'];
 $INSERTAR = $DATOS['PERM_INSERTAR'];
 $ELIMINAR = $DATOS['PERM_ELIMINAR'];
 $ACTUALIZAR = $DATOS['PERM_ACTUALIZAR'];
 $PERM_OBJ = $DATOS['PERM_OBJ'];
  
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Editar cita</title>
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

  <link rel="stylesheet" type="text/css" href="../vistas/select2/select2.min.css">



  
 
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">


<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header ">
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

        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_vista.php"><i class="fa fa-list"></i>Lista de Usuarios</a></li>
        </ul>
       <?php } ?>
        
      </li>
       <!-- Titulo de Empleados -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Empleados</span>

        </a>
        <!-- subtitulos de Empleados -->

        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_empleados_vista.php"><i class="fa fa-list"></i> Lista de Empleados</a></li>
        </ul>
        <?php } ?>
        
      </li>
     
      <!-- Titulo de Pacientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Pacientes</span>

        </a>
        <!-- subtitulos de Pacientes -->
        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_pacientes_vista.php"><i class="fa fa-list"></i>Lista de Pacientes</a></li>
        </ul>
       <?php } ?>
        
      </li>
      <!-- Titulo de Expedientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open-o"></i>
          <span>Expedientes Nutricionista</span>

          </a>
        <!-- subtitulos de Expedientes -->
        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expedienten_vista.php"><i class="fa fa-list"></i>Mostrar Expediente Nutricional</a></li>
        </ul>
         <?php } ?>
        
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open-o"></i>
          <span>Expedientes Medico </span>

          </a>
        <!-- subtitulos de Expedientes -->
        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expediented_vista.php"><i class="fa fa fa-list"></i>Mostrar Expediente Médico </a></li>
        </ul>
        <?php } ?>
       
      </li>
      <!-- Titulo de Citas -->
      <li class="treeview">
        <a href="../vistas/citas_vista.php">
          <i class="fa fa-calendar"></i>
          <span>Citas</span>
          </a>

          <?php if ($PERM_OBJ == 1){ ?>
            <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_citas_vista.php"><i class="fa fa-list"></i>Lista de citas</a></li>
        </ul>
           <?php } ?>
        
      </li>
        </a>
      </li>
 <!-- Titulo de Seguridad -->

    <?php if ($PERM_OBJ == 1){ ?>
      <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-lock"></i>
          <span>Seguridad</span>

        </a>
        <!-- subtitulos de Seguridad -->
        <ul class="treeview-menu">
        <li><a href="../vistas/insertar_permisos_vista.php"><i class="fa fa-list"></i>Añadir Permisos</a></li>
          <li><a href="../vistas/mostrar_parametros_vista.php"><i class="fa fa-list"></i>Lista de Parámetros</a></li>
          <li><a href="../vistas/mostrar_roles_vista.php"><i class="fa fa-list"></i>Lista de Roles</a></li>
          <li><a href="#"><i class="glyphicon glyphicon-cloud-upload"></i>Backup</a></li>
          <li><a href="../vistas/bitacora_vista.php"><i class="fa fa-list"></i>Bitácora</a></li>
        </ul>
      </li>
    <?php } ?>

   
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        EDITAR CITAS
        
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
<!--box-header-->
<div id="alerta"></div>
<!--centro-->
         <input type="hidden" name="id" id="id" value="<?php echo $id_p?>">

          <div class="form-group col-lg-6 col-md-6 col-xs-12">
             <br>
             <label for="exampleInputEmail1">NOMBRES</label>
             <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="nombres" id="nombres" value="<?php echo $nombres?>"  readonly   >
          </div>
           
         <div class="form-group col-lg-6 col-md-6 col-xs-12">
         <br>
           <label for="exampleInputEmail1">APELLIDOS</label>
           <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="APELLIDOS"  name="apellidos" id="apellidos" value="<?php echo $apellidos?>" readonly   >
         </div>

         <div class="form-group col-lg-6 col-md-6 col-xs-12">
           <label for="exampleInputPassword1">EDAD</label>
           <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="EDAD"  name="edad" id="edad" value="<?php echo $edad?>" readonly   >
         </div>

        <div class="form-group col-lg-6 col-md-6 col-xs-12">
          <label for="exampleInputPassword1">NUMERO DE IDENTIDAD</label>
          <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="identidad" id="identidad" value="<?php echo $identidad?>" readonly    >
        </div> 
        

          <form action="" method="post" name="form_cita"> 
          <input type="hidden" name="id_c" id="id_c" value="<?php echo $id_c?>">   
          <input type="hidden" name="id_u" id="id_u" value="<?php echo $id_u?>">
          <input type="hidden" name="id_p" id="id_p" value="<?php echo $id_p?>" >
        
          <div class="form-group col-lg-6 col-md-6 col-xs-12"> 
            <label for="exampleInputPassword1">FECHA DE LA CITA</label>
            <input type="date" autocomplete="off" class="form-control nombres" name="fecha_cita" id="fecha_cita" value="<?php echo $fecha_cita?>">
          </div>

          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">DOCTORA</label>
            <select class="form-control" name="id_u" id="doctora">
             <option value="0">SELECCIONE DOCTORA:</option>
             <option value="44" <?php if ($id_u==44) { echo 'selected'; }?>>LILIANA DIAZ</option>    
             <option value="45" <?php if ($id_u==45) { echo 'selected'; }?>>MARIA SERRANO</option>  
            </select>
          </div>
            
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">HORA DE INICIO CITA</label>
            <input type="time" autocomplete="off" class="form-control" name="hora_inicio" id="hora_inicio" value="<?php echo $hora_inicio?>">
          </div>
            
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">HORA FINAL CITA</label>
            <input type="time" autocomplete="off" class="form-control" name="hora_final" id="hora_final" value="<?php echo $hora_final?>">
            </div>

          <div class="form-group  col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">ESTADO</label>
            <select class="form-control" name="estado" id="estado">
             <option value="0">SELECCIONE EL ESTADO DE LA CITA:</option>
             <option value="PENDIENTE"<?php if ($estado=='PENDIENTE') { echo 'selected';}?>>PENDIENTE</option>
             <option value="REALIZADA"<?php if ($estado=='REALIZADA') { echo 'selected';}?>>REALIZADA</option>
             <option value="CANCELADA"<?php if ($estado=='CANCELADA') { echo 'selected';}?>>CANCELADA</option>
             <option value="NO SE PRESENTO"<?php if ($estado=='NO SE PRESENTO') { echo 'selected';}?>>NO SE PRESENTO</option>
            </select>
          </div>

          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">DESCRICIÓN</label>
            <input type="text" style="text-transform:uppercase" autocomplete="off" class="form-control" name="descrip" id="descrip" value="<?php echo $descrip?>">
          </div>
         
          <div class="box-footer">
          <div class="col text-center">
            <button type="button" onclick="validar_cita();" class="btn btn-primary btn-flat margin">ACTUALIZAR</button>
            <a href="../vistas/mostrar_citas_vista.php" class="btn bg-red btn-flat margin" >ATRAS</a>
          </div>
          </div>
          </form>
          </div>      
          </div>
<!--fin centro-->
          </div>
          </div>
          </div>
      <!-- /.box -->
         </section>
    <!-- /.content -->
         </div>
<script src="../vistas/js/validar_sistema.js"></script>
<!-- jQuery 2.2.3 -->
<script src="../vistas/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="../vistas/select2/select2.min.js"></script>
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
<?php require "../modelos/actualizar_cita_modelo.php"?>
