<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Recuperar contraseña</title>
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

  <script src="../vistas/Js/jquery-3.4.1.min.js"></script>
</head>
<body class="hold-transition register-page">

<div class="register-box">
  <div class="register-logo">
    <b>Recuperación de Contraseña</b>
  </div>
  <div class="register-box-body">
    <p>Ingresa su nombre usuario para la recuperacion de contraseña por preguntas de seguridad</p>
    <form action="../modelos/recuperar_preguntas_modelo.php" method="POST" name="Form_recuperar">
    <div class="form-group has-feedback">
        <input id="usuario2" autocomplete="off" type="text" class="form-control nombres" style="text-transform:uppercase" placeholder="USUARIO" name="usuario2">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
      <div id ="alerta3"></div>
      <div class="register-box-footer">
        <a href="../vistas/recuperar_correo_vista.php" class="btn btn-default">Probar otro método</a>
        <button type="button" class="btn btn-primary pull-right" onclick="Validar_recuperar()">Verificar</button>
    </div>
      </div>
      <!-- /.box-body -->
    </form>
   
  </div>
  <!-- /.form-box -->
  
</div><!-- /.register-box -->


<!-- jQuery 2.2.3 -->
<script src="../vistas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../vistas/Js/Validaciones.js"></script>

<script src="../vistas/plugins/iCheck/icheck.min.js"></script>
</body>
</html>