<?php
session_start();
require_once "../modelos/conectar.php"; 
if (!isset($_SESSION["id_us"])) {
  header('location:../vistas/login_vista.php');
}

$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>33,":accion"=>'INGRESO',":descr"=>'INGRESO ALA PANTALLA DE MOSTRAR BITACORA',":fecha"=>date("Y-m-d"),":hora"=>date(" H:i:s")));         
$sql2="INSERT  INTO TBL_BITACORA (BIT_CODIGO,USU_CODIGO,OBJ_CODIGO,BIT_ACCION,BIT_DESCRIPCION,BIT_FECHA,BIT_HORA) 
VALUES (:id,:usuc,:objeto,:accion,:descr,:fecha,:hora)";
$resultado2=$conexion->prepare($sql2);	
$resultado2->execute(array(":id"=>NULL,":usuc"=>$_SESSION["id_us"],":objeto"=>33,":accion"=>'CONSULTA',":descr"=>'MUESTRA LOS REGISTROS DE LA BITACORA',":fecha"=>date("Y-m-d"),":hora"=>date(" H:i:s")));

$ROL = $_SESSION['ROL'];
$_SESSION['PANTALLA'] = 33;
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
 $SEGURIDAD=$DATOS['PERM_SEGURIDAD']



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bitacora del Sistema</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../vistas/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../vistas/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <!--date picker-->
   <link rel="stylesheet" href="../vistas/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../vistas/Plugins/sweetalert/dist/sweetalert2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">

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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     BITÁCORA DEL SISTEMAS
        
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
            </div>
            <!--llamar funciones-->
            <div class="box-body">
            <!-- IMPUTS DE BUSQUEDAD POR FECHA-->
            <div class="row">
     <div class="input-daterange">
      <div class="col-md-3">
       <input type="text" name="start_date" id="start_date" placeholder="FECHA INICIAL"class="form-control" autocomplete="off" readonly="" />
      </div>
      <div class="col-md-3">
       <input type="text" name="end_date" id="end_date" placeholder="FECHA FINAL"class="form-control" autocomplete="off"  readonly=""/>
      </div>      
     </div>
     <div class="col-md-4">
      <input type="button" name="search" id="search" value="Buscar Rango" class="btn btn-info active"  />
     </div>
    </div>
                <!--FINAL-->
                <p>

                </p>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>USUARIO</th>
                  <th>PANTALLA</th>
                  <th>ACCION</th>
                  <th>DESCRIPCIÓN</th>
                  <th>FECHA</th>  
                  <th>HORA</th>     
                </tr>
                </thead>
                <tbody>
</table>
   
          <!-- /.box -->
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
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<script src="../vistas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../controladores/funciones.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../vistas/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../vistas/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../vistas/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../vistas/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../vistas/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../vistas/dist/js/demo.js"></script>
<script src="../vistas/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
<!-- Date Picker-->
<script src="../vistas/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- page script -->
<!-- librerias para el uso del  pdf-->
<script type="text/javascript" src="../vistas/reportes/JSZip-2.5.0/jszip.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/pdfmake.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/pdfmake-0.1.36/vfs_fonts.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.flash.min.js"></script>
 <script type="text/javascript" src="../vistas/reportes/Buttons-1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" >



