<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){
include ("../build/conexion.php");
$nivel_usu=$_SESSION['nivel'];

if(isset($_POST['id'])){
  $id_emprendedor=$_POST['id'];

      $stmt= $pdo->prepare("SELECT e.id_emprendedor, e.institucion, e.responsable, DATE_FORMAT(e.fecha_ingreso, '%d/%m/%Y') AS fecha_ingreso, e.nombre, e.apellido, e.dui, e.nit, DATE_FORMAT(e.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento, e.comunidad, e.canton, e.departamento AS id_departamento, d.nombre AS departamento, e.municipio AS id_municipio, m.nombre As municipio, e.telefono, e.correo, e.profesion, e.nivel_escolar, e.nombre_organizacion, e.actividad_eco, e.tipo_local, DATE_FORMAT(e.fecha_inicio, '%d/%m/%Y') AS fecha_inicio, e.latitud, e.longitud, e.act_eco_prin_de, e.infraestructura, e.equipo, e.productos, e.recursos_humanos, e.perfil_cliente, e.mercado_objetivo, e.competencia_mercado, e.situacion_legal, e.nombre_comercial, e.nit_negocio, e.cuenta_bancaria, e.matricula_comercio, e.factura, e.registro_iva, e.act_eco_prin_sl, e.otra, e.limitaciones FROM emprendedor AS e INNER JOIN departamentos AS d ON (e.departamento=d.id_departamento) INNER JOIN municipios AS m ON (e.municipio=m.id_municipio) WHERE e.id_emprendedor=:id_emprendedor");
      $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $lista_emprendedor){     
          $id_emprendedor_r=$lista_emprendedor['id_emprendedor'];
          $institucion_r=$lista_emprendedor['institucion'];
          $responsable_r=$lista_emprendedor['responsable'];
          $fecha_ingreso_r=$lista_emprendedor['fecha_ingreso'];
          $nombre_r=$lista_emprendedor['nombre'];
          $apellido_r= $lista_emprendedor['apellido'];
          $dui_r=$lista_emprendedor['dui'];
          $nit_r=$lista_emprendedor['nit'];
          $fecha_nacimiento_r=$lista_emprendedor['fecha_nacimiento'];
          $comunidad_r=$lista_emprendedor['comunidad'];
          $canton_r=$lista_emprendedor['canton'];
          $id_departamento_r=$lista_emprendedor['id_departamento'];
          $departamento_r=$lista_emprendedor['departamento'];
          $id_municipio_r=$lista_emprendedor['id_municipio'];
          $municipio_r=$lista_emprendedor['municipio'];
          $telefono_r=json_decode($lista_emprendedor['telefono'], true);
          $correo_r=$lista_emprendedor['correo'];
          $profesion_r=$lista_emprendedor['profesion'];
          $nivel_escolar_r=$lista_emprendedor['nivel_escolar'];
          $nombre_organizacion_r=$lista_emprendedor['nombre_organizacion'];
          $actividad_eco_r=$lista_emprendedor['actividad_eco'];
          $tipo_local_r=$lista_emprendedor['tipo_local'];
          $fecha_inicio_r=$lista_emprendedor['fecha_inicio'];
          $latitud_r=$lista_emprendedor['latitud'];
          $longitud_r=$lista_emprendedor['longitud'];
          $act_eco_prin_de_r=$lista_emprendedor['act_eco_prin_de'];
          $infraestructura_r=$lista_emprendedor['infraestructura'];
          $equipo_r=$lista_emprendedor['equipo'];
          $productos_r=$lista_emprendedor['productos'];
          $recursos_humanos_r=$lista_emprendedor['recursos_humanos'];
          $perfil_cliente_r=$lista_emprendedor['perfil_cliente'];
          $mercado_objetivo_r=$lista_emprendedor['mercado_objetivo'];
          $competencia_mercado_r=$lista_emprendedor['competencia_mercado'];
          $situacion_legal_r=$lista_emprendedor['situacion_legal'];
          $nombre_comercial_r=$lista_emprendedor['nombre_comercial'];
          $nit_negocio_r=$lista_emprendedor['nit_negocio'];
          $cuenta_bancaria_r=$lista_emprendedor['cuenta_bancaria'];
          $matricula_comercio_r=$lista_emprendedor['matricula_comercio'];
          $factura_r=$lista_emprendedor['factura'];
          $registro_iva_r=$lista_emprendedor['registro_iva'];
          $act_eco_prin_sl_r=$lista_emprendedor['act_eco_prin_sl'];
          $otra_r=$lista_emprendedor['otra'];
          $limitaciones_r=$lista_emprendedor['limitaciones'];
      }

      $stmt= $pdo->prepare("SELECT * FROM financiamiento WHERE id_emprendedor=:id_emprendedor");
      $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $lista_emprendedor){   
          $id_financiamiento_r=$lista_emprendedor['id_financiamiento'];
          $propio_r=$lista_emprendedor['propio'];
          $credito_r=$lista_emprendedor['credito'];
          $sub_vencion_r=$lista_emprendedor['sub_vencion'];
          $otro_r=$lista_emprendedor['otro'];
      }

}else{
  header('location: lista_emprendedores.php');
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

    <title>Plan Internacional </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
     
    <!-- PNotify -->
    <link href="../vendors/PNotify/dist/PNotifyBrightTheme.css" rel="stylesheet" type="text/css" />

    <!-- bootstrap-datepicker -->
    <link href="../vendors/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">

    <style type="text/css">
      #form_emprendedor fieldset:not(:first-of-type) {
      display: none;
    }
    </style>
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
                <h2><i class="fa fa-folder-open-o"></i> Emprendedores</h2>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Emprendedor</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a data-toggle="tooltip" data-placement="top" title="Lista Emprendedores" href="lista_emprendedores.php" ><i class="fa fa-list"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>

                  <form id="form_emprendedor" name="form_emprendedor" method="POST" class="form-horizontal form-label-left">
                      <input type="hidden" name="bandera" id="bandera">
                      <input type="hidden" id="actualizar" name="actualizar" value="<?php echo $id_emprendedor_r; ?>" >
                      <input type="hidden" id="id_departamento" name="id_departamento" value="<?php echo $id_departamento_r; ?>">
                      <input type="hidden" id="id_municipio" name="id_municipio" value="<?php echo $id_municipio_r; ?>">
                      <input type="hidden" id="dno" name="dno" value="<?php echo $nombre_organizacion_r; ?>">
                      <input type="hidden" id="act_eco" name="act_eco" value="<?php echo $actividad_eco_r; ?>">
                      <input type="hidden" id="tipo_l" name="tipo_l" value="<?php echo $tipo_local_r; ?>">
                      
                      
                    <fieldset>
                        <h3><strong>Paso 1: <small>Ficha de Atención al Emprendedor/a</small></strong></h3>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="institucion">Institución:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="institucion" name="institucion" required="required" placeholder="Ingrese Institución" value="<?php echo $institucion_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="responsable">Responsable:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="responsable" name="responsable" required="required" placeholder="Ingrese Responsable" value="<?php echo $responsable_r; ?>">
                              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_ingreso">Fecha: día/mes/año
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fecha_ingreso" name="fecha_ingreso" required="required" class="form-control col-md-7 col-xs-12" data-date-end-date = "0d" value="<?php echo $fecha_ingreso_r; ?>">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="ln_solid"></div>
                          
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsiguiente" name="btnsiguiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                          
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 2: <small>Información del o la Emprendedor/a</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="nombre">Nombre:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="nombre" name="nombre" required="required" placeholder="Ingrese Nombre" value="<?php echo $nombre_r; ?>">
                              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido">Apellido:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="apellido" name="apellido" required="required" placeholder="Ingrese Apellido" value="<?php echo $apellido_r; ?>">
                              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dui">DUI:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="dui" name="dui" data-inputmask="'mask': '99999999-9'" required="required" class="form-control col-md-7 col-xs-12" placeholder="Digite DUI" value="<?php echo $dui_r; ?>">
                              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div> 

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nit">NIT:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="nit" name="nit" data-inputmask="'mask': '9999-999999-999-9'" required="required" class="form-control col-md-7 col-xs-12" placeholder="Digite NIT" value="<?php echo $nit_r; ?>">
                              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group" id="error_e">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_nacimiento">Fecha de Nacimiento: día/mes/año 
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fecha_nacimiento" name="fecha_nacimiento" required="required" class="form-control col-md-7 col-xs-12" data-date-end-date = "0d" value="<?php echo $fecha_nacimiento_r; ?>">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block" id="error"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edad">Edad: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-user"></i>
                              <label class="control-label edad"></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="comunidad">Comunidad: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="comunidad" name="comunidad" required="required" placeholder="Ingrese Comunidad" value="<?php echo $comunidad_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="canton">Cantón: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="canton" name="canton" required="required" placeholder="Ingrese Cantón" value="<?php echo $canton_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 3: <small>Información del o la Emprendedor/a</small></strong></h3>

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

                          <div id="div_tel" name="div_tel">
                          <?php
                          $cont_t=0;
                              foreach ($telefono_r as $tel) {
                                
                                if($cont_t==0){
                          ?>

                          
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono:
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="text" class="form-control has-feedback-left telefono" id="telefono_0" name= "telefono[]" data-inputmask="'mask': '9999-9999'" required="required" placeholder="Digite Número de Teléfono" value="<?php echo $tel; ?>">
                              <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                              <a class="btn btn-primary" id="a_t" name="a_t" data-toggle="tooltip" data-placement="top" title="Agregar Teléfono"><i class='fa fa-plus'></i></a>
                            </div>
                            <span class="help-block"></span>
                          </div>


                            <?php
                                  $cont_t++;
                                }else{
                            ?>
                            <div class="form-group" id="div_<?php echo $cont_t; ?>" name="div_<?php echo $cont_t; ?>">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono:
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="text" class="form-control has-feedback-left telefono" id="telefono_<?php echo $cont_t; ?>" name= "telefono[]" data-inputmask="'mask': '9999-9999'" required="required" placeholder="Digite Número de Teléfono" value="<?php echo $tel; ?>">
                              <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                            <ACRONYM title='Eliminar Teléfono'><a class="btn btn-danger" onclick="eliminar_tel(<?php echo $cont_t; ?>)"><i class="fa fa-trash-o"></i></a></ACRONYM>
                            </div>
                            <span class="help-block"></span>
                          </div>
                            <?php
                                $cont_t++;
                      
                                }
                              }
                            ?>
                          </div>
                          <input type="hidden" id="cont_tel" name="cont_tel" value="<?php echo $cont_t; ?>">

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="correo">Correo Electrónico: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="correo" name= "correo" required="required" placeholder="Ingrese Correo Electrónico" value="<?php echo $correo_r; ?>">
                              <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="profesion">Profesión/Oficio:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="profesion" name="profesion" required="required" placeholder="Ingrese Profesión/Oficio" value="<?php echo $profesion_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="nivel_escolar">Nivel Escolar:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="nivel_escolar" name="nivel_escolar" required="required" placeholder="Ingrese Nivel Escolar" value="<?php echo $nivel_escolar_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Inscrito a Organización: </label>
                            <br />
                            <div class=" col-md-6 col-sm-6 col-xs-12">
                              <label>
                              <input type="radio"  id="inscrito_organizacion" name="inscrito_organizacion" value="No" <?php if($nombre_organizacion_r=="No") echo "checked"; ?> > No </label>
                              <label>
                              <input type="radio"  id="inscrito_organizacion" name="inscrito_organizacion" value="Si" <?php if($nombre_organizacion_r!="No") echo "checked"; ?> > Si </label>
                            </div>
                          </div>

                          <div class="form-group" id="div_no" name="div_no">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="nombre_organizacion">Nombre Organización:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="nombre_organizacion" name="nombre_organizacion" required="required" placeholder="Ingrese Nombre Organización" value="<?php echo $nombre_organizacion_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="ln_solid"></div>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 4: <small>Datos del Emprendimiento</small></strong></h3>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Actividad Económica: <span style="color:	#000080;"> '</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-circle-o"></i>
                            <label class="control-label  "><?php echo $actividad_eco_r; ?> </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" >¿Desea Cambiar Actividad Económica?
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            </br>
                            <input type="checkbox" class="" id="cae" name="cae"/>
                          </div>
                        </div>
                        <div id="div_mae" name="div_mae">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Actividad Económica: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="actividad_eco" name="actividad_eco">
                              <option selected="selected" value="">Seleccione Actividad Económica</option>
                                <option value="APICULTURA">APICULTURA</option>
                                <option value="PECES">PECES</option>
                                <option value="FRUTAS">FRUTAS</option>
                                <option value="ARTESANIAS">ARTESANIAS</option>
                                <option value="VIVEROS">VIVEROS</option>
                                <option value="HORTALIZAS">HORTALIZAS</option>
                                <option value="LACTEOS">LACTEOS</option>
                                <option value="CARNICOS">CARNICOS</option>
                                <option value="ALIMENTOS">ALIMENTOS</option>
                                <option value="CONFECCION EN MADERA">CONFECCION EN MADERA</option>
                                <option value="CONFECCION EN METAL">CONFECCION EN METAL</option>
                                <option value="SERVICIOS TECNICOS">SERVICIOS TECNICOS</option>
                                <option value="TEXTILES">TEXTILES</option>
                                <option value="CALZADO">CALZADO</option>
                                <option value="CONFECCION TELA">CONFECCION TELA</option>
                                <option value="PRODUCTOS QUIMICOS">PRODUCTOS QUIMICOS</option>
                                <option value="otra_ae">OTRA</option>
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group" id="div_ae" name="div_ae">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="otra_actividad_eco">Otra Actividad Económica: 
                            </label><br />
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="otra_actividad_eco" name="otra_actividad_eco" required="required" placeholder="Ingrese Otra Actividad Económica">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Local: <span style="color:	#000080;"> '</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-circle-o"></i>
                            <label class="control-label  "><?php echo $tipo_local_r; ?> </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" >¿Desea Cambiar Tipo Local?
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            </br>
                            <input type="checkbox" class="" id="ctl" name="ctl"/>
                          </div>
                        </div>
                          
                          <div id="div_mtl" name="div_mtl">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Local: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="tipo_local" name="tipo_local">
                              <option selected="selected" value="">Seleccione Tipo Local</option>
                                <option value="Propio">Propio</option>
                                <option value="Arrendado">Arrendado</option>
                                <option value="otro_tl">Otro</option>
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group" id="div_tl" name="div_tl">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="otro_tipo_local">Otro Tipo Local: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="otro_tipo_local" name="otro_tipo_local" required="required" placeholder="Ingrese Otro Tipo Local" value="<?php echo $tipo_local_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_inicio">Fecha: día/mes/año
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fecha_inicio" name="fecha_inicio" required="required" class="form-control col-md-7 col-xs-12" data-date-end-date = "0d" value="<?php echo $fecha_inicio_r; ?>">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>
                          <div class="ln_solid"></div>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 5: <small>Ubicación Geográfica</small></strong></h3>

                          <br />
                          <div class="embed-responsive embed-responsive-4by3">
                            <iframe class="embed-responsive-item" src="ej.php" allowfullscreen></iframe>
                          </div>  

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="latitud">Latitud:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="latitud" name="latitud" required="required" placeholder="Ingrese Latitud" value="<?php echo $latitud_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="longitud">Longitud:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="longitud" name="longitud" required="required" placeholder="Ingrese Longitud" value="<?php echo $longitud_r; ?>">
                              <span class="fa fa-circle-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="ln_solid"></div>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 6: <small>Descripción del Emprendimiento</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="act_eco_prin_de">Actividad Económica Principal: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="act_eco_prin_de" name="act_eco_prin_de" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Actividad Económica Principal"><?php echo $act_eco_prin_de_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="infraestructura">Infraestructura: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="infraestructura" name="infraestructura" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Infraestructura"><?php echo $infraestructura_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipo">Equipo:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="equipo" name="equipo" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Equipo"><?php echo $equipo_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productos">Productos o Servicios: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="productos" name="productos" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Productos o Servicios"><?php echo $productos_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="ln_solid"></div>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 7: <small>Descripción del Emprendimiento</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="recursos_humanos">Recursos Humanos: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="recursos_humanos" name="recursos_humanos" class="form-control col-md-7 col-xs-12" required="required" placeholder="Recursos Humanos"><?php echo $recursos_humanos_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="perfil_cliente">Perfil de Cliente: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="perfil_cliente" name="perfil_cliente" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Perfil de Cliente"><?php echo $perfil_cliente_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mercado_objetivo">Mercado Objetivo:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="mercado_objetivo" name="mercado_objetivo" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Mercado Objetivo"><?php echo $mercado_objetivo_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="competencia_mercado">Competencia de Mercado: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="competencia_mercado" name="competencia_mercado" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Competencia de Mercado"><?php echo $competencia_mercado_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="ln_solid"></div>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 8: <small>Financiamiento</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="fi_propio">Propio:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fi_propio" name="fi_propio" required="required" placeholder="Ingrese Financiamiento Propio" value="<?php echo $propio_r; ?>">
                              <span class="fa fa-usd form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="fi_credito">Crédito:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fi_credito" name="fi_credito" required="required" placeholder="Ingrese Financiamiento Crédito" value="<?php echo $credito_r; ?>">
                              <span class="fa fa-usd form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="fi_sub_vencion">Sub Vención:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fi_sub_vencion" name="fi_sub_vencion" required="required" placeholder="Ingrese Financiamiento Sub Vención" value="<?php echo $sub_vencion_r; ?>">
                              <span class="fa fa-usd form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="fi_otro">Otro:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="fi_otro" name="fi_otro" required="required" placeholder="Ingrese Otro Financiamiento" value="<?php echo $otro_r; ?>">
                              <span class="fa fa-usd form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">Total: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-usd"></i>
                              <label class="control-label total"></label>
                            </div>
                          </div>
                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 9: <small>Situación Legal</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Situacón Legal: </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="situacion_legal" name="situacion_legal">
                              <option selected="selected" value="">Seleccione Tipo Situacón Legal</option>
                                <option value="Formal" <?php if($situacion_legal_r=="Formal") echo "selected"; ?> >Formal</option>
                                <option value="Informal" <?php if($situacion_legal_r=="Informal") echo "selected"; ?> >Informal</option>
                              </select>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_comercial">Nombre Comercial:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="nombre_comercial" name="nombre_comercial" required="required" placeholder="Ingrese Nombre Comercial" value="<?php echo $nombre_comercial_r; ?>">
                              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nit_negocio">NIT del Negocio:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control has-feedback-left" id="nit_negocio" name="nit_negocio" data-inputmask="'mask': '9999-999999-999-9'" required="required" class="form-control col-md-7 col-xs-12" placeholder="Digite NIT del Negocio" value="<?php echo $nit_negocio_r; ?>">
                                <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cuenta_bancaria"">Cuenta Bancaria:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="cuenta_bancaria" name="cuenta_bancaria" required="required" placeholder="Ingrese Cuenta Bancaria" value="<?php echo $cuenta_bancaria_r; ?>">
                              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matricula_comercio">Matrícula de Comercio:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="matricula_comercio" name="matricula_comercio" required="required" placeholder="Ingrese Matrícula de Comercio" value="<?php echo $matricula_comercio_r; ?>">
                              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="ln_solid"></div>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 10: <small>Situación Legal</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="factura">Factura:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="factura" name="factura" required="required" placeholder="Ingrese Factura" value="<?php echo $factura_r; ?>">
                              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="registro_iva">Registro IVA:
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control has-feedback-left" id="registro_iva" name="registro_iva" required="required" placeholder="Ingrese Registro IVA" value="<?php echo $registro_iva_r; ?>">
                              <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="act_eco_prin_sl">Actividad Económica Principal: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="act_eco_prin_sl" name="act_eco_prin_sl" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Actividad Económica Principal"><?php echo $act_eco_prin_sl_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="otra">Otra: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="otra" name="otra" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Otra"><?php echo $otra_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>

                          <h3><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <small>Limitaciones</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="limitaciones">Limitaciones: 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="limitaciones" name="limitaciones" class="form-control col-md-7 col-xs-12" required="required" placeholder="Ingrese Limitaciones"><?php echo $limitaciones_r; ?></textarea>
                            </div>
                            <span class="help-block" ></span>
                          </div>



                          <div class="ln_solid"></div>
                          
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-primary" type="button" id="btneditar" name="btneditar"><i class="fa fa-refresh"></i>  Actualizar</button>
                        </fieldset>

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
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  
    
    <!-- PNotify -->
    <script src="../vendors/PNotify/dist/iife/PNotify.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyButtons.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyConfirm.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyMobile.js"></script>

    <!-- bootstrap-datepicker -->
    <script src="../vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Validaciones -->
    <script src="../vendors/validar/jquery.validate.js"></script>
    <!-- Validaciones Form Demandante -->
    <script src="../build/js/validaciones/form_emprendedor.js"></script>
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