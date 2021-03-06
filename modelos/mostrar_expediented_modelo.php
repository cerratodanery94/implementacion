<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require '../modelos/conectar.php';
  require '../controladores/funciones.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>26,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA MOSTRAR EXPEDIENTE DOCTORA DE UN PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));         
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>26,":accion"=>'CONSULTA',":descr"=>'MUESTRA LA INFORMACION DEL EXPEDIENTE DOCTORA DE UN PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
  if(isset($_GET['id'])){
    $id=$_GET['id'];

    
    $sql="SELECT * from tbl_expedientes a INNER JOIN tbl_personas b on a.per_codigo = b.per_codigo where EXP_CODIGO= :id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
   $fila=$resultado->fetch();
    $id_p=$fila['PER_CODIGO']; 
    $id_u=$fila['EXP_CODIGO'];
    $nombres=$fila['PER_NOMBRES'];
    $apellidos=$fila['PER_APELLIDOS'];
    $fecha_nacimiento=$fila['PER_FECHA_NACIMIENTO'];
    $edad=mi_edad($fila['PER_FECHA_NACIMIENTO']);
    $identidad=$fila['PER_NUMERO_IDENTIDAD'];
    $fecha=$fila['EXP_FECHA_CREACION'];
    $apuntes=$fila['EXP_ANTECEDENTES_CLINICOS'];
    $medicamento=$fila['EXP_MEDICAMENTO'];
 
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
  <title>Visualizar expediente</title>
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
  <link rel="icon" href="../vistas/Img/Home.png">
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
            <i class="fa fa-sign-out"></i>
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

  <?php require '../vistas/barra.php';  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1><i class="fa fa-medkit" aria-hidden="true"></i>
       Historial médico
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../vistas/mostrar_expediented_vista.php"><i class="fa fa-folder-open"></i> Expedientes médicos</a></li>
        <li class="active"><i class="fa fa-medkit"></i>  Historial médico</li>
      </ol>
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
<div class="form-group col-lg-6 col-md-6 col-xs-12">
        <div class="input-group">
                <span class="input-group-addon">Nombres</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="nombres" id="nombres" value="<?php echo $nombres?>"  readonly   >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                </div>
           
         
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Apellidos</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="APELLIDOS"  name="apellidos" id="apellidos" value="<?php echo $apellidos?>" readonly   >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Identidad</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="identidad" id="identidad" value="<?php echo $identidad?>" readonly    >
                  <span class="	glyphicon glyphicon-credit-card form-control-feedback"></span>
                </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de nacimiento</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="EDAD"  name="edad" id="edad" value="<?php echo $fecha_nacimiento?>" readonly   >
                  <span class="	glyphicon glyphicon glyphicon-gift form-control-feedback"></span>
                </div>
                </div>


          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Edad</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="EDAD"  name="edad" id="edad"value="<?php echo $edad?>"readonly>
                  <span class="		glyphicon glyphicon-hourglass form-control-feedback"></span>
                </div>
                </div>

          

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de registro</span>
                  <input type="date" autocomplete="off" class="form-control nombres" placeholder="FECHA DE CREACION" name="fecha_de_creacion" id="fecha_de_creacion" value="<?php echo $fecha?>" readonly  >
                  <span class="	glyphicon glyphicon-time form-control-feedback"></span>
                </div>
                </div>
          </form> 

          <form action="" method="post" name="frm_exp"> 
           <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id" id="id" value="<?php echo $id_u?> "   >

           <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id" id="id" value="<?php echo $registro['PER_CODIGO']?>"   >
           <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Descripciones médicas</span>
                  <textarea class="form-control" name="apuntes" id="apuntes" rows="10" cols="50" readonly  > <?php echo $apuntes?> </textarea >
                  <span class="glyphicon glyphicon-option-vertical form-control-feedback"></span>
                </div>
                </div> 

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Medicamentos</span>
                  <textarea class="form-control" name="medicamento" id="medicamento" rows="10" cols="50" readonly   ><?php echo $medicamento?> </textarea >
                  <span class="		glyphicon glyphicon-option-vertical form-control-feedback"></span>
                </div>
                </div> 
               
               
                <div class="box-footer">
              <div class="col text-center">
                <a href="../vistas/mostrar_expediented_vista.php" class="btn btn-lg  btn bg-red" ><i class="fa  fa-arrow-circle-o-left" aria-hidden="true"></i> ATRÁS</a>
                </div>
              </div>
                </form>
      </div>
 
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    <strong><a>Version 2.0</a></strong> 
    </div>
    <strong>Copyright &copy; 2020 <a>| EQUIPO SYSTEM 32</a>.</strong> Todos los derechos reservados.
  </footer>



 

<script src="../vistas/js/validaciones.js"></script>
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
<?php require "../modelos/insertar_expedienten_modelo.php" ?>
