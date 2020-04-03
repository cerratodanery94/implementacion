<?php
session_start();
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}


$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 28;
$PANTALLA = $_SESSION['PANTALLA'];
$sql3 = "select * from tbl_permisos where ROL_CODIGO = :rol and OBJ_CODIGO = :pantalla ";
$resultado3=$conexion->prepare($sql3);	
$resultado3->execute(array(":rol"=>$ROL,":pantalla"=>$PANTALLA));
$DATOS = $resultado3->fetch(PDO::FETCH_ASSOC);
 $CONSULTAR = $DATOS['PERM_CONSULTAR'];
 $INSERTAR = $DATOS['PERM_INSERTAR'];
 $ELIMINAR = $DATOS['PERM_ELIMINAR'];
 $ACTUALIZAR = $DATOS['PERM_ACTUALIZAR'];
 $PERM_OBJ = $DATOS['PERM_OBJ'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Calendario</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../vistas/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="../vistas/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="../vistas/plugins/fullcalendar/fullcalendar.print.css" media="print">
  <link rel="stylesheet" href="../vistas/plugins/fullcalendar/bootstrap-clockpicker.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">
<!-- Theme style -->
  <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.min.css">
 
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">

<style>
    .fc th{
         padding: 10px 0px;
         vertical-align: middle;
         background: #338AFF;

    }

</style>

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

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="../vistas/img/User_icono1.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["usu"];?></p>
          </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Barra de Navegación</li>
       
       <!-- Titulo de Usuario -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Usuarios</span>
        </a>
        <!-- subtitulos de Usuario -->

        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_vista.php"><i class="fa fa-list"></i>Lista de Usuarios</a></li>
        </ul>
       <?php } ?>
        
      </li>
       <!-- Titulo de Empleados -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Empleados</span>

        </a>
        <!-- subtitulos de Empleados -->

        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_empleados_vista.php"><i class="fa fa-list"></i> Lista de Empleados</a></li>
        </ul>
        <?php } ?>
        
      </li>
     
      <!-- Titulo de Pacientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Pacientes</span>

        </a>
        <!-- subtitulos de Pacientes -->
        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_pacientes_vista.php"><i class="fa fa-list"></i>Lista de Pacientes</a></li>
        </ul>
       <?php } ?>
        
      </li>
      <!-- Titulo de Expedientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open-o"></i>
          <span>Expedientes Nutricionista</span>

          </a>
        <!-- subtitulos de Expedientes -->
        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expedienten_vista.php"><i class="fa fa-list"></i>Mostrar Expediente Nutricional</a></li>
        </ul>
         <?php } ?>
        
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open-o"></i>
          <span>Expedientes Medico </span>

          </a>
        <!-- subtitulos de Expedientes -->
        <?php if ($PERM_OBJ == 1){ ?>
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expediented_vista.php"><i class="fa fa fa-list"></i>Mostrar Expediente Médico </a></li>
        </ul>
        <?php } ?>
       
      </li>
      <!-- Titulo de Citas -->
      <li class="treeview">
        <a href="../vistas/citas_vista.php">
          <i class="fa fa-calendar"></i>
          <span>Citas</span>
          </a>

          <?php if ($PERM_OBJ == 1){ ?>
            <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_citas_vista.php"><i class="fa fa-list"></i>Lista de citas</a></li>
        </ul>
           <?php } ?>
        
      </li>
        </a>
      </li>
 <!-- Titulo de Seguridad -->

    <?php if ($PERM_OBJ == 1){ ?>
      <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-lock"></i>
          <span>Seguridad</span>

        </a>
        <!-- subtitulos de Seguridad -->
        <ul class="treeview-menu">
        <li><a href="../vistas/insertar_permisos_vista.php"><i class="fa fa-list"></i>Añadir Permisos</a></li>
          <li><a href="../vistas/mostrar_parametros_vista.php"><i class="fa fa-list"></i>Lista de Parámetros</a></li>
          <li><a href="../vistas/mostrar_roles_vista.php"><i class="fa fa-list"></i>Lista de Roles</a></li>
          <li><a href="#"><i class="glyphicon glyphicon-cloud-upload"></i>Backup</a></li>
          <li><a href="../vistas/bitacora_vista.php"><i class="fa fa-list"></i>Bitácora</a></li>
        </ul>
      </li>
    <?php } ?>

   
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CALENDARIO
        <small>Control de Citas</small>
      </h1>
  
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-10">
        <div class="box box-success">
            <div class="box-header with-border">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
              </div>
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


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
    
  </aside>
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
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- SlimScroll -->
<script src="../vistas/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../vistas/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../vistas/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../vistas/dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../vistas/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="../vistas/plugins/fullcalendar/bootstrap-clockpicker.js"></script>
<!-- Page specific script -->
<script>
  

  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
          
        });

      });
    }

    ini_events($('#external-events div.external-event'));




    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay',
      },
      buttonText: {
        today: 'dia',
        month: 'mes',
        week: 'semana',
        day: 'dia'
      },
 allDay:'todo el dia',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: '',

      

      
      
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      },
      dayClick: function (date,jsEvent,view){
        $('#btnAgregar').prop("disabled",false);
        $('#btnModificar').prop("disabled",true);
        $('#btnBorrar').prop("disabled",true);
        limpiarFormulario();
        $('#txtFecha').val(date.format());
        $('#txtFecha2').val(date.format());
        $("#ModalEventos").modal();
      },
      events:'http://localhost:8080/implementacion/modelos/conectar_base_calendario.php',

      eventClick:function(calEvent,jsEvent,view){

        $('#btnAgregar').prop("disabled",true);
        $('#btnModificar').prop("disabled",false);
        $('#btnBorrar').prop("disabled",false);

        //H2
        //$('#tituloEvento').html(calEvent.title);
        //Mostrar la información del evento en los inputs
        $('#txtDescripcion').val(calEvent.descripcion);
        $('#txtID').val(calEvent.id);
        
        $('#txtTitulo').val(calEvent.title);
        $('#textColor').val(calEvent.color);
             
       // $('#txtEmp').val(jsEvent.EMP);
        
 
        FechaHora= calEvent.start._i.split(" ");
        $('#txtFecha').val(FechaHora[0]);
        $('#txtHora').val(FechaHora[1]);
        $("#ModalEventos").modal();

        FechaHora= calEvent.end._i.split(" ");
        $('#txtFecha2').val(FechaHora[0]);
        $('#txtHora2').val(FechaHora[1]);
        $("#ModalEventos").modal();
        
      },
      editable:true,
      eventDrop:function(calEvent){
        $('#txtID').val(calEvent.id);
        $('#txtTitulo').val(calEvent.title);
        $('#textColor').val(calEvent.color);
        $('#txtDescripcion').val(calEvent.descripcion);

        var Empleado=calEvent.EMP.format().split("T");
        $('#txtEmp').val(Empleado[0]);

        var FechaHora=calEvent.start.format().split("T");
        $('#txtFecha').val(FechaHora[0]);
        $('#txtHora').val(FechaHora[1]);

        var FechaHora=calEvent.end.format().split("T");
        $('#txtFecha2').val(FechaHora[0]);
        $('#txtHora2').val(FechaHora[1]);

        RecolectarDatosGUI();
        EnviarInformacion('modificar',NuevoEvento,true);
      }
    });
  });
  </script>