$(document).ready(function(){
 
  var currentdate = new Date();
    var datetime = "FECHA: " + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "    HORA: " 
                + currentdate.getHours() + ":" 
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds() +'\n';     


 $('.input-daterange').datepicker({
    "locale": {
                "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
  
  format: "yyyy-mm-dd ",
  autoclose: true

 });

 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
  var dataTable = $('#example1').DataTable({

   "processing" : true,
   "serverSide" : true,
   "sort": false,
   "order" : [],
   "ajax" : {
    url:"../modelos/fetch.php",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date,
     
    }
    
   },
    /////////////////////////////////////////////////////////
    dataSrc: 'list',
               dom:

"<'row'<'col-sm-6 col-md-6'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", ///'<"top">Brt<"bottom"flp><"clear">',//'B<lf<t>ip>',// posicion del buscaodor y los botones en el orden establecido en pantalla
          
buttons: 
    [        
      {
        
            extend:'pdfHtml5',                  
            titleAttr: 'exportar a pdf', // boton para exportar
            className: 'btn btn-danger btn-sm',// color del boton
            text:'EXPORTAR A PDF ',
            title:'CLÍNICA MÉDICA HOMEOPATICA CLIME HOME '+'\n'+'\n'+'BITACORA',// titulos
            messageTop:datetime,   
            processing: true,
            orientation: 'landscape',

           
                  customize: function (doc)  
            {	              
                    doc.defaultStyle.fontSize = 10;// da el tipo de  tamaño de la fuente dentro de la data. \
                    doc.defaultStyle.alignment = 'left';// orientacion de la data dentro del pdf , centro,izquierda o derecha.
                    doc.styles.tableHeader.fontSize =12;
                    doc.styles.title = {
                          //  color: 'black',   // color del title
                            fontSize: '12',// tamaño de letra
                            alignment: 'center',       // posicion
                        }
                    doc.styles.messageTop={
                            alignment: 'left', 
                            fontSize: '11' // posicion del mensaje top
                        }     
                    doc['header'] = (function (page, pages) {// nombre de la empresa en la esquina superior derecha.
                          return {
                                  columns: [
                                     {
                                        
                                      }
                                 ],
                                 margin: [10, 10],
                                       columns: [
                                   {           
                                    margin:[745],//posiciion de la imagane si es menor el numero mas se hace a un lado izquierdo
                                    alignment: 'right',
                                     image: 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCADvAOEDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD3+iiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACijNGaACiimyNtQt1xQAuaUVymp6prkepBLG1SS24w2M59cntXSW0vmpk4zxnHTNU42SZnCopNrsT0UUVJoFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFACMwHJNUnu3Zd8e1Yx/G/f6CpNQJFjMV67aruoaW04/dD8s44qkjOcnsPE84G4vx/1yOKjlvGa3codrLIqbh3yR0rRxxVLUQBbDGP9Yn8xQmmxNNK9x1s8gvHiZyyhA3P41bdlVSWIAHXNZcl3DZ3dxPPIERYlyT9TXE6/wCKJtTLQWxMVr093+taRpOb0MKmJhRhd7m1qHirTodRWOO2WeMHEkg/p6109jd293apLbOrRnpt7V47V/StYutIuPMgbKH70Z6NXRPCq3u7nFRzGSn+82PXGkRBl2C/U00zxKMmRQPUmsGy1i11qS2eI/Mu7fG3VTirttArtMVwgVyo+XJ9e9cjhbc9ONVS+HU0llRxlWBHqDTRcwk4EqE+mazC/m2kLlV3u4XPbripmUwXEMZ2sr5B+UDGBS5R+0drmjuFMaeJPvSKv1NZ3nulrMAcES+Wp9Acf40yRfLuAqgbQvOCNxPqaOUHU0NVZY3+66n6Gn5rIVmCyluOMoepB/CtK3ZngRnGGKgkelJqxUZXJaKKKRYUUUUAFFFFABRRRQAUUUUAFFFFABRRRQA1lDAgjIPWqgtXhBVCrR9lbt9DV2kNO5LimUTBK3GGHt5hxWZql1b6RZMZ5hvdwyxr1OOw/wAav6jftHAy2jRGfoBI2APeuGu9D1O+naa4u7d5G7lz/hWtJRb952Ry4iU4K1ON2Vdd1garMrJvVR0U1kVqroM7XLW4ubbzFGSN5/wqX/hF7z/nvbf99n/Cu5VKUVZM8eVGvUbk4sxaK2v+EXvP+e9t/wB9n/Cj/hF7z/nvbf8AfZ/wp+2p9yfqtb+VlPTL1bGcyFpFJxho8ZH5123h/wAQ2l5JJA7FJnbcu/jd/wDXrkLjQZ7WPfLcWwXOPvnr+VTL4avRhluLcHqCHP8AhWVX2U1e50UPrFKVlE79LOURxR/LhJN+7PvmrNxA8ksMiYOzPBOM8VjaJdXsEXkajNC4UfLIr5P48V0CMsiBl5Brhbsz2YJSjtYqJZloJY5cfvHLcHpR5EwxnDMBjepwavYoxSuyuRGc1tcupHmMvoS3T8AKvqMDB607FFDdxqNgooopFBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQA0oD2FGxfQU6g0Acxagf8ACc3gwMeQtdLsX0Fc3a/8j1ef9cFrpcitKm69EY0dn6sTYvoKNi+gpc0ZrM2Oc8YqBpCYAH75P51vxIvlJwPuisHxl/yB0/67J/Ough/1Kf7oq38CMY/xZei/UXYvoKcBiiioNgooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAOQa/trDxrdvcSBFMKgcE81rf8JNpP/P0P++D/hWfDDHL45vPMRWxAvUZrofsVt/zwj/75Faztpfsc1JS1s+rM7/hJtJ/5+h/3wf8KP8AhJtJ/wCfof8AfB/wrR+x23/PCP8A75FH2O2/54R/98io901tPucp4m1qxvtNSK3nDv5yHG0jvXYQ/wCpT/dFcz4vtoI9JjZIkU+enIX3rpof9Sn+6KqVuRWM6d/aSv2X6j6KKKzOgKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACg0UhoA5q1/wCR6vP+uC101cza/wDI9Xn/AFwWumrSpuvRGNHZ+rCiiiszY5zxl/yCE/67J/OtE3DGN9r7I4gAzAZJOO1Z3jE/8ShP+u6fzq95JQSK6M0Mwzlf4TitdORXOZt+1lby/UdtmEPmky4xnG/n8sVLHc7TFltyS/dJ60xppPL8sFcYxuwc/lSQwNJJCAhWGHpu6scVJWt9CNpZcTy+eyhJCOmRj6U8tIhjaVphvOAdw4/CopVYQ3Ue1tzSkgY6jirV8p8qEgE4kUnA6Cmw11Iy8zztCru20ZO3Ax9TSC4McDyhn/dthlc5qW2BN3cOAdpC4JFVZUYQXabTuaQlRg89KWga2uXJp3M3kxnaQu5m9BVJbgshfzX/AN0vg/lirUkUkdx5yqWVlCtjqMd6h4jAAy/uzMDQkgfM9yeK5O+JSSVlHy56jvV0Vn24Z7pSYuFBIbJOD+NaAqZGkG2tRaKKKRYUUUUAFFFFABRRRQAUUUUAFFFFABRRRQBnR6VHHrEuoh2MkiBCvbFaNFFNu4kktgooopDKGq6XHqlssEjsqhw/HtV1U2qF64GKdRTv0Fyq9xNooxS0UhibaMUtFACYowKWigBMUYpaKAExiloooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA//2Q=='+'\n'+'\n'+'\n'+'\n'
                                    ,width: 100,
                                    height: 110  
                                },
                               ]
                             }
                      }); 
                      
                    doc['footer']=(function(page, pages)// funcion para el footer de la  pagina donde esta el posicion del numero de la pagina
                         {
                             return {
                             columns: 
                             [
                               {
                                alignment: 'center',
                                text: ['PAGINA ', { text: page.toString() },  ' DE ', { text: pages.toString() }]
                               },
                             ],
                           margin: [10, 0]
                                    }
                       });       
            },
            exportOptions:
             {
                 columns: [0,1,2,3,4,5] ,//exportar solo las columnas.
             },
                  styles:
              {
                  tableHeader:
                  {
                   fillColor:"#F0F8FF"
                  }
             },  
          
         } 
    ],
        language: {// traduccion de la tabla  entera.
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                        },
            "oAria":    {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
            "decimal": ",",
            "thousands": "."
          }
 ////////////////////////////////////////////////////////////////////
  });
 }

 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#example1').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
   
  }
  else
  {
   alert("Por favor seleccione la fecha");
  }
 }); 
 
});
</script>

</body>
</html>
