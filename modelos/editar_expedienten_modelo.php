<?php
session_start();
try {
  require '../modelos/conectar.php';
  if(isset($_GET['id'])){
    $id=$_GET['id'];

    
    $sql="SELECT * from tbl_expediente_nutricionista a INNER JOIN tbl_personas b on a.per_codigo = b.per_codigo where NUTRI_CODIGO= :id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
   $fila=$resultado->fetch();
    $id_p=$fila['PER_CODIGO']; 
    $id_u=$fila['NUTRI_CODIGO'];
    $nombres=$fila['PER_NOMBRES'];
    $apellidos=$fila['PER_APELLIDOS'];
    $edad=$fila['PER_EDAD'];
    $identidad=$fila['PER_NUMERO_IDENTIDAD'];
		$peso=$fila['NUTRI_PESO'];
		$estatura=$fila['NUTRI_ALTURA'];
		$presion=$fila['NUTRI_PRESION_ARTERIAL'];
		$temperatura=$fila['NUTRI_TEMPERATURA'];
		$antecedentes=$fila['NUTRI_ANTECEDENTES_CLINICOS'];
    $dieta=$fila['NUTRI_DIETA'];
    $fecha=$fila['NUTRI_FECHA_CREACION'];
		 
     
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

  <link rel="stylesheet" type="text/css" href="../vistas/select2/select2.min.css">



  
 
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">


<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header ">
    <!-- Logo -->
    <a href="../vistas/index2.php" class="logo">
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
        <li><a href="../vistas/insertar_expedienten_vista.php"><i class="fa fa-plus-square"></i>Añadir Expediente Nutri</a></li>
          <li><a href="../vistas/mostrar_expedienten_vista.php"><i class="fa fa-list"></i>Mostrar Expediente Nutri</a></li>
          <li><a href="../vistas/insertar_expediented_vista.php"><i class="fa fa-plus-square"></i>Añadir Expediente Doc </a></li>
          <li><a href="../vistas/mostrar_expediented_vista.php"><i class="fa fa-list"></i>Mostrar Expediente Doc </a></li>

        </ul>
      </li>
      <!-- Titulo de Citas -->
      <li class="treeview">
        <a href="../vistas/citas_vista.php">
          <i class="fa fa-calendar"></i>
          <span>Citas</span>
        </a>
      </li>
      <!-- Titulo de Proveedores -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-truck"></i>
          <span>Proveedores</span>

          <!-- subtitulos de proveedores -->
        </a>
        <ul class="treeview-menu">
          <li><a href="../vistas/insertar_prov_vista.php"><i class="fa fa-plus-square"></i>Añadir Proveedor</a></li>
          <li><a href="../vistas/mostrar_prov_vista.php"><i class="fa fa-list"></i>Lista de Proveedores</a></li>

        </ul>
      </li>
      <!-- Titulo de Productos -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-medkit"></i>
          <span>Productos</span>

        </a>
        <!-- subtitulos de Productos -->
        <ul class="treeview-menu">
        <li><a href="../vistas/insertar_prod_vista.php"><i class="fa fa-plus-square"></i>Añadir producto</a></li>
          <li><a href="../vistas/mostrar_prod_vista.php"><i class="fa fa-list"></i>Lista de Productos</a></li>
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
        <li><a href="../vistas/insertar_comp_vista.php"><i class="fa fa-plus-square"></i>Añadir Compra</a></li>
          <li><a href="../vistas/mostrar_comp_vista.php"><i class="fa fa-list"></i>Lista de Compras</a></li>

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
        <li><a href="../vistas/insertar_vent_vista.php"><i class="fa fa-plus-square"></i>Añadir venta</a></li>
          <li><a href="../vistas/mostrar_vent_vista.php"><i class="fa fa-list"></i>Lista de Ventas</a></li>

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
          <li><a href="#"><i class="fa fa-plus-square"></i>Mostrar Inventario</a></li>
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
          <li><a href="#"><i class="fa fa-circle-o"></i>Agregar Administrador</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Agregar Venta</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Actualizar Ventas</a></li>
      </ul>

 <!-- Titulo de Seguridad -->
 <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-lock"></i>
          <span>Seguridad</span>

        </a>
        <!-- subtitulos de Seguridad -->
        <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_parametros_vista.php"><i class="fa fa-list"></i>Lista de Parámetros</a></li>
          <li><a href="#"><i class="fa fa-list"></i>Lista de Roles</a></li>
          <li><a href="#"><i class="glyphicon glyphicon-cloud-upload"></i>Backup</a></li>
          <li><a href="../vistas/bitacora_vista.php"><i class="fa fa-list"></i>Bitácora</a></li>
        </ul>
      </li>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ACTUALIZAR INFORMACION DEL EXPEDIENTE
        
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


<input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id" id="id" value="<?php echo $id_p?>" readonly  >
<div id="alerta"></div>
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
           
          </form> 
          <form action="" method="post" name="form_exp"> 
           <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id_e" id="id_e" value="<?php echo $id_u?> "   >
           <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id" id="id" value="<?php echo $id_p?>" readonly  >
      
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">PESO</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="PESO"  name="peso" id="peso" value="<?php echo $peso?>" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">ESTATURA</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="ESTATURA"  name="estatura" id="estatura"  value="<?php echo $estatura?>" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">PRESION ARTERIAL</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="PRESION ARTERIAL"  name="presion" id="presion_arterial"  value="<?php echo $presion?>" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">TEMPERATURA</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="TEMPERATURA"  name="temperatura" id="temperatura"  value="<?php echo $temperatura?>" >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">ANTECEDENTES CLINICOS</label>
                  <textarea class="form-control" name="antecedentes" id="antecedentes" rows="10" cols="50"  ><?php echo $antecedentes?> </textarea >
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">DIETA</label>
                  <textarea class="form-control" name="dieta" id="dieta" rows="10" cols="50"  > <?php echo $dieta?> </textarea >
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA DE CREACION</label>
                  <input type="text" autocomplete="off" class="form-control nombres" placeholder="FECHA DE CREACION" name="fecha_de_creacion" id="fecha_de_creacion" value="<?php echo $fecha?> " readonly>
                </div>
         
                <div class="box-footer">
              <div class="col text-center">
             
              <button type="button" onclick="validar_expediente();"  class="btn btn-primary btn-flat margin">ACTUALIZAR</button>
                <a href="../vistas/mostrar_expedienten_vista.php" class="btn bg-red btn-flat margin" >ATRAS</a>
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
<?php require "../modelos/actualizar_expedienten_modelo.php" ?>
