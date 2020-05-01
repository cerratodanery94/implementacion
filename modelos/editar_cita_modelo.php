<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require_once '../modelos/conectar.php';
  require_once '../controladores/funciones.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha)";
  $resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>29,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA EDITAR CITA',":fecha"=>date("Y-m-d H:i:s")));
  if(isset($_GET['id'])){
    $id=$_GET['id'];

    
    $sql=" SELECT * from tbl_citas c INNER JOIN tbl_personas p on c.per_codigo = p.per_codigo INNER JOIN tbl_usuario u  ON c.usu_codigo=u.usu_codigo INNER JOIN tbl_horario h ON c.hor_codigo=h.hor_codigo WHERE CIT_CODIGO=:id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
    $fila=$resultado->fetch();
    $id_c=$fila['CIT_CODIGO']; 
    $id_p=$fila['PER_CODIGO']; 
    $id_u=$fila['USU_CODIGO'];
    $nombres=$fila['PER_NOMBRES'];
    $apellidos=$fila['PER_APELLIDOS'];
    $fecha_nacimiento=$fila['PER_FECHA_NACIMIENTO'];
    $edad=mi_edad($fila['PER_FECHA_NACIMIENTO']);
    $identidad=$fila['PER_NUMERO_IDENTIDAD'];
   $fecha_cita=$fila['CIT_FECHA_CITA'];
    $estado=$fila['CIT_ESTADO']; 
    $descrip=$fila['CIT_DESCRIPCION'];  
    $id_h=$fila['HOR_CODIGO'];
   }
  }
  
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}
$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 29;
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

  
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Editar cita</title>
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
        EDITAR CITAS
        
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
<!--box-header-->
<div id="alerta"></div>
<!--centro-->
         <input type="hidden" name="id" id="id" value="<?php echo $id_p?>">

          <div class="form-group col-lg-6 col-md-6 col-xs-12">
             <br>
             <label for="exampleInputEmail1">NOMBRES</label>
             <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="nombres" id="nombres" value="<?php echo $nombres?>"  readonly   >
          </div>
           
         <div class="form-group col-lg-6 col-md-6 col-xs-12">
         <br>
           <label for="exampleInputEmail1">APELLIDOS</label>
           <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="APELLIDOS"  name="apellidos" id="apellidos" value="<?php echo $apellidos?>" readonly   >
         </div>

         <div class="form-group col-lg-6 col-md-6 col-xs-12">
           <label for="exampleInputPassword1">FECHA NACIMIENTO</label>
           <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="FECHA NACIMIENTO"  name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento?>" readonly   >
         </div>
         <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">EDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="EDAD"  name="edad" id="edad"value="<?php echo $edad?>"readonly>
                </div>


        <div class="form-group col-lg-6 col-md-6 col-xs-12">
          <label for="exampleInputPassword1">NUMERO DE IDENTIDAD</label>
          <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="identidad" id="identidad" value="<?php echo $identidad?>" readonly    >
        </div> 
        

          <form action="" method="post" name="form_editar_cita"> 
          <input type="hidden" name="id_c" id="id_c" value="<?php echo $id_c?>">   
          <input type="hidden" name="id_u" id="id_u" value="<?php echo $id_u?>">
          <input type="hidden" name="id_p" id="id_p" value="<?php echo $id_p?>" >
          <input type="hidden" name="id_h" id="id_h" value="<?php echo $id_h?>" >
        
          <div class="form-group col-lg-6 col-md-6 col-xs-12"> 
            <label for="exampleInputPassword1">FECHA DE LA CITA</label>
            <input type="date" autocomplete="off" class="form-control nombres" name="fecha_cita" id="fecha_cita" value="<?php echo $fecha_cita?>">
          </div>

          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">DOCTORA</label>
            <select class="form-control" name="id_u" id="doctora">
             <option value="0">SELECCIONE DOCTORA:</option>
             <?php
               
               require '../modelos/conectar.php';
               $resultado_nacionalidad = $conexion -> query ("select * from tbl_citas tc inner join tbl_usuario tu  on tc.USU_CODIGO = tu.USU_CODIGO where tc.CIT_CODIGO = $id");
               $pais = $resultado_nacionalidad->fetch(PDO::FETCH_ASSOC);
               $pais2 = $resultado_nacionalidad->fetch(PDO::FETCH_ASSOC);
                $nacionalidad = $pais["USU_NOMBRES"];
                $nacionalidad2 = $pais["USU_APELLIDOS"];
                $doctora=$nacionalidad." ". $nacionalidad2 ;
                 $resultado = $conexion -> query ("SELECT * FROM tbl_usuario where ROL_CODIGO=3 or ROL_CODIGO=4");
                 while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                   $r = ($doctora == $registro["USU_NOMBRES"]." ".$registro["USU_APELLIDOS"]) ? 'selected' : '';
                   echo '<option value="'.$registro["USU_CODIGO"].'"'.$r.'>'.$registro["USU_NOMBRES"]." ".$registro["USU_APELLIDOS"].'</option>';
                 }
        
               ?>
             
            </select>
          </div>
            
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">HORA CITA</label>
                <select class="form-control" name="hora" id="hora_cita">
        <option value="0">SELECCIONE HORA CITA :</option>
                <?php
               
        require '../modelos/conectar.php';
        $resultado_nacionalidad = $conexion -> query ("select * from tbl_citas tc inner join tbl_horario th on tc.HOR_CODIGO = th.HOR_CODIGO where tc.CIT_CODIGO = $id");
        $pais = $resultado_nacionalidad->fetch(PDO::FETCH_ASSOC);
         $nacionalidad = $pais['HOR_HORA'];
          $resultado = $conexion -> query ("SELECT * FROM tbl_horario");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            $r = ($nacionalidad == $registro["HOR_HORA"]) ? 'selected' : '';
            echo '<option value="'.$registro["HOR_CODIGO"].'"'.$r.'>'.$registro["HOR_HORA"].'</option>';
          }
 
        ?>
        </select>
                </div>


          <div class="form-group  col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">ESTADO</label>
            <select class="form-control" name="estado" id="estado">
             <option value="0">SELECCIONE EL ESTADO DE LA CITA:</option>
             <option value="PENDIENTE"<?php if ($estado=='PENDIENTE') { echo 'selected';}?>>PENDIENTE</option>
             <option value="REALIZADA"<?php if ($estado=='REALIZADA') { echo 'selected';}?>>REALIZADA</option>
             <option value="CANCELADA"<?php if ($estado=='CANCELADA') { echo 'selected';}?>>CANCELADA</option>
             <option value="NO SE PRESENTO"<?php if ($estado=='NO SE PRESENTO') { echo 'selected';}?>>NO SE PRESENTO</option>
            </select>
          </div>

          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">DESCRICIÓN</label>
            <input type="text" style="text-transform:uppercase" autocomplete="off" class="form-control" name="descrip" id="descrip" value="<?php echo $descrip?>">
          </div>
         
          <div class="box-footer">
          <div class="col text-center">
            <button type="button" onclick="validar_cita2();"  class="btn btn-primary btn-flat margin">ACTUALIZAR</button>
            <a href="../vistas/mostrar_citas_vista.php" class="btn bg-red btn-flat margin" >ATRAS</a>
          </div>
          </div>
          </form>
          </div>      
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
<?php require "../modelos/actualizar_cita_modelo.php"?>
