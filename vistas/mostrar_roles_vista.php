<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
require_once "../modelos/conectar.php"; 
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>11,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE MOSTRAR USUARIOS MANTENIMIENTO',":fecha"=>date("Y-m-d H:m:s")));         
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>11,":accion"=>'CONSULTA',":descr"=>'MUESTRA LA LISTA DE USUARIOS  QUE HAY MANTENIMIENTO',":fecha"=>date("Y-m-d H:m:s")));

$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 31;
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
  <title>Mostrar roles</title>
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
  <link rel="stylesheet" href="../vistas/plugins/sweetalert/dist/sweetalert2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">

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

    <?php if ($PERM_OBJ== 1){ ?>
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

  <!-- =============================================== -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    LISTA DE ROLES
        
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

            <?php if ($CONSULTAR == 1){ ?>
              <div>
             <a href="../vistas/insertar_rol_vista.php" class="btn bg-blue btn-flat margin">AGREGAR ROL <i class="fa fa-plus" aria-hidden="true"></i> </a>
           </div>
            <?php } ?>
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>ROL</th>
                  <th>DESCRIPCIÓN</th>
                  <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
               <?php
               require '../modelos/conectar.php';
               $consulta=$conexion->prepare("SELECT * FROM tbl_rol ");
               $consulta->execute();
                 while($fila=$consulta->fetch()){?>
                 <tr>
                  <td><?php echo $fila['ROL_CODIGO']?></td>
				          <td><?php echo $fila['ROL_NOMBRE']?></td>
                  <td><?php echo $fila['ROL_DESCRIPCION']?></td>
                  <td>

                  <?php if ($ACTUALIZAR == 1){ ?>
                    <a href='../modelos/editar_rol_modelo.php?id=<?php echo $fila["ROL_CODIGO"]?>' class="btn bg-orange btn-flat margin">
                  <i class='fa fa-pencil'></i></a>
                  <?php } ?>

                  <?php if ($ELIMINAR == 1){ ?>
                    <a href='../modelos/eliminar_rol_modelo.php?id=<?php echo $fila["ROL_CODIGO"]?>'  class="btn btne bg-maroon bnt-flat margin">
				          <i class='fa fa-trash'></i></a>
                  <?php } ?>
				          
                   
				          </td>
                 </tr>
                 <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>ROL</th>
                  <th>DESCRIPCIÓN</th>
                  <th>ACCIONES</th>
                </tr>
                </tfoot>
              </table>
              <?php if (isset($_GET['m'])) : ?>
                <div class="flash-data" data-flashdata="<?= $_GET['m']; ?>"></div>
              <?php endif; ?>
            </div>
            <!-- /.box-body -->
          </div>
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

<!-- jQuery 2.2.3 -->
<script src="../vistas/plugins/jQuery/jquery-2.2.3.min.js"></script>
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
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<script src="../vistas/dist/js/demo.js"></script>
<script>
   $('.btne').on('click',function(e){
     e.preventDefault();
     const href=$(this).attr('href')
     Swal.fire({
  title: '¿ESTA SEGURO DE ELIMINAR ESTE ROL?',
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
       text:'SE HA ELIMINADO ROL CORRECTAMENTE'
     })
   }
</script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable({
      language: {
        sSearch: "Buscar:",
        sInfo:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        sLengthMenu:     "Mostrar _MENU_ registros",
        oPaginate: {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior" //traduccion de tabla
                }
    }});
    $('#example2').DataTable({
      "paging": true,
      "pagelength":3,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>

