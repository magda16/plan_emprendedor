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
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <br />
                   
                    <form id="form_mostrar_mapa" name="form_mostrar_mapa" action="mapas.php" target="_blank" method="POST" class="form-horizontal form-label-left">
                      <input type="hidden" name="bandera" id="bandera">
                      
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Mostrar Mapa por: <span class="required" style="color: #CD5C5C;"> *</span></label>
                            <div class="checkbox col-md-6 col-sm-6 col-xs-12">
                              <label>
                              <input type="checkbox" class="" id="genero_c" name="criterio[]"> Género </label>
                              <br />
                              <label>
                              <input type="checkbox" class="" id="edad_c" name="criterio[]"> Edad </label>
                              <br />
                              <label>
                              <input type="checkbox" class="" id="ubicacion_c" name="criterio[]"> Ubicación </label>
                              <br />
                              <label>
                              <input type="checkbox" class="" id="actividad_economica_c" name="criterio[]"> Actividad Económica </label>
                              <br />
                              <label>
                              <input type="checkbox" class="" id="tiempo_operacion_c" name="criterio[]"> Tiempo de Operacón </label>
                              <br />
                              <label>
                            </div>
                            <span class="help-block"></span>
                          </div>
                        
                        <br />

                        <div class="form-group" id="div_genero" name="div_genero">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Género: </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="genero" name="genero">
                              <option selected="selected" value="">Seleccione Género</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                              <option value="Otro">Otro</option>
                            </select>
                          </div>
                          <span class="help-block"></span>
                        </div>

                        <div id="div_edad" name="div_edad">

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="desde">Desde: <span class="required" style="color: #CD5C5C;"> *</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="desde" name="desde" required="required" placeholder="Ingrese Desde">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="hasta">Hasta: <span class="required" style="color: #CD5C5C;"> *</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="hasta" name="hasta" required="required" placeholder="Ingrese Hasta">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                        </div>

                        <div id="div_ubicacion" name="div_ubicacion">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="departamento" name="departamento">
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>
                          
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="municipio">Municipio: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="municipio" name="municipio">
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="canton">Cantón: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="canton" name="canton">
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comunidad">Comunidad: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="comunidad" name="comunidad">
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>

                        <div id="div_actividad_economica" name="div_actividad_economica">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="actividad_economica">Actividad Económica: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="actividad_economica" name="actividad_economica">
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>

                        <div id="div_tiempo_operacion" name="div_tiempo_operacion">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_inicio">Fecha Inicio: día/mes/año
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fecha_inicio" name="fecha_inicio" required="required" class="form-control col-md-7 col-xs-12" data-date-end-date = "0d">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>

                        <div class="clearfix"></div>
 
                        <div class="ln_solid"></div>
                          <p style="color:RGB(205, 92, 92);">( * ) Campos Obligatorios.</p>
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                            <a type="button" id="btnmapa" name="btnmapa" class="btn btn-app" name="procesar">
                              <i class="fa fa-repeat"></i> Generar Informe
                            </a>
                          </div>
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