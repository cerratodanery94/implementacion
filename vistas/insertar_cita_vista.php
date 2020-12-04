<?php
session_start();
require_once '../modelos/conectar.php';
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>27,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA AÑADIR CITA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Crear citas</title>
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
    <h1><i class="fa fa-search-plus" aria-hidden="true"></i>
      Buscar paciente
        <small>ClimeHome</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="mostrar_citasd_vista.php"><i class="fa fa-calendar"></i>Citas</a></li>
        <li class="active"><i class="fa fa-search-plus"></i> Buscar paciente</li>
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
<div id="alerta"></div>
<div class="panel-body" id="formularioregistros">
  <form action="../vistas/insertar_cita_vista.php" method="get" >


   <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Ingrese número de identidad</span>
                <input type="text" size="33" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder=""  name="buscar" id="buscar">
        <span class="	glyphicon glyphicon-credit-card form-control-feedback"></span>
                </div>
                </div>
                <button type="submit" class="btn btn btn btn-primary" ><i class="fa fa-search-plus" aria-hidden="true"></i></i> BUSCAR</button>
        </div>
       <?php
       if(!empty($_GET)){
        $buscar=$_GET['buscar']; 
       if($_GET['buscar'] == NULL ){

        echo'ESCRIBA UN NUMERO DE IDENTIDAD ';
    }

    else{ 
      
       $resultado = $conexion -> query ("SELECT * FROM tbl_personas where PER_NUMERO_IDENTIDAD like'%".$buscar."%' ");
       $resultado->execute();
      while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {?> 
                  <section class="content">
        <ol class="breadcrumb">
        <li><a href="#"><i class=""></i>Citas</a></li>
        <li class="active">Paciente</li>
        <li class="active">Agregar cita</li>
      </ol>
           
             <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="NOMBRES"  name="id_p" id="id_p" value="<?php echo $registro['PER_CODIGO']?>"   >
             <div class="form-group col-lg-6 col-md-6 col-xs-12">
        <div class="input-group">
                <span class="input-group-addon">Nombres</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="nombres" id="nombres" value="<?php echo $registro['PER_NOMBRES']?>" readonly   >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                </div>
           
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Apellidos</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="APELLIDOS"  name="apellidos" id="apellidos" value="<?php echo $registro['PER_APELLIDOS']?>" readonly   >
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                </div>


                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Identidad</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="identidad" id="identidad" value="<?php echo $registro['PER_NUMERO_IDENTIDAD']?>" readonly    >
                  <span class="	glyphicon glyphicon-credit-card form-control-feedback"></span>
                </div>
                </div>
           
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de nacimiento</span>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="FECHA DE NACIMIENTO"  name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $registro['PER_FECHA_NACIMIENTO']?>" readonly   >
                  <span class="	glyphicon glyphicon glyphicon-gift form-control-feedback"></span>
                </div>
                </div>

               
          </form> 

          <form action="" method="post" name="form_cita" enctype="multipart/form-data" >
            <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="NOMBRES"  name="id_p" id="id_p" value="<?php echo $registro['PER_CODIGO']?>"   >
            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Fecha de cita</span>
            <input type="date" autocomplete="off" class="form-control nombres" name="fecha_cita" id="fecha_cita">
            </div>
            </div>
            


            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Doctora/Doctor/Nutricionista</span>
             <select class="form-control" name="id_u" id="doctora">
             <option value="0">SELECCIONE DOCTORA/DOCTOR/NUTRICIONISTA:</option>
                <?php
               require '../modelos/conectar.php';
               $resultado = $conexion -> query ("SELECT * FROM TBL_USUARIO where ROL_CODIGO=3 or ROL_CODIGO=4");
              while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$registro["USU_CODIGO"].'">'.$registro["USU_NOMBRES"]." ".$registro["USU_APELLIDOS"].'</option>';
               }
               ?>
              </select>
            </div>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Hora de cita</span>
             <select class="form-control" name="id_h" id="hora_cita">
             <option value="0">SELECCIONE HORA CITA:</option>
             <?php
               require '../modelos/conectar.php';
               $resultado = $conexion -> query ("SELECT * FROM TBL_HORARIO");
              while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$registro["HOR_CODIGO"].'">'.$registro["HOR_HORA"].'</option>';
               }
               ?>
              </select>
            </div>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <div class="input-group">
                <span class="input-group-addon">Estado de cita</span>
            <input type="text" autocomplete="off" class="form-control nombres" value="PENDIENTE" name="estado" id="estado" readonly>
            <span class="		glyphicon glyphicon-info-sign form-control-feedback"></span>
                </div>
                </div>
            
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label style="visibility:hidden"for="exampleInputPassword1">DESCPRICIÓN</label>
                  <textarea style="visibility:hidden"placeholder="DESCRICIÓN" style="text-transform:uppercase"  class="form-control"  name="descrip" id="descrip" cols="30" rows="5" ></textarea >
                </div>
                </div>
                </div>

            <div class="box-footer">
            <div class="col text-center">
            <button type="button"  class="btn btn-lg btn btn-primary" onclick="validar_cita();"><i class="fa fa-check-circle-o" aria-hidden="true"></i> CREAR</button>
            <a href="../vistas/mostrar_citas_vista.php"  class="btn btn-lg  btn bg-red" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> CANCELAR</a>
            </div>
            </div>
            </form>
      </div>
        <?php } }  } ?>
       
            

        
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
<script src="../vistas/plugins/jQuery/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
    $("#buscar").mask("0000-0000-00000");     
});
</script>
</body>
</html>
<?php require "../modelos/insertar_cita_modelo.php" ?>




