<?php
  session_start();
  $logueo=$_SESSION['acceso'];
  if($logueo=='si'){
    include ("../build/conexion.php");
    $nivel_usu=$_SESSION['nivel'];
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Plan Internacional</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/PNotify/dist/PNotifyBrightTheme.css" rel="stylesheet" type="text/css" />

    <!-- bootstrap-datepicker -->
    <link href="../vendors/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

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
                <h2><i class="fa fa-folder-open-o"></i> Mapa</h2>
              </div>  
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Mapa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a data-toggle="tooltip" data-placement="top" title="Lista Ayudas Recibidas" href="lista_ayudas_recibidas.php" ><i class="fa fa-list"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <br />
                   
                    <form id="form_actividad" name="form_actividad" method="POST" class="form-horizontal form-label-left">
                      <input type="hidden" name="bandera" id="bandera">
                      
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Mostrar Mapa por: </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="mostrar_mapa" name="mostrar_mapa">
                              <option selected="selected" value="">Seleccione Criterio</option>
                              <option value="Genero">Género</option>
                              <option value="Edad">Edad</option>
                            </select>
                          </div>
                          <span class="help-block"></span>
                        </div>

                        <div class="form-group" id="div_genero" name="div_genero">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Género: </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="genero" name="genero">
                              <option selected="selected" value="">Seleccione Género</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                            </select>
                          </div>
                          <span class="help-block"></span>
                        </div>

                       


                      <div class="ln_solid"></div>
                        <p style="color:RGB(205, 92, 92);">( * ) Campos Obligatorios.</p>
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                            <button class="btn btn-round btn-primary" type="button" id="btnguardar" name="btnguardar"><i class="fa fa-save"></i>  Guardar</button>
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
    <!-- PNotify -->
    <script src="../vendors/PNotify/dist/iife/PNotify.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyButtons.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyMobile.js"></script>

    <!-- bootstrap-datepicker -->
    <script src="../vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Validaciones -->
    <script src="../vendors/validar/jquery.validate.js"></script>
    <!-- Validaciones Form Oficina -->
    <script src="../build/js/validaciones/form_mapa_emprendedores.js"></script>
   

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>
<?php 

}else{

  header('location: login.php');
}

?>