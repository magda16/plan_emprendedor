<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">

  <div class="profile_pic">
    <img src="images/user2.png" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    
    <h4 style="color:#FFFFFF">Bienvenido</h4>
    <h2><?php echo $_SESSION['usuario']; ?></h2>
  </div>
</div>
<!-- /menu profile quick info -->

<br />
            
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-desktop"></i> Inicio </a>
                  </li>
                  <?php 
                    $nivel_usuario=$_SESSION['nivel'];
                    if($nivel_usuario=="Administrador General" || $nivel_usuario=="Administrador Territorio"){

                  ?>
                  <li><a><i class="fa fa-folder-o"></i> Emprendedores <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ingreso_emprendedor.php">Agregar</a></li>
                      <li><a href="lista_emprendedores.php">Ver Listado</a></li>
                      <li><a href="mapa_emprendedores.php">Ver Mapa</a></li>
                      <li><a href="lista_apoyo_socio.php">Apoyo a Socio</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-folder-o"></i> Instituciones <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ingreso_institucion.php">Agregar Institucion</a></li>
                      <li><a href="lista_instituciones.php">Ver Listado Instituciones</a></li>
                      <li><a href="ingreso_actividad.php">Agregar Actividad</a></li>
                      <li><a href="lista_actividades.php">Ver Listado Actividades</a></li>
                      <li><a href="ingreso_apoyo_socio.php">Agregar Apoyo a Socio</a></li>
                      <li><a href="lista_apoyo_socios.php">Ver Listado Apoyo a Socios</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i>Usuario <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="ingreso_usuario.php">Agregar Usuario</span></a></li>
                        <li><a href="lista_usuarios.php">Ver lista de Usuarios</a></li>
                    </ul>
                  </li> 
                  <li><a><i class="fa fa-newspaper-o"></i>Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="mapa_emprendedores_reporte.php">Ver Mapa</a></li>
                    </ul>
                  </li> 
                  <?php

                  }else if($nivel_usuario=="Tecnico"){

                  ?>
                  <li><a><i class="fa fa-folder-o"></i> Emprendedores <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ingreso_emprendedor.php">Agregar</a></li>
                      <li><a href="lista_emprendedores.php">Ver Listado</a></li>
                    </ul>
                  </li>

                  <?php

                  }

                  ?>

                  <li><a><i class="fa fa-sliders"></i>Configuracion <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="cambiar_clave.php">Cambiar contraseña</a></li>
                    </ul>
                  </li>

                </ul>
              </div>
            </div>