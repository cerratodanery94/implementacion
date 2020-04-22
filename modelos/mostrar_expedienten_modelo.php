<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
try {
  require '../modelos/conectar.php';
  require '../controladores/funciones.php';
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>22,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA MOSTRAR EXPEDIENTE NUTRICIONISTA DE UN PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));         
  $sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
  VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
  $resultado2=$conexion->prepare($sql2);	
  $resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>22,":accion"=>'CONSULTA',":descr"=>'MUESTRA LA INFORMACION DEL EXPEDIENTE NUTRICIONISTA DE UN PACIENTE',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));
  if(isset($_GET['id'])){
    $id=$_GET['id'];

    
    $sql="SELECT * from tbl_expediente_nutricionista a INNER JOIN tbl_personas b on a.per_codigo = b.per_codigo where NUTRI_CODIGO= :id";
  $resultado=$conexion->prepare($sql);	
    $resultado->execute(array(":id"=>$id));
   if ($resultado->rowCount()>=1) {
   $fila=$resultado->fetch();
    $id_p=$fila['PER_CODIGO']; 
    $id_u=$fila['NUTRI_CODIGO'];
    $nombres=$fila['PER_NOMBRES'];
    $apellidos=$fila['PER_APELLIDOS'];
    
    $identidad=$fila['PER_NUMERO_IDENTIDAD'];
		$peso=$fila['NUTRI_PESO'];
		$estatura=$fila['NUTRI_ALTURA'];
		$presion=$fila['NUTRI_PRESION_ARTERIAL'];
		$temperatura=$fila['NUTRI_TEMPERATURA'];
		$antecedentes=$fila['NUTRI_ANTECEDENTES_CLINICOS'];
    $dieta=$fila['NUTRI_DIETA'];
    $fecha=$fila['NUTRI_FECHA_CREACION'];
    $fecha_nacimiento=$fila['PER_FECHA_NACIMIENTO'];
    $edad=mi_edad($fila['PER_FECHA_NACIMIENTO']);
  
  
		 
     
   }
  }
  
} catch (Exception $e) {
    die('Error: ' . $e->GetMessage());
	echo "Codigo del error" . $e->getCode();
}
$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 22;
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
  <title>Mostrar Expediente</title>
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
       MOSTRAR EXPEDIENTE DEL PACIENTE
        
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

<input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id" id="id" value="<?php echo $id_p?>" readonly  >
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
                  <label for="exampleInputPassword1">FECHA DE NACIMIENTO</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="FECHA DE NACIMIENTO"  name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento?>" readonly   >
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">EDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="EDAD"  name="edad" id="edad"value="<?php echo $edad?>"readonly>
                </div>

          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">NUMERO DE IDENTIDAD</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="IDENTIDAD"  name="identidad" id="identidad" value="<?php echo $identidad?>" readonly    >
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">FECHA DE CREACION</label>
                  <input type="text" autocomplete="off" class="form-control nombres" placeholder="FECHA DE CREACION" name="fecha_de_creacion" id="fecha_de_creacion" value="<?php echo $fecha ?> " readonly>
                </div>
          </form> 

          <form action="" method="post" name="frm_exp"> 
          
               
           <input type="hidden" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="NOMBRES"  name="id" id="id" value="<?php echo $id_u?> "   >
        
                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">PESO</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="PESO"  name="peso" id="peso" value="<?php echo $peso?>" readonly>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">ESTATURA</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="ESTATURA"  name="estatura" id="estatura"  value="<?php echo $estatura?>" readonly>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">PRESION ARTERIAL</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="PRESION ARTERIAL"  name="presion" id="presion_arterial"  value="<?php echo $presion?>" readonly>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">TEMPERATURA</label>
                  <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder="TEMPERATURA"  name="temperatura" id="temperatura"  value="<?php echo $temperatura?>" readonly>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">ANTECEDENTES CLINICOS</label>

                  <textarea class="form-control" name="antecedentes" id="antecedentes" rows="10" cols="50" readonly ><?php echo $antecedentes?> </textarea >
                </div>


                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                  <label for="exampleInputPassword1">DIETA</label>

                  <textarea class="form-control" name="dieta" id="dieta" rows="10" cols="50" readonly > <?php echo $dieta?> </textarea >
                </div>

               
         
                <div class="box-footer">
              <div class="col text-center">
                <a href="../vistas/mostrar_expedienten_vista.php" class="btn bg-red btn-flat margin" >ATRAS</a>
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
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2020 <a>System 32</a>.</strong> All rights
    reserved.
  </footer>


  



 

<script src="../vistas/js/validaciones.js"></script>
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
