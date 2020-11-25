<?php
session_start();
require_once "../modelos/conectar.php"; 
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>28,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE MOSTRAR CITAS',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));         
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>28,":accion"=>'CONSULTA',":descr"=>'MUESTRA LA LISTA DE CITAS DE PACIENTES',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Insertar permisos</title>
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
    <h1><i class="fa fa-lock" aria-hidden="true"></i>
  Insertar permisos<i class="fas fa-suitcase-rolling    "></i>
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="insertar_permisos.php"><i class="fa fa-lock"></i>Permiso</a></li>
        <li class="active"><i class="fa fa-search-plus"></i> Buscar rol</li>
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
              
            <form action="" method="POST">

             <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Nombre del rol</span>
                <select class="form-control" name="rol" id="rol" required>
        <option value="">SELECCIONE EL ROL AL QUE QUIERE ASIGNAR PERMISO:</option>
                <?php
        require '../modelos/conectar.php';
          $resultado = $conexion -> query ("SELECT * FROM TBL_ROL");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="'.$registro["ROL_CODIGO"].'">'.$registro["ROL_NOMBRE"].'</option>';
          }
        ?>
        </select>
                </div>
                </div>
            
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>MODULO</th>
                  <th>ACCION</th>
                  <th>¿ACCESO?</th>
             
      
                </tr>
                
                </thead>
                <tbody>
                
                <tr> <!--INICIO USUARIO-->
                  <td>USUARIO</td>
                  <td>MOSTRAR USUARIO</td>
                  <td>
                        <select class="form-control" name="per_usu_c" id="per_usu_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>USUARIO</td>
                  <td>CREAR USUARIO </td>
                  <td>
                        <select class="form-control" name="per_usu_i" id="per_usu_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>USUARIO</td>
                  <td>EDITAR USUARIO </td>
                  <td>
                        <select class="form-control" name="per_usu_m" id="per_usu_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>USUARIO</td>
                  <td>ELIMINAR USUARIO </td>
                  <td>
                        <select class="form-control" name="per_usu_e" id="per_usu_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL USUARIO-->
                <tr> <!--INICIO PACIENTE-->
                  <td>PACIENTES</td>
                  <td>MOSTRAR PACIENTES</td>
                  <td>
                        <select class="form-control" name="pac_c" id="pac_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>PACIENTES</td>
                  <td>CREAR PACIENTES </td>
                  <td>
                        <select class="form-control" name="pac_i" id="pac_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>PACIENTES</td>
                  <td>EDITAR PACIENTES </td>
                  <td>
                        <select class="form-control" name="pac_m" id="pac_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>PACIENTES</td>
                  <td>ELIMINAR PACIENTES </td>
                  <td>
                        <select class="form-control" name="pac_e" id="pac_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL PACIENTE-->
                <tr> <!--INICIO EXPEDIENTE DOCTORA-->
                  <td>EXPEDIENTE DOCTORA</td>
                  <td>MOSTRAR EXPEDIENTE DOCTORA</td>
                  <td>
                        <select class="form-control" name="exp_doc_c" id="exp_doc_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE DOCTORA</td>
                  <td>CREAR EXPEDIENTE DOCTORA </td>
                  <td>
                        <select class="form-control" name="exp_doc_i" id="exp_doc_i"required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE DOCTORA</td>
                  <td>ELIMINAR EXPEDIENTE DOCTORA </td>
                  <td>
                        <select class="form-control" name="exp_doc_e" id="exp_doc_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL EXPEDIENTE DOCTORA-->
                <tr> <!--INICIO EXPEDIENTE NUTRICIONISTA-->
                  <td>EXPEDIENTE NUTRICIONISTA</td>
                  <td>MOSTRAR EXPEDIENTE NUTRICIONISTA</td>
                  <td>
                        <select class="form-control" name="exp_nutri_c" id="exp_nutri_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE NUTRICIONISTA</td>
                  <td>CREAR EXPEDIENTE NUTRICIONISTA </td>
                  <td>
                        <select class="form-control" name="exp_nutri_i" id="exp_nutri_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE NUTRICIONISTA</td>
                  <td>ELIMINAR EXPEDIENTE NUTRICIONISTA </td>
                  <td>
                        <select class="form-control" name="exp_nutri_e" id="exp_nutri_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL EXPEDIENTE NUTRICIONISTA-->
                <tr> <!--INICIO CITAS-->
                  <td>CITAS</td>
                  <td>MOSTRAR CITAS</td>
                  <td>
                        <select class="form-control" name="citas_c" id="citas_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>CITAS</td>
                  <td>CREAR CITAS</td>
                  <td>
                        <select class="form-control" name="citas_i" id="citas_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>CITAS</td>
                  <td>EDITAR CITAS</td>
                  <td>
                        <select class="form-control" name="citas_m" id="citas_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>CITAS</td>
                  <td>ELIMINAR CITAS </td>
                  <td>
                        <select class="form-control" name="citas_e" id="citas_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL CITAS-->
                <tr> <!--INICIO PARAMETROS-->
                  <td>PARAMETROS</td>
                  <td>MOSTRAR PARAMETROS</td>
                  <td>
                        <select class="form-control" name="parametros_c" id="parametros_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>PARAMETROS</td>
                  <td>EDITAR PARAMETROS</td>
                  <td>
                        <select class="form-control" name="parametros_m" id="parametros_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr><!--FINAL PARAMETROS-->
                <tr> <!--INICIO ROLES-->
                  <td>ROLES</td>
                  <td>MOSTRAR ROLES</td>
                  <td>
                        <select class="form-control" name="roles_c" id="roles_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>ROLES</td>
                  <td>CREAR ROLES </td>
                  <td>
                        <select class="form-control" name="roles_i" id="roles_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>ROLES</td>
                  <td>EDITAR ROLES </td>
                  <td>
                        <select class="form-control" name="roles_m" id="roles_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>ROLES</td>
                  <td>ELIMINAR ROLES </td>
                  <td>
                        <select class="form-control" name="roles_e" id="roles_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL ROLES-->
                <tr> <!--INICIO BITACORA-->
                <td>BITACORA</td>
                  <td>MOSTRAR BITACORA</td>
                  <td>
                        <select class="form-control" name="bit_c" id="bit_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr><!--FINAL bitacora-->
                <tr> <!--INICIO BACKUP-->
                <td>BACKUP/RESTORE</td>
                  <td>MOSTRAR BACKUP/RESTORE</td>
                  <td>
                        <select class="form-control" name="back_c" id="back_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr><!--FINAL BACKUP-->
                <tr> <!--INICIO PERMISOS-->
                  <td>PERMISOS</td>
                  <td>MOSTRAR PERMISOS</td>
                  <td>
                        <select class="form-control" name="perm_c" id="perm_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>PERMISOS</td>
                  <td>CREAR PERMISOS</td>
                  <td>
                        <select class="form-control" name="perm_i" id="perm_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>PERMISOS</td>
                  <td>EDITAR PERMISOS</td>
                  <td>
                        <select class="form-control" name="perm_m" id="perm_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </select>
                  </td>
                </tr><!--FINAL PERMISOS-->
                </tbody>
                <tfoot>
                <tr>
                 
                  <th>MODULO</th>
                  <th>ACCION</th>
                  <th>¿ACCESO?</th>
                
                </tr>
                </tfoot>
              </table>
                <div class="box-footer">
            <div class="col text-center">
            <button type="submit"  class="btn btn-lg btn btn-primary">  <i class="fa fa-check-circle-o" aria-hidden="true"></i> CREAR</button>
            <a href="../vistas/editar_permisos.php"  class="btn btn-lg  btn bg-red" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> CANCELAR</a>
            </div>
            </div>
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
<!-- librerias para el uso del  pdf-->
<script type="text/javascript" src="../vistas/reportes/JSZip-2.5.0/jszip.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/pdfmake.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/vfs_fonts.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.flash.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.html5.min.js"></script>
</body>
</html>
<?php require "../modelos/insertar_permisos.php" ?>