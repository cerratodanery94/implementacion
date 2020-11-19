<?php
session_start();
require_once '../modelos/conectar.php';
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>23,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA AÑADIR EXPEDIENTE DOCTORA',":fecha"=>date("Y-m-d"),":hora"=>date("H:i:s")));

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
<div id="alerta"></div>

<div class="panel-body" id="formularioregistros">
  <form action="../vistas/editar_permisos.php" method="get" >
  <label for="exampleInputEmail1">BUSCAR ROL</label> <br>
        <input type="text" size="50" autocomplete="off" style="text-transform:uppercase"  placeholder="ESCRIBA EL ROL QUE QUIERE EDITAR LOS PERMISOS" name="buscar" id="buscar">
        <button type="submit" class="btn btn-primary" >BUSCAR</button>
        </div>
       <?php
       if(!empty($_GET)){
        $buscar=$_GET['buscar']; 
       if($_GET['buscar'] == NULL ){

        echo'El CAMPO ESTA VACIO O EL ROL NO EXISTE ';
    }

    else{ 
        //USUARIO
        $resultado = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar' AND tp.OBJ_CODIGO=11 ");
        $resultado->execute();
        $registro=$resultado->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_rol']=$registro['ROL_CODIGO'];
        $_SESSION['id_obju']=$registro['OBJ_CODIGO'];
        $_SESSION['id_peru']=$registro['PERM_CODIGO'];
        //PACIENTES
        $resultado1 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=18");
        $resultado1->execute();
        $registro1=$resultado1->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_opac']=$registro1['OBJ_CODIGO'];
        $_SESSION['id_ppac']=$registro1['PERM_CODIGO'];
        //EXP DOCTORA
        $resultado2 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=24");
        $resultado2->execute();
        $registro2=$resultado2->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_oed']=$registro2['OBJ_CODIGO'];
        $_SESSION['id_ped']=$registro2['PERM_CODIGO'];
        //EXP NUTICIONISTA
        $resultado3 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=22");
        $resultado3->execute();
        $registro3=$resultado3->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_oen']=$registro3['OBJ_CODIGO'];
        $_SESSION['id_pen']=$registro3['PERM_CODIGO'];

         //CITAS
         $resultado4 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=28");
         $resultado4->execute();
         $registro4=$resultado4->fetch(PDO::FETCH_ASSOC);
         $_SESSION['id_ocit']=$registro4['OBJ_CODIGO'];
         $_SESSION['id_pcit']=$registro4['PERM_CODIGO'];

         //PARAMETROS
         $resultado5 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=30");
         $resultado5->execute();
         $registro5=$resultado5->fetch(PDO::FETCH_ASSOC);
         $_SESSION['id_oparam']=$registro5['OBJ_CODIGO'];
         $_SESSION['id_pparam']=$registro5['PERM_CODIGO'];

         //ROLES
        $resultado6 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=31");
        $resultado6->execute();
        $registro6=$resultado6->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_oroles']=$registro6['OBJ_CODIGO'];
        $_SESSION['id_proles']=$registro6['PERM_CODIGO'];

        //BITACORA
        $resultado7 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=33");
        $resultado7->execute();
        $registro7=$resultado7->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_obit']=$registro7['OBJ_CODIGO'];
        $_SESSION['id_pbit']=$registro7['PERM_CODIGO'];
         //BACKUP
         $resultado8 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=40");
         $resultado8->execute();
         $registro8=$resultado8->fetch(PDO::FETCH_ASSOC);
         $_SESSION['id_oback']=$registro8['OBJ_CODIGO'];
         $_SESSION['id_pback']=$registro8['PERM_CODIGO'];
         //Permisos
         $resultado9 = $conexion -> query ("SELECT * FROM tbl_permisos tp inner join tbl_rol tr on tp.rol_codigo=tr.rol_codigo where tr.ROL_NOMBRE ='$buscar'AND tp.OBJ_CODIGO=36");
         $resultado9->execute();
         $registro9=$resultado9->fetch(PDO::FETCH_ASSOC);
         $_SESSION['id_operm']=$registro9['OBJ_CODIGO'];
         $_SESSION['id_pperm']=$registro9['PERM_CODIGO'];
        
          ?> 
            
          </form> 

          <form action="" method="post"  enctype="multipart/form-data" >
           
          <input type="text"  class="form-control"  name="id_rol" id="id_rol" value="<?php echo $_SESSION['id_rol']?>" readonly>
          <input type="text"  class="form-control"  name="id_obju" id="id_obju" value="<?php echo $_SESSION['id_obju']?>" readonly>
          <input type="text"  class="form-control"  name="id_peru" id="id_peru" value="<?php echo $_SESSION['id_peru']?>" readonly>
          <input type="text"  class="form-control"  name="id_opac" id="id_opac" value="<?php echo $_SESSION['id_opac']?>" readonly>
          <input type="text"  class="form-control"  name="id_ppac" id="id_ppac" value="<?php echo $_SESSION['id_ppac']?>" readonly>
          <input type="text"  class="form-control"  name="id_oed" id="id_oed" value="<?php echo $_SESSION['id_oed']?>" readonly>
          <input type="text"  class="form-control"  name="id_ped" id="id_ped" value="<?php echo $_SESSION['id_ped']?>" readonly>
          <input type="text"  class="form-control"  name="id_oen" id="id_oen" value="<?php echo $_SESSION['id_oen']?>" readonly>
          <input type="text"  class="form-control"  name="id_pen" id="id_pen" value="<?php echo $_SESSION['id_pen']?>" readonly>
          <input type="text"  class="form-control"  name="id_ocit" id="id_ocit" value="<?php echo $_SESSION['id_ocit']?>" readonly>
          <input type="text"  class="form-control"  name="id_pcit" id="id_pcit" value="<?php echo $_SESSION['id_pcit']?>" readonly>
          <input type="text"  class="form-control"  name="id_oparam" id="id_oparam" value="<?php echo $_SESSION['id_oparam']?>" readonly>
          <input type="text"  class="form-control"  name="id_pparam" id="id_pparam" value="<?php echo $_SESSION['id_pparam']?>" readonly>
          <input type="text"  class="form-control"  name="id_oroles" id="id_oroles" value="<?php echo $_SESSION['id_oroles']?>" readonly>
          <input type="text"  class="form-control"  name="id_proles" id="id_proles" value="<?php echo $_SESSION['id_proles']?>" readonly>
          <input type="text"  class="form-control"  name="id_obit" id="id_obit" value="<?php echo $_SESSION['id_obit']?>" readonly>
          <input type="text"  class="form-control"  name="id_pbit" id="id_pbit" value="<?php echo $_SESSION['id_pbit']?>" readonly>
          <input type="text"  class="form-control"  name="id_oback" id="id_oback" value="<?php echo $_SESSION['id_oback']?>" readonly>
          <input type="text"  class="form-control"  name="id_pback" id="id_pback" value="<?php echo $_SESSION['id_pback']?>" readonly>
          <input type="text"  class="form-control"  name="id_operm" id="id_operm" value="<?php echo $_SESSION['id_operm']?>" readonly>
          <input type="text"  class="form-control"  name="id_pperm" id="id_pperm" value="<?php echo $_SESSION['id_pperm']?>" readonly>
          <?php 
          /*OBTENER PERMISO DE USUARIOS*/
           $sql = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
           $resultado=$conexion->prepare($sql);	
           $resultado->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_obju']));
           $datos = $resultado->fetch(PDO::FETCH_ASSOC);
            $cu= $datos['PERM_CONSULTAR'];
            $iu= $datos['PERM_INSERTAR'];
            $eu= $datos['PERM_ELIMINAR'];
            $mu= $datos['PERM_ACTUALIZAR'];
          /*OBTENER PERMISO DE PACIENTES*/
           $sql1 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
           $resultado1=$conexion->prepare($sql1);	
           $resultado1->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_opac']));
           $datos = $resultado1->fetch(PDO::FETCH_ASSOC);
            $cpac= $datos['PERM_CONSULTAR'];
            $ipac= $datos['PERM_INSERTAR'];
            $epac= $datos['PERM_ELIMINAR'];
            $mpac= $datos['PERM_ACTUALIZAR'];
            /*OBTENER PERMISO DE EXPEDIENTE DOCTORA*/
           $sql2 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
           $resultado2=$conexion->prepare($sql2);	
           $resultado2->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_oed']));
           $datos = $resultado2->fetch(PDO::FETCH_ASSOC);
            $ced= $datos['PERM_CONSULTAR'];
            $ied= $datos['PERM_INSERTAR'];
            $eed= $datos['PERM_ELIMINAR'];
             /*OBTENER PERMISO DE EXPEDIENTE NUTRICIONISTA*/
           $sql3 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
           $resultado3=$conexion->prepare($sql3);	
           $resultado3->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_oen']));
           $datos = $resultado3->fetch(PDO::FETCH_ASSOC);
            $cen= $datos['PERM_CONSULTAR'];
            $ien= $datos['PERM_INSERTAR'];
            $een= $datos['PERM_ELIMINAR'];
          /*OBTENER PERMISO DE CITAS*/
          $sql4 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
          $resultado4=$conexion->prepare($sql4);	
          $resultado4->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_ocit']));
          $datos = $resultado4->fetch(PDO::FETCH_ASSOC);
           $ccit= $datos['PERM_CONSULTAR'];
           $icit= $datos['PERM_INSERTAR'];
           $ecit= $datos['PERM_ELIMINAR'];
           $mcit= $datos['PERM_ACTUALIZAR'];
           /*OBTENER PERMISO DE PARAMETROS*/
          $sql5 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
          $resultado5=$conexion->prepare($sql5);	
          $resultado5->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_oparam']));
          $datos = $resultado5->fetch(PDO::FETCH_ASSOC);
           $cparam= $datos['PERM_CONSULTAR'];
           $mparam= $datos['PERM_ACTUALIZAR'];
           /*OBTENER PERMISO DE ROLES*/
           $sql6 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
           $resultado6=$conexion->prepare($sql6);	
           $resultado6->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_oroles']));
           $datos = $resultado6->fetch(PDO::FETCH_ASSOC);
            $croles= $datos['PERM_CONSULTAR'];
            $iroles= $datos['PERM_INSERTAR'];
            $eroles= $datos['PERM_ELIMINAR'];
            $mroles= $datos['PERM_ACTUALIZAR'];
            /*OBTENER PERMISO DE BITACORA*/
           $sql7 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
           $resultado7=$conexion->prepare($sql7);	
           $resultado7->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_obit']));
           $datos = $resultado7->fetch(PDO::FETCH_ASSOC);
           $cbit= $datos['PERM_CONSULTAR'];
            /*OBTENER PERMISO DE BACKUP*/
            $sql8 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
            $resultado8=$conexion->prepare($sql8);	
            $resultado8->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_oback']));
            $datos = $resultado8->fetch(PDO::FETCH_ASSOC);
            $cback= $datos['PERM_CONSULTAR'];
            /*OBTENER PERMISO DE*/
           $sql9 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO=:pantalla" ;
           $resultado9=$conexion->prepare($sql9);	
           $resultado9->execute(array(":rol"=>$_SESSION['id_rol'],":pantalla"=>$_SESSION['id_operm']));
           $datos = $resultado9->fetch(PDO::FETCH_ASSOC);
            $cperm= $datos['PERM_CONSULTAR'];
            $iperm= $datos['PERM_INSERTAR'];
            $mperm= $datos['PERM_ACTUALIZAR'];

           
           ?>
         
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
                          <option value="1"
                          <?php
                        if ($cu==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($cu==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>USUARIO</td>
                  <td>CREAR USUARIO </td>
                  <td>
                        <select class="form-control" name="per_usu_i" id="per_usu_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($iu==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($iu==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>USUARIO</td>
                  <td>EDITAR USUARIO </td>
                  <td>
                        <select class="form-control" name="per_usu_m" id="per_usu_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($mu==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($mu==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>USUARIO</td>
                  <td>ELIMINAR USUARIO </td>
                  <td>
                        <select class="form-control" name="per_usu_e" id="per_usu_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($eu==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($eu==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL USUARIO-->
                <tr> <!--INICIO PACIENTE-->
                  <td>PACIENTES</td>
                  <td>MOSTRAR PACIENTES</td>
                  <td>
                        <select class="form-control" name="pac_c" id="pac_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($cpac==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($cpac==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr><!--INICIO PACIENTE-->
                  <td>PACIENTES</td>
                  <td>CREAR PACIENTES </td>
                  <td>
                        <select class="form-control" name="pac_i" id="pac_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($ipac==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($ipac==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>PACIENTES</td>
                  <td>EDITAR PACIENTES </td>
                  <td>
                        <select class="form-control" name="pac_m" id="pac_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($mpac==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($mpac==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>PACIENTES</td>
                  <td>ELIMINAR PACIENTES </td>
                  <td>
                        <select class="form-control" name="pac_e" id="pac_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($epac==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($epac==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL PACIENTE-->
                <tr> <!--INICIO EXPEDIENTE DOCTORA-->
                  <td>EXPEDIENTE DOCTORA</td>
                  <td>MOSTRAR EXPEDIENTE DOCTORA</td>
                  <td>
                        <select class="form-control" name="exp_doc_c" id="exp_doc_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($ced==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($ced==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE DOCTORA</td>
                  <td>CREAR EXPEDIENTE DOCTORA </td>
                  <td>
                        <select class="form-control" name="exp_doc_i" id="exp_doc_i"required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($ied==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($ied==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE DOCTORA</td>
                  <td>ELIMINAR EXPEDIENTE DOCTORA </td>
                  <td>
                        <select class="form-control" name="exp_doc_e" id="exp_doc_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($eed==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($eed==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL EXPEDIENTE DOCTORA-->
                <tr> <!--INICIO EXPEDIENTE NUTRICIONISTA-->
                  <td>EXPEDIENTE NUTRICIONISTA</td>
                  <td>MOSTRAR EXPEDIENTE NUTRICIONISTA</td>
                  <td>
                        <select class="form-control" name="exp_nutri_c" id="exp_nutri_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($cen==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($cen==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE NUTRICIONISTA</td>
                  <td>CREAR EXPEDIENTE NUTRICIONISTA </td>
                  <td>
                        <select class="form-control" name="exp_nutri_i" id="exp_nutri_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($ien==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($ien==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>EXPEDIENTE NUTRICIONISTA</td>
                  <td>ELIMINAR EXPEDIENTE NUTRICIONISTA </td>
                  <td>
                        <select class="form-control" name="exp_nutri_e" id="exp_nutri_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($een==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($een==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL EXPEDIENTE NUTRICIONISTA-->
                <tr> <!--INICIO CITAS-->
                  <td>CITAS</td>
                  <td>MOSTRAR CITAS</td>
                  <td>
                        <select class="form-control" name="citas_c" id="citas_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($ccit==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($ccit==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>CITAS</td>
                  <td>CREAR CITAS</td>
                  <td>
                        <select class="form-control" name="citas_i" id="citas_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($icit==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($icit==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>CITAS</td>
                  <td>EDITAR CITAS</td>
                  <td>
                        <select class="form-control" name="citas_m" id="citas_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($mcit==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($mcit==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>CITAS</td>
                  <td>ELIMINAR CITAS </td>
                  <td>
                        <select class="form-control" name="citas_e" id="citas_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($ecit==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($ecit==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL CITAS-->
                <tr> <!--INICIO PARAMETROS-->
                  <td>PARAMETROS</td>
                  <td>MOSTRAR PARAMETROS</td>
                  <td>
                        <select class="form-control" name="parametros_c" id="parametros_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($cparam==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($cparam==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>PARAMETROS</td>
                  <td>EDITAR PARAMETROS</td>
                  <td>
                        <select class="form-control" name="parametros_m" id="parametros_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($mparam==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($mparam==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr><!--FINAL PARAMETROS-->
                <tr> <!--INICIO ROLES-->
                  <td>ROLES</td>
                  <td>MOSTRAR ROLES</td>
                  <td>
                        <select class="form-control" name="roles_c" id="roles_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($croles==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($croles==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>ROLES</td>
                  <td>CREAR ROLES </td>
                  <td>
                        <select class="form-control" name="roles_i" id="roles_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($iroles==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($iroles==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>ROLES</td>
                  <td>EDITAR ROLES </td>
                  <td>
                        <select class="form-control" name="roles_m" id="roles_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($mroles==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($mroles==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td>ROLES</td>
                  <td>ELIMINAR ROLES </td>
                  <td>
                        <select class="form-control" name="roles_e" id="roles_e" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($eroles==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($eroles==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr> <!--FINAL ROLES-->
                <tr> <!--INICIO BITACORA-->
                  <td>BITACORA</td>
                  <td>MOSTRAR BITACORA</td>
                  <td>
                        <select class="form-control" name="bit_c" id="bit_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($cbit==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($cbit==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr><!--FINAL bitacora-->
                <tr> <!--INICIO BACKUP-->
                  <td>BACKUP/RESTORE</td>
                  <td>MOSTRAR BACKUP/RESTORE</td>
                  <td>
                        <select class="form-control" name="back_c" id="back_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($cback==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($cback==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr><!--FINAL BACKUP-->
                <tr> <!--INICIO PERMISOS-->
                  <td>PERMISOS</td>
                  <td>MOSTRAR PERMISOS</td>
                  <td>
                        <select class="form-control" name="perm_c" id="perm_c" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($cperm==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($cperm==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>PERMISOS</td>
                  <td>CREAR PERMISOS</td>
                  <td>
                        <select class="form-control" name="perm_i" id="perm_i" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($iperm==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($iperm==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
                        </select>
                  </td>
                </tr>

                <tr> 
                  <td>PERMISOS</td>
                  <td>EDITAR PERMISOS</td>
                  <td>
                        <select class="form-control" name="perm_m" id="perm_m" required>
                          <option value="">SELECCIONE :</option>
                          <option value="1"
                          <?php
                        if ($mperm==1) {
                        echo 'selected';
                        }
                        ?>
                          >SI</option>
                          <option value="0"
                          <?php
                        if ($mperm==0) {
                        echo 'selected';
                        }
                        ?>
                        >NO</option>
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
              <button type="submit"  class="btn btn-primary btn-flat margin">EDITAR</button>
                <a href="../vistas/index2.php" class="btn bg-red btn-flat margin" >CANCELAR</a>
               
              </div>
              </div>
                </form>
      </div>
        <?php  }  } ?>
       
            

        
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

<script src="../vistas/js/printThis.js"></script>

<script >
$('#print').click (function(){

 $('.form-group col-lg-6 col-md-6 col-xs-12').printThis();  
} )

</script>

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

</body>
</html>
<?php require "../modelos/actualizar_permisos.php" ?>




