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
        <?php if ($_SESSION['u']==11 and $_SESSION['cu']==1 ){  ?>  
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Usuarios</span>
        </a>
        <!-- subtitulos de Usuario -->

        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_vista.php"><i class="fa fa-list-alt"></i>Lista de Usuarios</a></li>
        </ul>
       
        
      </li>
      <?php  }  ?>  
     
      <!-- Titulo de Pacientes -->
      <li class="treeview">
      <?php if ($_SESSION['pac']==18 and $_SESSION['cpac']==1 ){  ?>  
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Pacientes</span>

        </a>
        <!-- subtitulos de Pacientes -->
        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_pacientes_vista.php"><i class="fa fa-list-alt"></i>Lista de Pacientes</a></li>
        </ul> 
      </li>
      <?php  }  ?> 
            <!-- Titulo de Expedientes -->
      <li class="treeview">
      <?php if ($_SESSION['ed']==24 and $_SESSION['ced']==1 ){  ?>  
        <a href="#">
          <i class="fa fa-folder-o"></i>
          <span>Expedientes Médicos </span>

          </a>
        <!-- subtitulos de Expedientes -->
        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expediented_vista.php"><i class="fa fa fa-list-alt"></i>Mostrar Expediente Médico </a></li>
        </ul>
      </li>
      <?php  }  ?>  
      <li class="treeview">
      <?php if ($_SESSION['en']==22 and $_SESSION['cen']==1 ){  ?>  
        <a href="#">
          <i class="fa fa-folder-o"></i>
          <span>Expedientes Nutricionista</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expedienten_vista.php"><i class="fa fa-list-alt"></i>Mostrar Expediente Nutricional</a></li>
          </ul>
      </li>
      <?php  }  ?>  

      <!-- Titulo de Citas -->
      <li class="treeview">
      <?php if ($_SESSION['cit']==28 and $_SESSION['ccit']==1 ){  ?>
        <a href="#">
          <i class="fa fa-calendar"></i>
          <span>Citas Médicas</span>
          </a>
            <ul class="treeview-menu">
            <li><a href="../vistas/mostrar_citasd_vista.php"><i class=" fa fa-calendar-check-o"></i>Mostrar Citas del Dia</a></li>
          <li><a href="../vistas/mostrar_citas_vista.php"><i class="fa fa-list-alt"></i>Lista de citas</a></li>
          <li><a href="../vistas/reporte_citas.php"><i class="fa fa-list-alt"></i>Reporte de citas con filtros</a></li>
        </ul>
          
      </li>
      
        </a>
      </li>
      <?php  }  ?>  


       <li class="treeview">
      <?php if ($_SESSION['cit']==28 and $_SESSION['ccit']==1 ){  ?>
        <a href="#">
        <i class="fa fa-graduation-cap"></i>
          <span>Profesiones | Ocupaciones</span>
          </a>
            <ul class="treeview-menu">
            <li><a href="../vistas/mostrar_profesiones.php"><i class=" fa fa-list-alt"></i>Mostrar Profesión | Ocupación </a></li>
        </ul>
      </li>
        </a>
      </li>
      
      <?php  }  ?> 
     <!-- Titulo de Seguridad -->
     <?php if ($_SESSION['cparam']==1 or $_SESSION['croles']==1 or $_SESSION['cbit']==1 or $_SESSION['cback']==1 or $_SESSION['cperm']==1 ){  ?>
     <li class="header">Seguridad</li>
     <?php  }  ?>  
     
     <li class="treeview">
      <?php if ($_SESSION['back']==40 and $_SESSION['cback']==1 ){  ?>
        <a href="#">
          <i class="	glyphicon glyphicon-question-sign"></i>
          <span>Preguntas de seguridad</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_preguntas.php"><i class="fa fa-list-alt"></i>Mostrar preguntas</a></li>
          </ul>
      </li>
      <?php  }  ?> 

     <li class="treeview">
     <?php if ($_SESSION['param']==30 and $_SESSION['cparam']==1 ){  ?>
        <a href="#">
          <i class="	glyphicon glyphicon-bullhorn"></i>
          <span>Parámetros</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_parametros_vista.php"><i class="fa fa-list-alt"></i>Lista de Parámetros</a></li>
          </ul>
      </li>
      <?php  }  ?>  
      <li class="treeview">
      <?php if ($_SESSION['roles']==31 and $_SESSION['croles']==1 ){  ?>
        <a href="#">
          <i class=	"glyphicon glyphicon-briefcase"></i>
          <span>Roles</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_roles_vista.php"><i class="fa fa-list-alt"></i>Lista de Roles</a></li>
          </ul>
      </li>
      <?php  }  ?>  
      <li class="treeview">
      <?php if ($_SESSION['perm']==36 and $_SESSION['cperm']==1 ){  ?>
        <a href="#">
          <i class="glyphicon glyphicon-random"></i>
          <span>Permisos</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <?php if ( $_SESSION['cperm']==1 and $_SESSION['iperm']==1 ){  ?>
          <li><a href="../vistas/insertar_permisos.php"><i class="fa fa-plus-circle"></i>Añadir Permisos</a></li>
          <?php  }  ?> 
          <?php if ( $_SESSION['cperm']==1 and $_SESSION['mperm']==1 ){  ?>
          <li><a href="../vistas/editar_permisos.php"><i class=" fa fa-pencil-square-o"></i>Editar Permisos</a></li>
          <?php  }  ?> 
          </ul>
      </li>
      <?php  }  ?>  
   
      
      <li class="treeview">
      <?php if ($_SESSION['bit']==33 and $_SESSION['cbit']==1 ){  ?>
        <a href="#">
          <i class="glyphicon glyphicon-tasks"></i>
          <span>Bitácora</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <li><a href="../vistas/bitacora_vista.php"><i class="fa fa-list-alt"></i> Ver Bitácora</a></li>
          <li><a href="../vistas/reporte_bitacora.php"><i class="fa fa-list-alt"></i>Reporte de bitácora con filtros</a></li>
          </ul>
      </li>
    

      <li class="treeview">
      <?php if ($_SESSION['back']==40 and $_SESSION['cback']==1 ){  ?>
        <a href="#">
        <i class="fa fa-television" aria-hidden="true"></i>
          <span>Pantallas</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_pantallas.php"><i class="fa fa-list-alt"></i>Mostrar lista de pantallas</a></li>
          </ul>
      </li>
      <?php  }  ?>
      <?php  }  ?>  
      <li class="treeview">
      <?php if ($_SESSION['back']==40 and $_SESSION['cback']==1 ){  ?>
        <a href="#">
          <i class="glyphicon glyphicon-cloud-upload"></i>
          <span>Backup | Restore</span>
        </a>
        <!-- subtitulos de Expedientes -->
          <ul class="treeview-menu">
          <li><a href="../vistas/backup_vista.php"><i class="	glyphicon glyphicon-cloud-download"></i> Backup | Restore</a></li>
          </ul>
      </li>
      <?php  }  ?> 



     
       
 

      
     
   
    </section>
    <!-- /.sidebar -->
  </aside>