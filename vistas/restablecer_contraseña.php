<?php
session_start();
//error_reporting(0);
if (!isset($_SESSION['token'])||!isset($_SESSION['id_usu'])||!isset($_SESSION['fec_venc'])) {
  header('location:../vistas/login_vista.php');
   die();
}
require_once "../modelos/conectar.php"; 
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_usu"],":objeto"=>7,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE RESTABLECER CONTRASEÑA POR CORREO',":fecha"=>date("Y-m-d"),":hora"=>date("H:m:s")));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reestablecer contraseña</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="../vistas/plugins/iCheck/square/blue.css">
 <!-- Validacion del ojo -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">
  <script src="../vistas/Js/jquery-3.4.1.min.js"></script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Restablecer </b>Contraseña 
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">INGRESE LOS SIGUIENTES DATOS</p>

    <form action=" " method="POST" name="Form_reestablecer">
    <div class="form-group has-feedback">
       <div class="input-group">
        <input id="nueva_contra" autocomplete="off" type="password" class="form-control nombres" placeholder="NUEVA CONTRASEÑA" name="nueva_contra">
        <div class="input-group-append">
        <div class="input-group">
        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword_recuperarcontra()"><span class="fa fa-eye-slash icon3"></span></button>
        </div>
        </div>
      </div>
      </div>
     
      <div class="form-group has-feedback">
       <div class="input-group">
        <input id="confirmar_contra2" autocomplete="off" type="password" class="form-control nombres" placeholder="CONFIRMAR CONTRASEÑA" name="confirmar_contra2">
        <div class="input-group-append">
        <div class="input-group">
        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword_recuperarcontra2()"><span class="fa fa-eye-slash icon4"></span></button>
  
        </div>
        </div>
      </div>
      </div> 
      <div id="alerta4"></div>
      <div class="row">
        <div class="col-xs-10">
        <div style='float:center;margin:auto;width:77px;'><button type="button" class="btn btn-primary btn-recuperar" onclick="Validar_reestablecer();">REESTABLECER CONTRASEÑA</button>
    </div>
           <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="../vistas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../vistas/Js/Validaciones.js"></script>
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<script src="../vistas/plugins/iCheck/icheck.min.js"></script>
</body>
</html>
<?php require"../modelos/restablecer_modelo.php" ?>