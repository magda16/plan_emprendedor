<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){
include ("../build/conexion.php");
$nivel_usu=$_SESSION['nivel'];

  if(isset($_POST['id'])){
    $id_institucion=$_POST['id'];

        $stmt= $pdo->prepare("SELECT i.id_institucion, i.nombre, i.areas_trabajo, i.id_departamento, d.nombre AS departamento, i.id_municipio, m.nombre AS municipio, i.estado FROM institucion AS i INNER JOIN departamentos AS d ON (i.id_departamento=d.id_departamento) INNER JOIN municipios AS m ON (i.id_municipio=m.id_municipio) WHERE id_institucion=:id_institucion");
        $stmt->bindParam(":id_institucion",$id_institucion,PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $lista_institucion){     
            $nombre_r=$lista_institucion['nombre'];
            $areas_trabajo_r=$lista_institucion['areas_trabajo'];
            $id_departamento_r=$lista_institucion['id_departamento'];
            $departamento_r=$lista_institucion['departamento'];
            $id_municipio_r=$lista_institucion['id_municipio'];
            $municipio_r= $lista_institucion['municipio'];
            $estado_r=$lista_institucion['estado'];
        }
  }else{
    header('location: lista_instituciones.php');
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
                <h2><i class="fa fa-folder-open-o"></i> Instituciones</h2>
              </div>  
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Institución</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a data-toggle="tooltip" data-placement="top" title="Lista Instituciones" href="lista_instituciones.php" ><i class="fa fa-list"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <br />
                   
                    <form id="form_institucion" name="form_institucion" method="POST" class="form-horizontal form-label-left">
                      <input type="hidden" name="bandera" id="bandera">
                      <input type="hidden" id="actualizar" name="actualizar" value="<?php echo $id_institucion; ?>" >
                      <input type="hidden" id="id_departamento" name="id_departamento" value="<?php echo $id_departamento_r; ?>">
                      <input type="hidden" id="id_municipio" name="id_municipio" value="<?php echo $id_municipio_r; ?>">
                      
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_institucion">Nombre Institución: <span class="required" style="color: #CD5C5C;"> *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control has-feedback-left" id="nombre_institucion" name="nombre_institucion" required="required" placeholder="Ingrese Nombre Institución" value="<?php echo $nombre_r; ?>">
                          <span class="fa fa-building-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <span class="help-block"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="areas_trabajo">Áreas de Trabajo: <span class="required" style="color: #CD5C5C;"> *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="areas_trabajo" name="areas_trabajo" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Áreas de Trabajo"><?php echo $areas_trabajo_r; ?></textarea>
                        </div>
                        <span class="help-block" ></span>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento: <span style="color:	#000080;"> '</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-globe"></i>
                            <label class="control-label"><?php echo $departamento_r; ?></label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Municipio:  <span style="color:	#000080;"> '</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-globe"></i>
                            <label class="control-label"><?php echo $municipio_r; ?></label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" >¿Desea Cambiar Departamento?
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            </br>
                            <input type="checkbox" class="" id="depto" name="depto"/>
                          </div>
                        </div>
                        
                          <div id="div_depto" name="div_depto">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento: <span class="required" style="color: #CD5C5C;"> *</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="departamento" name="departamento">
                                </select>
                              </div>
                              <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="municipio">Municipio: <span class="required" style="color: #CD5C5C;"> *</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="municipio" name="municipio">
                                </select>
                              </div>
                              <span class="help-block"></span>
                            </div>
                          </div>
                          

                      <div class="ln_solid"></div>
                        <p style="color:RGB(205, 92, 92);">( * ) Campos Obligatorios.</p>
                        <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                          <button class="btn btn-round btn-primary" type="button" id="btneditar" name="btneditar"><i class="fa fa-refresh"></i>  Actualizar</button>
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
    <script src="../vendors/PNotify/dist/iife/PNotifyConfirm.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyMobile.js"></script>

    <!-- bootstrap-datepicker -->
    <script src="../vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Validaciones -->
    <script src="../vendors/validar/jquery.validate.js"></script>
    <!-- Validaciones Form Oficina -->
    <script src="../build/js/validaciones/form_institucion.js"></script>
    <!-- jquery.inputmask -->
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>
<?php 

}else{

  header('location: login.php');
}

?>