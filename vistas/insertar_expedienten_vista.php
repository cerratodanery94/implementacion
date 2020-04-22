<?php
session_start();
require_once '../modelos/conectar.php';
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>20,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA AÑADIR EXPEDIENTE NUTRICIONISTA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 20;
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
  <title>Buscar Expediente</title>
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
       CREAR EXPEDIENTE MÉDICO
        
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

<div class="panel-body" id="formularioregistros">

  <form action="../vistas/insertar_expedienten_vista.php" method="get" >
  <div id="alerta"></div>
  <label for="exampleInputEmail1">BUSCAR PACIENTE</label> <br>
        <input type="text" size="33" maxlength="30"  placeholder="INGRESE UN NUMERO DE IDENTIDAD" name="buscar">
        <button type="submit" class="btn btn-primary" >BUSCAR</button>
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
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="EDAD"  name="edad" id="edad" value="<?php echo $registro['PER_FECHA_NACIMIENTO']?>" readonly   >
          </div>


          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">NUMERO DE IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="identidad" id="identidad" value="<?php echo $registro['PER_NUMERO_IDENTIDAD']?>" readonly    >
          </div>
           
          </form> 
          
          <form action="" method="post" name="form_exp">
           <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id" id="id" value="<?php echo $registro['PER_CODIGO']?>"   >
        
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">PESO</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="PESO"  name="peso" id="peso">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">ESTATURA</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="ESTATURA"  name="estatura" id="estatura">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">PRESION ARTERIAL</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="PRESION ARTERIAL"  name="presion" id="presion_arterial">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">TEMPERATURA</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="TEMPERATURA"  name="temperatura" id="temperatura">
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">ANTECEDENTES CLINICOS</label>

                  <textarea class="form-control" name="antecedentes" id="antecedentes" rows="10" cols="50"  > </textarea >
                </div>


                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">DIETA</label>

                  <textarea class="form-control" name="dieta" id="dieta" rows="10" cols="50"  > </textarea >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA DE CREACION</label>
                  <input type="text" autocomplete="off" class="form-control nombres" placeholder="FECHA DE CREACION" name="fecha_de_creacion" id="fecha_de_creacion" value="<?php echo date("m/d/Y"); ?> " readonly>
                </div>
                <div class="box-footer">
              <div class="col text-center">
                <button type="button"  class="btn btn-primary btn-flat margin" onclick="validar_expediente();" >CREAR</button>
                <!-- <button type="button"  class="btn btn-primary" onclick="validar_matenimiento();">CREAR</button> -->
                <a href="../vistas/mostrar_expedienten_vista.php" class="btn bg-red btn-flat margin" >CANCELAR</a>
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
<?php require "../modelos/insertar_expedienten_modelo.php" ?>