<!-- Modal Agregar, Modificar, Eliminar-->
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="box box-success">
            <div class="box-header with-border">
      <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="hidden" id="txtID" name="txtID"/><br/>
            <input type="hidden" id="txtFecha" name="txtFecha"/><br/>
            <input type="hidden" id="txtFecha2" name="txtFecha2"/><br/>

        <div class="form-row">
        <!--INPUT TITULO-->
              <div class="form-group col-md-8">
              <label>TITULO CITA:</label>
                  <input type="text" id="txtTitulo" class="form-control" placeholder="Titulo de la cita"/><br/>
              </div>
        <!--INPUT HORA CITA-->    
              <div class="form-group col-md-4">
              <label>HORA DE LA CITA:</label>
              <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" id="txtHora" value=" " class="form-control"/>
              </div>
              </div>
        <!--SELECT EMPLEADO-->
            <div class="form-group col-md-8">
            <label>DOCTOR:</label>
                   <select class="form-control" name="txtEmp" id="txtEmp">
                   <option value="0">SELECCIONE:</option>
        <?php
        require '../modelos/conectar.php';
          $resultado = $conexion -> query ("SELECT * FROM TBL_EMPLEADOS");
          while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="'.$registro["EMP_CODIGO"].'">'.$registro["EMP_NOMBRES"].'</option>';
          }
        ?>
                   </select>
                   </div>
        <!--INPUT HORA FINAL-->
             <div class="form-group col-md-4">
                  <label>HORA FINAL DE LA CITA:</label>
                  <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" id="txtHora2" value=" " class="form-control"/>
                  </div>
              </div>
           </div>
        <!--TEXTTAREA DESCRIPCIÓN-->
            <div class="form-group col-md-12">
             <label>ESTADO DE CITA</label>
             <textarea type="text" id="txtDescripcion" rows="3" class="form-control"></textarea>
         </div> 
         <!--INPUT COLOR-->
         <div class="form-group col-md-2"> 
             <label>COLOR:</label>  
             <input type="color" id="textColor" value=" " class="form-control" style="height:36px;"/><br/>
        </div> <br/>
      </div><br/>
          <!--BOTONES-->
      <div class="modal-footer">
      <div class="form-group col-md-12"> 
      <button type="button" id="btnAgregar" class="btn btn-success glyphicon glyphicon-ok"></button>
      <button type="button" id="btnModificar" class="btn btn-success glyphicon glyphicon-pencil"></button>  
      <button type="button" id="btnBorrar" class="btn btn-danger glyphicon glyphicon-trash"></button>
      <button type="button" class="btn btn-default glyphicon glyphicon-remove" data-dismiss="modal"></button>
      </div>
      </div>
    </div>
  </div>
  </div>
