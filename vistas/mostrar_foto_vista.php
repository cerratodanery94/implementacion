<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require_once '../modelos/conectar.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>25,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA MOSTRAR FOTO IRIS DEL EXPEDIENTE DOCTORA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));         
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>25,":accion"=>'CONSULTA',":descr"=>'MUESTRA FOTOS IRIS DEL OJO DE CORRESPONDIENTE PACIENTE ',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
  
  $ROL = $_SESSION['ROL'];
  $_SESSION['PANTALLA'] = 25;
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

  $PACIENTES=$DATOS['PERM_PACIENTES'];
  $NUTRI=$DATOS['PERM_EXP_NUTRI'];
  $MEDICO=$DATOS['PERM_EXP_MEDICO'];
  $CITAS=$DATOS['PERM_CITAS'];
  $SEGURIDAD=$DATOS['PERM_SEGURIDAD'];

  if(isset($_GET['id'])){
    $id=$_GET['id'];

    
    $sql="SELECT * from tbl_imagenes  where EXP_CODIGO= :id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
    $total = $resultado->fetchAll();
  
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
  <title> Fotografia del iris</title>
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
  <link rel="icon" href="Img/Home.png">
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
    <h1><i class="fa fa-eye" aria-hidden="true"></i>
      Fotografias del pacientes
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="mostrar_expediented_vista.php"><i class="fa fa-folder-open"></i>Expedientes médicos</a></li>
        <li class="active"><i class="fa fa-eye"></i> Fotografía del paciente</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
       </div>
        <section class="content">
        <ol class="breadcrumb">
        <li><a href="#"><i class=""></i>Expediente médico</a></li>
        <li class="active">Fotografía</li>
        <li class="active">Iris del ojo</li>
      </ol>
            <!--llamar funciones-->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
                <ol class="carousel-indicators">
        
                <?php
                $i = 0;
              foreach ($total as $row) {
              $actives = '';
              if($i == 0){
             $actives = 'active'; 
     
               }

              ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?=$i; ?>" class="<?= $actives;?>"></li>
                <?php $i++; } ?>  
              </ol>
                <div class="carousel-inner">
                     
                <?php
                $i = 0;
              foreach ($total as $row) {
              $actives = '';
              if($i == 0){
             $actives = 'active'; 
     
               }

              ?>

                  <div class="item  <?= $actives;?> ">
                  <img src="../vistas/fotos/<?= $row['RUTA'] ?>"  width="100%" height="400">

                  </div>
                 
                  <?php $i++; }  ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </>
            <!-- /.box-body -->
          </div>
        <!-- /.box-body -->
        
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      <div class="col text-center ">
              
              <a href="../vistas/mostrar_expediented_vista.php" class="btn btn-lg  btn bg-red" ><i class="fa  fa-arrow-circle-o-left" aria-hidden="true"></i> ATRÁS</a>
       </div>
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
<!-- AdminLTE for demo purposes -->
<script src="../vistas/dist/js/demo.js"></script>
</body>
</html>

