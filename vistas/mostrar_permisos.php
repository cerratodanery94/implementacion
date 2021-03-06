<?php
session_start();
require_once "../modelos/conectar.php"; 
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>58,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE MOSTRAR PERMISOS',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));         
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>58,":accion"=>'CONSULTA',":descr"=>'MUESTRA LA LISTA DE PERMISOS',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mostrar Permisos</title>
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
  <link rel="icon" href="Img/Home.png">
  <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">
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
    <h1><i class="fa fa-list-alt" aria-hidden="true"></i>
        Lista de Permisos 
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="../vistas/index2.php"><i class="fa fa-home"></i>Panel de control</a></li>
        <li><a href="mostrar_permisos.php"><i class="glyphicon glyphicon-random"></i>Permisos</a></li>
        <li class="active"><i class="fa fa-list-alt"></i> Lista de permisos</li>
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
            <?php if ($_SESSION['cperm']== 1 and $_SESSION['iperm']== 1){ ?>
              <div>
             <a href="../vistas/insertar_permisos.php" class="btn bg-blue btn-flat margin">INSERTAR PERMISOS <i class="fa fa-plus-circle" aria-hidden="true"></i> </a>
           </div>
            <?php } ?>
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ROL</th>
                  <th>USUARIO</th>
                  
                  <th>PANTALLA</th>
                  <th>CONSULTAR</th>
                  <th>CREAR</th>
                  <th>EDITAR</th>
                  <th>ELIMINAR</th>
                  <th>ACCIONES</th>
               
                  
                  
				          
                </tr>
                
                </thead>
                <tbody>
                <?php
               require '../modelos/conectar.php';
               $consulta=$conexion->prepare("SELECT * from tbl_permisos p INNER JOIN tbl_rol r on p.rol_codigo = r.rol_codigo INNER JOIN tbl_objetos o on p.obj_codigo = o.obj_codigo INNER JOIN tbl_usuario u  ON u.rol_codigo=r.rol_codigo");
               $consulta->execute();
                 while($fila=$consulta->fetch()){?>
                 <tr>
                 <td><?php echo $fila['ROL_NOMBRE']?></td>
                 <td><?php echo $fila['USU_USUARIO']?></td>
                 
                 <td><?php echo $fila['OBJ_NOMBRE']?></td>    
                 <td><?php if ($fila['PERM_CONSULTAR']==1) {echo 'SI';} else {echo 'NO';} ?></td>
                 <td><?php if ($fila['PERM_INSERTAR']==1) {echo 'SI';} else {echo 'NO';} ?></td>
                 <td><?php if ($fila['PERM_ACTUALIZAR']==1) {echo 'SI';} else {echo 'NO';} ?></td>
                 <td><?php if ($fila['PERM_ELIMINAR']==1) {echo 'SI';} else {echo 'NO';} ?></td>
                
                 
                 <td>
                 <?php if ($_SESSION['cperm']== 1 and $_SESSION['eperm']== 1){ ?>
                  <a href='../modelos/eliminar_permisos.php?id=<?php echo $fila["PERM_CODIGO"]?>' class="btn btne bg-maroon bnt-flat margin">
					       <i class='fa fa-trash'></i></a> 
                 <?php } ?>
                 
                 </td>
            
                 </tr>
                 <?php } ?> 
                </tbody>
                <tfoot>
                <tr>
                <th>ROL</th>
                  <th>USUARIO</th>
                  
                  <th>PANTALLA</th>
                  <th>CONSULTAR</th>
                  <th>CREAR</th>
                  <th>EDITAR</th>
                  <th>ELIMINAR</th>
                  <th>ACCIONES</th>
                
                </tr>
                </tfoot>
              </table>
              <?php if (isset($_GET['m'])) : ?>
                <div class="flash-data" data-flashdata="<?= $_GET['m']; ?>"></div>
              <?php endif; ?>
          <!-- /.box -->
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

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

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
<!-- librerias para el uso del  pdf-->
<script type="text/javascript" src="../vistas/reportes/JSZip-2.5.0/jszip.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/pdfmake.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/vfs_fonts.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.flash.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.html5.min.js"></script>
<script>
   $('.btne').on('click',function(e){
     e.preventDefault();
     const href=$(this).attr('href')
     Swal.fire({
  title: '¿ESTA SEGURO DE ELIMINAR ESTA PERMISO?',
  text: "¡NO PODRÁS REVERTIR ESTO!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ELIMINAR',
  cancelButtonText: 'CANCELAR',
}).then((result) => {
  if (result.value) {
    document.location.href=href;
  }
})
   })
   const flashdata=$('.flash-data').data('flashdata')
   if (flashdata) {
    swal.fire({
       icon:'success',
       title:'ELIMINADO',
       text:'SE HA ELIMINADO EL PERMISO CORRECTAMENTE'
     })
   }
</script>
</script>
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
</body>
</html>