</div>
<script>
var NuevoEvento;

$('#btnAgregar').click(function(){
  RecolectarDatosGUI();
  EnviarInformacion('agregar',NuevoEvento);
});

$('#btnBorrar').click(function(){
  RecolectarDatosGUI();
  EnviarInformacion('eliminar',NuevoEvento);
});

$('#btnModificar').click(function(){
  RecolectarDatosGUI();
  EnviarInformacion('modificar',NuevoEvento);
});

function RecolectarDatosGUI(){
  NuevoEvento= {
     id:$('#txtID').val(),
     title:$('#txtTitulo').val(),
     EMP:$('#txtEmp').val(),
     descripcion:$('#txtDescripcion').val(),
     color:$('#textColor').val(),
     textColor:"#FFFFFF",
     start:$('#txtFecha').val()+" "+$('#txtHora').val(),
     end:$('#txtFecha2').val()+" "+$('#txtHora2').val()
   };
}
function EnviarInformacion(accion,objEvento,modal){
      $.ajax({
           type:'POST',
           url:'http://localhost:8080/implementacion/modelos/conectar_base_calendario.php?accion='+accion,
           data: objEvento,
           success:function(msg){
             if(msg){
               $('#calendar').fullCalendar('refetchEvents');
               if(!modal){
               $("#ModalEventos").modal('toggle');
              
               }
             }
           },
          error: function(){
             alert("Hay un error..");
           }
      });
}
$('.clockpicker').clockpicker();
function limpiarFormulario(){
        $('#txtID').val('');
        $('#txtEmp').val('');
        $('#txtTitulo').val('');
        $('#txtDescripcion').val('');
        $('#textColor').val('');
        $('#txtHora').val('');
        $('#txtHora2').val('');
}

</script>
</body>
</html>