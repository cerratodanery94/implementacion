<?php
session_start();
require_once "../modelos/conectar.php"; 
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}

$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>33,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE MOSTRAR BITACORA',":fecha"=>date("Y-m-d"),":hora"=>date(" H:i:s")));         
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>33,":accion"=>'CONSULTA',":descr"=>'MUESTRA LOS REGISTROS DE LA BITACORA',":fecha"=>date("Y-m-d"),":hora"=>date(" H:i:s")));

  if (isset($_POST['desde']) && isset($_POST['hasta'])) { 
    $_SESSION['d']=$_POST['desde']; 
    $_SESSION['h']= $_POST['hasta'];
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bitácora del Sistema</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../vistas/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../vistas/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <!--date picker-->
   

   <link rel="stylesheet" href="../vistas/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">
  <link rel="icon" href="Img/Home.png">
</head>
<body class="hold-transition skin-blue sidebar-mini">

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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1><i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
        Bitácora Del Sistema
        <small>ClimeHome</small>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="bitacora_vista.php"><i class="fa fa-lock"></i>Bitácora</a></li>
        <li class="active"><i class="fa fa-caret-square-o-down"></i> Lista de registros</li>
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
            </div>
            <!--llamar funciones-->
            <div class="box-body">
            <form action="../vistas/reporte_bitacora.php" method="post" name="formulario_bitacora">
          <div id="alerta"></div>
            <div class="form-group col-lg-3 col-md-3 col-xs-3">
                <div class="input-group">
                <span class="input-group-addon">DESDE</span>
            <input type="date" autocomplete="off" class="form-control" name="desde" id="desde">
            </div>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-xs-3">
                <div class="input-group">
                <span class="input-group-addon">HASTA</span>
            <input type="date" autocomplete="off" class="form-control" name="hasta" id="hasta">
            </div>
            </div>
           
            <div class="form-group col-lg-3 col-md-3 col-xs-3">
            <button type="button" onclick="validar_bitacora();" class="btn btn-block  btn btn-primary" >CONSULTAR</button>
            
            </div>
            <div class="form-group col-lg-3 col-md-3 col-xs-3">
            <a href='../modelos/bitacora_reporte.php?d=<?php echo $_SESSION['d'];?>&h=<?php echo $_SESSION['h'];?>' class="btn btn-block btn-danger">EXPORTAR A PDF</a>
            </div>
            <?php
         try{
         if (isset($_POST['desde']) && isset($_POST['hasta'])) {
          require '../modelos/conectar.php';
          $_SESSION['d']=$_POST['desde'];
          $_SESSION['h']= $_POST['hasta'];
          if ($_SESSION['d']>$_SESSION['h']) {
            //echo '<script>alert("Usuario  ya se encuentran registrados ");location.href= "../vistas/insertar_mant_vista.php"</script>';
            echo '<script> Swal.fire({
              position: "center",
              icon: "error",
              title: "LA PRIMERA FECHA NO PUEDE SER MAYOR ALA SEGUNDA",
              showConfirmButton: false,
              timer: 3000
              })
              </script>';
          } else {
           
          
          echo'<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>USUARIO</th>
                  <th>PANTALLA</th>
                  <th>ACCIÓN</th>
                  <th>FECHA</th>
                  <th>HORA</th>      

                </tr>
                </thead>
                <tbody>';
                $consulta=$conexion->prepare("SELECT * FROM tbl_bitacora b INNER JOIN tbl_usuario u on b.usu_codigo = u.usu_codigo INNER JOIN tbl_objetos o ON b.obj_codigo=o.obj_codigo WHERE b.bit_fecha BETWEEN '$_SESSION[d]' AND '$_SESSION[h]' ORDER BY b.bit_fecha ASC");
                $consulta->execute();
                  while($fila=$consulta->fetch()){  
                    
                    echo'<tr>
                    <td>';echo $fila['USU_USUARIO'];
                    echo'</td><td>';echo $fila['OBJ_NOMBRE']; 
                    echo'</td><td>'; echo$fila['BIT_ACCION'];
                    echo'</td><td>'; echo$fila['BIT_FECHA'];
                    echo'</td><td>';echo$fila['BIT_HORA'];
                    echo'</td></tr>';
                  }
                  echo'</tbody>
                  <tfoot>
                  <tr>
                    <th>USUARIO</th>
                    <th>PANTALLA</th>
                    <th>ACCIÓN</th>
                    <th>FECHA</th>
                    <th>HORA</th>   
  
  
                  </tr>
                  </tfoot>
                </table>';
              
              }
          
          }
           }catch(Exception $e){			
            die('Error: ' . $e->GetMessage());
        echo "Codigo del error" . $e->getCode();

           }
           ?>
            </form>
            
            
             
           
             
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<script src="../vistas/js/validar_sistema.js"></script>
<!-- jQuery 2.2.3 -->

<script src="../vistas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../controladores/funciones.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../vistas/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../vistas/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../vistas/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../vistas/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../vistas/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../vistas/dist/js/demo.js"></script>
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<!-- Date Picker-->
<script src="../vistas/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- page script -->
<!-- librerias para el uso del  pdf-->
<script type="text/javascript" src="../vistas/reportes/JSZip-2.5.0/jszip.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/pdfmake.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/vfs_fonts.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.flash.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.html5.min.js"></script>
</body>
</html>
<script>
 $(document).ready(function() {
   $('#example1').DataTable({
     language: {
         "decimal": "",
         "emptyTable": "No hay información",
         "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
         "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
         "infoFiltered": "(Filtrado de _MAX_ total entradas)",
         "infoPostFix": "",
         "thousands": ",",
         "lengthMenu": "Mostrar _MENU_ Entradas",
         "loadingRecords": "Cargando...",
         "processing": "Procesando...",
         "search": "Buscar:",
         "zeroRecords": "Sin resultados encontrados",
         "paginate": {
             "first": "Primero",
             "last": "Ultimo",
             "next": "Siguiente",
             "previous": "Anterior"
         }
     },
     
   });
 });
 
         </script>
