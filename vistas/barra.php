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
       <?php if ($USUARIOS == 1){ ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Usuarios</span>
        </a>
        <!-- subtitulos de Usuario -->

        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_vista.php"><i class="fa fa-list"></i>Lista de Usuarios</a></li>
        </ul>
       
        
      </li>
      <?php } ?>

      

      

      <?php if ($EMPLEADOS == 1){ ?>
       <!-- Titulo de Empleados -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Empleados</span>

        </a>
        <!-- subtitulos de Empleados -->

        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_empleados_vista.php"><i class="fa fa-list"></i> Lista de Empleados</a></li>
        </ul>
        
        
      </li>
      <?php } ?>
      
      <?php if ($PACIENTES == 1){ ?>
     
      <!-- Titulo de Pacientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Pacientes</span>

        </a>
        <!-- subtitulos de Pacientes -->
        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_pacientes_vista.php"><i class="fa fa-list"></i>Lista de Pacientes</a></li>
        </ul>
       
        
      </li>
      <?php } ?>

      <?php if ($NUTRI == 1){ ?>
      <!-- Titulo de Expedientes -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open-o"></i>
          <span>Expedientes Nutricionista</span>

          </a>
        <!-- subtitulos de Expedientes -->
        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expedienten_vista.php"><i class="fa fa-list"></i>Mostrar Expediente Nutricional</a></li>
        </ul>
        
        
      </li>
      <?php } ?>

      <?php if ($MEDICO == 1){ ?>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open-o"></i>
          <span>Expedientes Medico </span>

          </a>
        <!-- subtitulos de Expedientes -->
        
          <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_expediented_vista.php"><i class="fa fa fa-list"></i>Mostrar Expediente Médico </a></li>
        </ul>
       
       
      </li>

      <?php } ?>

      <?php if ($CITAS == 1){ ?>
      <!-- Titulo de Citas -->
      <li class="treeview">
        <a href="#"
          <i class="fa fa-calendar"></i>
          <span>Citas</span>
          </a>

          
            <ul class="treeview-menu">
          <li><a href="../vistas/mostrar_citas_vista.php"><i class="fa fa-list"></i>Lista de citas</a></li>
        </ul>
          
        
      </li>
      <?php } ?>
        </a>
      </li>
 <!-- Titulo de Seguridad -->

 <?php if ($SEGURIDAD == 1){ ?>
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
          <li><a href="../vistas/backup_vista.php"><i class="glyphicon glyphicon-cloud-upload"></i>Backup</a></li>
          <li><a href="../vistas/bitacora_vista.php"><i class="fa fa-list"></i>Bitácora</a></li>
        </ul>
      </li>
      <?php } ?>
   

   
    </section>
    <!-- /.sidebar -->
  </aside>