<?php
session_start();
require_once '../modelos/conectar.php';
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>40,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA BACKUP/RESTORE',":fecha"=>date("Y-m-d H:i:s")));

$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 40;
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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Backup/Restore</title>
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
  <link rel="icon" href="../Img/Home.png">
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

  <?php require '../vistas/barra.php';  ?>

  <!-- =============================================== -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1><i class="fa fa-cloud" aria-hidden="true"></i>
        Backup/Restore
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="backup_vista.php"><i class="fa fa-cloud"></i> Backup/Restore</a></li>
        <li class="active"></i> Sistema ClimeHome</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab"><i class="fa fa-cloud-download" aria-hidden="true"></i> Copia de seguridad</a></li>
              <li><a href="#timeline" data-toggle="tab"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Restauración de copia de seguridad</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                        <span class="username">
                        </span>
                    <span class="description"></span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                 Este proceso de Copia de Seguridad es importante, ya que lo  realizamos para salvaguardar los documentos, archivos, fotos, perfil de pacientes ,correos electrónico y expedientes clínicos .Se realiza con el fin de poder recuperarlos en caso que se produzca su pérdida. Esta copia de seguridad también recibe el nombre de Copia de Respaldo e incluso Backup como se denomina.
                   <!--llamar funciones-->
            <div class="box-body">
            <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <div class="inner">
            <a href="../modelos/Backup_modelo.php"class="btn btn-lg bg-blue btn-flat margin"> Realizar copia de seguridad <i class="glyphicon glyphicon-cloud-download"></i></a>  
            </div>
            </div>
            </div>
                  </p>
                  <ul class="list-inline">
                    </li>
                    <li class="pull-right">
                  </ul>   
                </div>
                <!-- /.post -->
                <!-- Post -->
                 <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                        Iniciar restauración
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class=" fa fa-cog fa-spin fa-3x fa-fw bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i></span>

                      <h3 class="timeline-header"><a href="#">Restauración de copia de seguridad</a></h3>
                      <div class="timeline-body">
                      Este proceso de Restauración de copia de seguridad, restaura los documentos, archivos, fotos y perfil de pacientes ,correos electrónico y expedientes clínicos con los que contaba el Sistema ClimeHome hasta la última copia de seguridad que se ejecuto.
                      </div>
                      <div class="timeline-footer">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-cloud-upload bg-aqua"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i></span>

                      <h3 class="timeline-header no-border"><a href="#"></a>
                      <form action="../modelos/restore_modelo.php" method="POST">
                <select  name="restorePoint"class="form-control">
                 <option  value="" disabled="" selected=""> SELECCIONE LA FECHA DE COPIA DE SEGURIDAD:</option>
               <?php
			          	include_once '../modelos/connet_modelo.php';
				          $ruta=BACKUP_PATH;
                  if(is_dir($ruta))
                  {
                     if($aux=opendir($ruta))
                    {
                        while(($archivo = readdir($aux)) !== false)
                     {
                          if($archivo!="."&&$archivo!="..")
                          {
				                    $nombrearchivo=str_replace(".sql", "", $archivo);
				                    $nombrearchivo=str_replace("-", ":", $nombrearchivo);
				                    $ruta_completa=$ruta.$archivo;
                            if(is_dir($ruta_completa))
                            {
                            }
                            else
                             {
				                     echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
				                     }
				                  }
				             }
				               closedir($aux);
				            }
                  }
                  else{
				                echo $ruta." No es ruta válida";
			              	}
		      	?>
                 </select>
                 <p>
                 </p>
                      </h3>
                    </div>
                  </li>
                  
        <!--aqui comienza el boton------------------------------------------------------------------------------------------------------------>
      </div>

                 <div class="col text-center">
                 <button type="submit"class="btn btn-lg bg-blue btn-flat margin" >Restaurar copia de seguridad <i class="glyphicon glyphicon-cloud-upload"></i></button>  
                 </div>
           </form>
                </div>
        </div>
                <div class="post clearfix">
                  <div class="user-block">
                        <span class="username">
                        </span>
                    <span class="description"></span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                      </div>
                      <div class="col-sm-3">                      
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                        <span class="username">
                        </span>
                    <span class="description"></span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">                     
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">                       
                          <br>                         
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <br>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <ul class="list-inline">
                    </li>
                    <li class="pull-right">

                  </ul>
                </div>
                <!-- /.post -->
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
</body>
</html>

