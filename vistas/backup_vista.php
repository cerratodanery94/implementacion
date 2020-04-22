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
      <h1>
        BACKUP Y RESTORE
        
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
            <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <div class="inner">
            <a href="../modelos/Backup_modelo.php"class="btn bg-blue btn-flat margin">REALIZAR COPIA DE SEGURIDAD <i class="glyphicon glyphicon-cloud-download"></i></a>  
            </div>
        <!--aqui comienza el boton------------------------------------------------------------------------------------------------------------>
      </div>
      <div class=" form-group col-lg-6 col-md-6 col-xs-12">
          <!-- small box -->
       <form action="../modelos/restore_modelo.php" method="POST">
           <label for="exampleInputPassword1">COPIA DE SEGURIDAD</label>
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
     
                 <div class="col text-center">
                 <button type="submit"class="btn bg-blue btn-flat margin" >Restaurar <i class="glyphicon glyphicon-cloud-upload"></i></button>  
                 </div>
           </form>
                </div>
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
</body>
</html>


