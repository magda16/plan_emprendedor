<?php
session_start();
$logueo=$_SESSION['logueado'];
if($logueo=='si'){
include ("../build/conexion.php");

if(isset($_POST['mostrar'])){
    $id_usuario=$_POST['mostrar'];

        $stmt= $pdo->prepare("SELECT u.nombre, u.apellido, u.dui, u.nit, u.usuario, u.clave, u.correo,o.id_oficina, o.nombre AS oficina, u.estado, u.nivel FROM usuarios AS u INNER JOIN oficinas AS o ON (u.id_oficina=o.id_oficina) WHERE id_usuario=:id_usuario");
        $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $lista_usuario){     
            $nombre=$lista_usuario['nombre'];
            $apellido=$lista_usuario['apellido'];
            $dui=$lista_usuario['dui'];
            $nit=$lista_usuario['nit'];
            $usuario=$lista_usuario['usuario'];
            $clave=$lista_usuario['clave'];
            $correo=$lista_usuario['correo'];
            $id_oficina=$lista_usuario['id_oficina'];
            $oficina=$lista_usuario['oficina'];
            $estado=$lista_usuario['estado'];
            $nivel=$lista_usuario['nivel'];
        }

} 
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Plan Internacional | Bolsa de Trabajo</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/PNotify/dist/PNotifyBrightTheme.css" rel="stylesheet" type="text/css" />

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- logo -->
            <?php
              include("logo.php");
            ?>
            <!-- /logo -->

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <h3 style="color:#FFFFFF" align="center">Bolsa de Trabajo</h3>
              <div class="profile_pic">
                <img src="images/user2.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                
                <h4 style="color:#FFFFFF">Bienvenido</h4>
                <h2><?php echo $_SESSION['usuario_g']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php
              include("menu_principal.php");
            ?>
            <!-- /sidebar menu -->

            
          </div>
        </div>

        <!-- top navigation -->
        <?php
          include("menu_salir.php");
        ?>
        <!-- /top navigation -->

        <!-- page content -->

        <div class="right_col" role="main">
          <div class="col-sm-12 col-sm-offset-2 col-md-8 col-md-offset-2">
            <div class="page-title">
              <div class="title_left">
                <h2><i class="fa fa-folder-open-o"></i> Usuarios</h2>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Mostrar Usuario</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a data-toggle="tooltip" data-placement="top" title="Lista Usuarios" href="lista_usuarios.php" ><i class="fa fa-list"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <br />
                   
                    <form id="form_usuario" name="form_usuario" method="POST" class="form-horizontal form-label-left">
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-user"></i>
                          <label class="control-label "><?php echo $nombre; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido">Apellido: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-user"></i>
                          <label class="control-label"><?php echo $apellido; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dui">DUI: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-list-alt"></i>
                          <label class="control-label"><?php echo $dui; ?></label>
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nit">NIT: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-list-alt"></i>
                          <label class="control-label"><?php echo $nit; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usuario">Usuario: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-user"></i>
                          <label class="control-label"><?php echo $usuario; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nivel">Nivel: <span style="color:	#000080;"> '</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-sitemap"></i>
                          <label class="control-label"><?php echo $nivel; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Oficina: <span style="color:	#000080;"> '</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-building-o"></i>
                          <label class="control-label  "><?php echo $oficina; ?> </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado: <span style="color:	#000080;"> '</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-circle-o"></i>
                          <label class="control-label"><?php echo $estado; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="correo">Correo Electrónico: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-envelope-o"></i>
                          <label class="control-label"><?php echo $correo; ?></label>
                        </div>
                      </div>
                 
                      <div class="ln_solid"></div>
                      <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                        <button class="btn btn-round btn-default" type="button" onclick="location.href='../production/lista_usuarios.php'"><i class="fa fa-undo"></i>  Regresar</button>
                      </div>
                        

                    </form> 
                    </div>
                   </div>             
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /page content -->

        <!-- footer content -->
        <?php
          include("pie_pagina.php");
        ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    
    <!-- Validaciones -->
    <script src="../vendors/validar/jquery.validate.js"></script>
    <!-- Validaciones Form Usuario -->
    <script src="../build/js/validaciones/form_usuario.js"></script>
   
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>
<?php 

}else{

  header('location: login.php');
}

?>