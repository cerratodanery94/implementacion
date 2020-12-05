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
if (isset($_POST['id_u']) && isset($_POST['est_c']) && isset($_POST['desde']) && isset($_POST['hasta'])) {
  
  $_SESSION['doc']=$_POST['id_u'];
  $_SESSION['est_c']=$_POST['est_c'];
  $_SESSION['i']=$_POST['desde'];
  $_SESSION['f']= $_POST['hasta'];
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
            <form action="../vistas/reporte_citas.php" method="post">
            <table>
              <tr>
                  <td>
              
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                <label for="">SELECCIONE DOCTORA/DOCTOR/NUTRICIONISTA:</label>
             <select class="form-control" name="id_u" id="doctora" required>
             <option value="">SELECCIONE:</option>
                <?php
               require '../modelos/conectar.php';
               $resultado = $conexion -> query ("SELECT * FROM TBL_USUARIO where ROL_CODIGO=3 or ROL_CODIGO=4");
              while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$registro["ROL_CODIGO"].'">'.$registro["USU_NOMBRES"]." ".$registro["USU_APELLIDOS"].'</option>';
               }
               ?>
                <option value="3,4">CUALQUIERA</option>
              </select>
            </div>
           
                  </td>
                   
                  <td>
                 
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                <label for="">SELECCIONE ESTADO:</label>
            <select class="form-control" name="est_c" id="est_c" required>
             <option value="">SELECCIONE:</option>
             <option value="'PENDIENTE'">PENDIENTE</option>
             <option value="'REALIZADA'">REALIZADA</option>
             <option value="'CANCELADA'">CANCELADA</option>
             <option value="'NO SE PRESENTO'">NO SE PRESENTO</option>
             <option value="'PENDIENTE','REALIZADA','CANCELADA','NO SE PRESENTO'">TODOS</option>
            </select>
          </div>
          
          </td>
              <td>
                 
           
                  </td>
                  <td> 
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                <label for="">DESDE</label>
            <input type="date" autocomplete="off" class="form-control" name="desde" id="desde" required>
            </div>
            </div></td>
                  <td>
                 
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                <label>HASTA</label>
            <input type="date" autocomplete="off" class="form-control" name="hasta" id="hasta" required>
            </div>
            
                  </td>
                 
              
           <td>
           <div class="form-group col-lg-12 col-md-12 col-xs-12">
           <button type="submit"  class="btn btn-block  btn btn-primary" >CONSULTAR</button>
           
            </div>
            <div class="form-group col-lg-12 col-md-12 col-xs-12">
          
           <a href='../modelos/citas_reporte.php?doc=<?php echo $_SESSION['doc'];?>&i=<?php echo $_SESSION['i'];?>&f=<?php echo $_SESSION['f'];?>' class="btn btn-block btn-danger">EXPORTAR A PDF</a>
            </div>
           </td>
              </tr>
           </table>
           <br>
           
           
            <?php
         try{
         if (isset($_POST['id_u']) && isset($_POST['est_c']) && isset($_POST['desde']) && isset($_POST['hasta'])) {
          require '../modelos/conectar.php';
          $_SESSION['doc']=$_POST['id_u'];
          $_SESSION['est_c']=$_POST['est_c'];
          $_SESSION['i']=$_POST['desde'];
          $_SESSION['f']= $_POST['hasta'];
          if ($_SESSION['i']>$_SESSION['f']) {
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
            <th>ATENCION CON</th>
            <th>PACIENTE</th>
            <th>FECHA</th>
            <th>HORA DE CITA</th>
            <th>ESTADO</th>         
          </tr>
          </thead>
          <tbody>';
                $consulta=$conexion->prepare("SELECT * from tbl_citas c INNER JOIN tbl_personas p on c.per_codigo = p.per_codigo INNER JOIN tbl_usuario u  ON c.usu_codigo=u.usu_codigo  INNER JOIN tbl_horario h ON c.hor_codigo=h.hor_codigo INNER JOIN tbl_rol r on r.rol_codigo=u.ROL_CODIGO WHERE r.rol_codigo in($_SESSION[doc]) and c.cit_estado IN ($_SESSION[est_c]) AND c.cit_fecha_cita BETWEEN '$_SESSION[i]' AND '$_SESSION[f]' AND c.cit_estado_registro = 'A'");
                $consulta->execute();
                  while($fila=$consulta->fetch()){  
                    
                    echo'<tr>
                    <td>'; echo $fila['USU_NOMBRES']." ". $fila['USU_APELLIDOS'];
                    echo'</td><td>';echo $fila['PER_NOMBRES']." ". $fila['PER_APELLIDOS']; 
                    echo'</td><td>';echo $fila['CIT_FECHA_CITA'];
                    echo'</td><td>';echo $fila['HOR_HORA'];
                    echo'</td><td>';echo $fila['CIT_ESTADO'];
                    echo'</td></tr>';
                  }
                  echo'</tbody>
                  <tfoot>
                  <tr>
                  <th>ATENCION CON</th>
                  <th>PACIENTE</th>
                  <th>FECHA</th>
                  <th>HORA DE CITA</th>
                  <th>ESTADO</th>    
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
