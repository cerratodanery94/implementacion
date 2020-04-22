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


$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 27;
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
      <h1>
      CREAR CITA
        
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
           <div>
<div id="alerta"></div>
<div class="panel-body" id="formularioregistros">
  <form action="../vistas/insertar_cita_vista.php" method="get" >
  <label for="exampleInputEmail1">INGRESE UN NUMERO DE IDENTIDAD</label> <br>
        <input type="text" autocomplete="off" size="33" maxlength="15"  placeholder="BUSCAR PACIENTE" name="buscar">
        <button type="submit" class="btn btn-primary btn-sm fa fa-search" ></button>
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
            
           <div class="form-group col-lg-6 col-md-6 col-xs-12">
             <br>
             <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="NOMBRES"  name="id_p" id="id_p" value="<?php echo $registro['PER_CODIGO']?>"   >
                  <label for="exampleInputEmail1">NOMBRES</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="nombres" id="nombres" value="<?php echo $registro['PER_NOMBRES']?>" readonly   >
         </div>
           
         
         <div class="form-group col-lg-6 col-md-6 col-xs-12">
         <br>
                  <label for="exampleInputEmail1">APELLIDOS</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="APELLIDOS"  name="apellidos" id="apellidos" value="<?php echo $registro['PER_APELLIDOS']?>" readonly   >
         </div>

         <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA DE NACIMIENTO</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="FECHA DE NACIMIENTO"  name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $registro['PER_FECHA_NACIMIENTO']?>" readonly   >
          </div>


          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">NUMERO DE IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="identidad" id="identidad" value="<?php echo $registro['PER_NUMERO_IDENTIDAD']?>" readonly    >
          </div>
           
          </form> 

          <form action="" method="post" name="form_cita" enctype="multipart/form-data" >
            <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="NOMBRES"  name="id_p" id="id_p" value="<?php echo $registro['PER_CODIGO']?>"   >
            
            <div class="form-group col-lg-6 col-md-6 col-xs-12"> 
            <label for="exampleInputPassword1">FECHA DE LA CITA</label>
            <input type="date" autocomplete="off" class="form-control nombres" name="fecha_cita" id="fecha_cita">
            </div>
            


            <div class="form-group col-lg-6 col-md-6 col-xs-12">
             <label for="exampleInputPassword1">DOCTORA</label>
             <select class="form-control" name="id_u" id="doctora">
             <option value="0">SELECCIONE DOCTORA:</option>
                <?php
               require '../modelos/conectar.php';
               $resultado = $conexion -> query ("SELECT * FROM TBL_USUARIO where ROL_CODIGO=3 or ROL_CODIGO=4");
              while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$registro["USU_CODIGO"].'">'.$registro["USU_NOMBRES"]." ".$registro["USU_APELLIDOS"].'</option>';
               }
               ?>
              </select>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-xs-12">
             <label for="exampleInputPassword1">HORA CITA</label>
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
            <div class="form-group col-lg-6 col-md-6 col-xs-12"> 
            <label for="exampleInputPassword1">ESTADO</label>
            <input type="text" autocomplete="off" class="form-control nombres" value="PENDIENTE" name="estado" id="estado" readonly>
            </div>
            
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label style="visibility:hidden"for="exampleInputPassword1">DESCRICIÓN</label>
                  <textarea style="visibility:hidden"placeholder="DESCRICIÓN" style="text-transform:uppercase"  class="form-control"  name="descrip" id="descrip" cols="30" rows="5" ></textarea >
                </div>

            <div class="box-footer">
            <div class="col text-center">
            <button type="button" onclick="validar_cita();"  class="btn btn-primary btn-flat margin">CREAR</button>
            <a href="../vistas/mostrar_citas_vista.php" class="btn bg-red btn-flat margin" >CANCELAR</a>
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
</body>
</html>
<?php require "../modelos/insertar_cita_modelo.php" ?>




