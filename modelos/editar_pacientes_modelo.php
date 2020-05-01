<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require_once '../modelos/conectar.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>19,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA EDITAR PACIENTES',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 19;
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

$PACIENTES=$DATOS['PERM_PACIENTES'];
$NUTRI=$DATOS['PERM_EXP_NUTRI'];
$MEDICO=$DATOS['PERM_EXP_MEDICO'];
$CITAS=$DATOS['PERM_CITAS'];
$SEGURIDAD=$DATOS['PERM_SEGURIDAD'];
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM TBL_PERSONAS WHERE PER_CODIGO= :id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
       $fila=$resultado->fetch();
       $id_u=$fila['PER_CODIGO'];
       $identidad=$fila['PER_NUMERO_IDENTIDAD'];
       $pasaporte=$fila['PER_PASAPORTE'];
       $nombres=$fila['PER_NOMBRES'];
       $apellidos=$fila['PER_APELLIDOS'];
       $fecha_nacimiento=$fila['PER_FECHA_NACIMIENTO'];
       $fecha_creacion=$fila['PER_FECHA_CREACION'];
       $genero=$fila['PER_GENERO'];
       $tel_fijo=$fila['PER_TEL_FIJO'];
       $celular=$fila['PER_CELULAR'];
       $cargo=$fila['PER_PROFESION'];
       $direccion=$fila['PER_DIRECCION'];
       $correo=$fila['PER_CORREO'];
       $nacionalidad=$fila['PER_NACIONALIDAD'];
       $rtn=$fila['PER_RTN'];
     
   }
  }
  
  
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}

?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Editar Paciente</title>
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
      ACTUALIZAR INFORMACIÓN DEL PACIENTE
        
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
        <form action=""  method="POST" name="form_editar_paciente">
        <div id="alerta1"></div>
        <div class="form-group">
                 
                 <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control"   name="ide" id="ide" value="<?php echo $id_u?>">
              </div>

              <div class="form-group col-lg-6 col-md-6 col-xs-12">

                 <label for="exampleInputEmail1">NOMBRES</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="NOMBRES"  name="nombres" id="nombres"value="<?php echo $nombres?>"   >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">APELLIDOS</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="APELLIDOS"  name="apellidos" id="apellidos" value="<?php echo $apellidos?>"  >
                </div>

                

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="IDENTIDAD"  name="numero_de_identidad" id="numero_de_identidad" value="<?php echo $identidad?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">RTN</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="RTN" name="rtn" id="rtn" value="<?php echo $rtn?>"    >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">NACIONALIDAD</label>
                <select class="form-control" name="nacionalidad" id="nacionalidad">
        <option value="0">SELECCIONE UNA NACIONALIDAD:</option>
                <?php
               
        require '../modelos/conectar.php';
        $resultado_nacionalidad = $conexion -> query ("select * from tbl_personas tu inner join tbl_paises tp on tu.PAIS_CODIGO = tp.PAIS_CODIGO where tu.PER_CODIGO = $id");
        $pais = $resultado_nacionalidad->fetch(PDO::FETCH_ASSOC);
         $nacionalidad = $pais['PAIS_NOMBRE'];
          $resultado = $conexion -> query ("SELECT * FROM tbl_paises");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            $r = ($nacionalidad == $registro["PAIS_NOMBRE"]) ? 'selected' : '';
            echo '<option value="'.$registro["PAIS_CODIGO"].'"'.$r.'>'.$registro["PAIS_NOMBRE"].'</option>';
          }
 
        ?>
        </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">PROFESION/OCUPACION</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control"placeholder="PROFESION" name="profesion" id="profesion" value="<?php echo $cargo?>"    >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">PASAPORTE</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="PASAPORTE"  name="pasaporte" id="pasaporte" value="<?php echo $pasaporte?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1"> CELULAR</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="NUMERO DE CELULAR" name="numero_de_celular" id="numero_de_celular" value="<?php echo $celular?>"  >
                </div>
     
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1"> TELEFONO FIJO</label>
                  <input type="text" autocomplete="off" class="form-control"placeholder="TELEFONO FIJO" name="numero_de_telefono_fijo" id="numero_de_telefono_fijo" value="<?php echo $tel_fijo?>"  >
                </div>
                  
                
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">FECHA DE NACIMIENTO</label>
                  <input type="date" autocomplete="off" class="form-control" placeholder="FECHA DE NACIMIENTO" name="fecha_de_nacimiento" id="fecha_de_nacimiento"value="<?php echo $fecha_nacimiento?>"  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">FECHA DE CREACION</label>
                  <input type="date" autocomplete="off" class="form-control" placeholder="FECHA DE CREACION" name="fecha_creacion" id="fecha_creacion" value="<?php echo $fecha_creacion?>"readonly  >
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">CORREO</label>
                  <input type="email" autocomplete="off" class="form-control " placeholder="CORREO" name="correo" id="correo" value="<?php echo $correo?>"   >
                </div>
                 
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                <label for="exampleInputPassword1">GENERO</label>
                <select class="form-control" name="genero" id="genero">
                 <option value="0">SELECCIONE UN GENERO:</option>
                 <option value="FEMENINO"
                 <?php
                 if ($genero=='FEMENINO') {
                    echo 'selected';
                 }
                 ?>
                 >FEMENINO</option>
                 <option value="MASCULINO"
                 <?php
                 if ($genero=='MASCULINO') {
                    echo 'selected';
                 }
                 ?>
                 >MASCULINO</option>
                 
                </select>
                </div>
   
                <div class="form-group col-lg-6 col-md-6 col-xs-12">

                  <label for="exampleInputPassword1">Direccion</label>
                  <textarea placeholder="DIRECCIÓN" style="text-transform:uppercase"  class="form-control"  name="direccion" id="direccion" cols="30" rows="5" ><?php echo $direccion?></textarea >
                </div>
                
                <div class="box-footer"> 

                <div class="col text-center">
                <button type="button" onclick="validar_editar_paciente();"   class="btn btn-primary btn-flat margin">EDITAR</button>
                <a href="../vistas/mostrar_pacientes_vista.php" class="btn bg-red btn-flat margin" >CANCELAR</a>
                </div>
              </div>
            </form>
            
        </div>
        <!-- /.box-body --> 
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    <!-- /.content -->
    </div>
    </div>
  </div>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2020 <a>System 32</a>.</strong> All rights
    reserved.
  </footer>

>

 
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
<!-- SlimScroll -->
<script src="../vistas/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../vistas/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../vistas/dist/js/app.min.js"></script>
<script src="../vistas/Js/Validar_sistema.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../vistas/dist/js/demo.js"></script>
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<script src="../vistas/plugins/jQuery/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
    $("#edad").mask("00");
    $("#numero_de_identidad").mask("0000-0000-00000");
    $("#numero_de_celular").mask("0000-0000");
    $("#numero_de_telefono_fijo").mask("0000-0000");
    $("#rtn").mask("00000000000000")
    
});
</script>
</body>
</html>
<?php require "../modelos/actualizar_pacientes_modelo.php" ?>
