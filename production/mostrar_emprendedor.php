<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){
include ("../build/conexion.php");
$nivel_usu=$_SESSION['nivel'];

if(isset($_POST['mostrar'])){
  $id_emprendedor=$_POST['mostrar'];

      $stmt= $pdo->prepare("SELECT e.id_emprendedor, e.institucion, e.responsable, DATE_FORMAT(e.fecha_ingreso, '%d/%m/%Y') AS fecha_ingreso, e.nombre, e.apellido, e.sexo, e.dui, e.nit, DATE_FORMAT(e.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento, e.comunidad, e.canton, e.departamento AS id_departamento, d.nombre AS departamento, e.municipio AS id_municipio, m.nombre As municipio, e.telefono, e.correo, e.profesion, e.nivel_escolar, e.nombre_organizacion, e.actividad_eco, e.tipo_local, DATE_FORMAT(e.fecha_inicio, '%d/%m/%Y') AS fecha_inicio, e.latitud, e.longitud, e.act_eco_prin_de, e.infraestructura, e.equipo, e.productos, e.recursos_humanos, e.perfil_cliente, e.mercado_objetivo, e.competencia_mercado, e.situacion_legal, e.nombre_comercial, e.nit_negocio, e.cuenta_bancaria, e.matricula_comercio, e.factura, e.registro_iva, e.act_eco_prin_sl, e.otra, e.limitaciones FROM emprendedor AS e INNER JOIN departamentos AS d ON (e.departamento=d.id_departamento) INNER JOIN municipios AS m ON (e.municipio=m.id_municipio) WHERE e.id_emprendedor=:id_emprendedor");
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
          $sexo_r=$lista_emprendedor['sexo'];
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
                    <h2>Mostrar Emprendedor</h2>
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
                                            
                    <fieldset>
                      <h3><strong>Paso 1: <small>Ficha de Atención al Emprendedor/a</small></strong></h3>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Institución: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-circle-o"></i>
                          <label class="control-label "><?php echo $institucion_r; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Responsable: <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-user"></i>
                          <label class="control-label "><?php echo $responsable_r; ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Fecha Ingreso: día/mes/año <span style="color:	#000080;"> '</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                          <i class="fa fa-calendar-o"></i>
                          <label class="control-label "><?php echo $fecha_ingreso_r; ?></label>
                        </div>
                      </div>
                        
                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsiguiente" name="btnsiguiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                          
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 2: <small>Información del o la Emprendedor/a</small></strong></h3>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Nombre: <span style="color:	#000080;"> '</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-user"></i>
                            <label class="control-label "><?php echo $nombre_r; ?></label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Apellido: <span style="color:	#000080;"> '</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-user"></i>
                            <label class="control-label "><?php echo $apellido_r; ?></label>
                          </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Sexo: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-user"></i>
                              <label class="control-label "><?php echo $sexo_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">DUI: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-list-alt"></i>
                              <label class="control-label"><?php echo $dui_r; ?></label>
                            </div>
                          </div> 

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">NIT: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-list-alt"></i>
                              <label class="control-label"><?php echo $nit_r; ?></label>
                            </div>
                          </div>  

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Fecha de Nacimiento: día/mes/año <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 lcolor">
                              <i class="fa fa-calendar-o"></i>
                              <input type="hidden" class="form-control has-feedback-left" id="fecha_nacimiento" name="fecha_nacimiento" required="required" class="form-control col-md-7 col-xs-12" data-date-end-date = "0d" value="<?php echo $fecha_nacimiento_r; ?>">
                              <label class="control-label"><?php echo $fecha_nacimiento_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="edad">Edad: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-user"></i>
                              <label class="control-label edad"></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Comunidad: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label"><?php echo $comunidad_r; ?></label>
                            </div>
                          </div> 

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Cantón: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label"><?php echo $canton_r; ?></label>
                            </div>
                          </div> 

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 3: <small>Información del o la Emprendedor/a</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Departamento: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-globe"></i>
                              <label class="control-label"><?php echo $departamento_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Municipio:  <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-globe"></i>
                              <label class="control-label"><?php echo $municipio_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Teléfono: <span style="color:	#000080;"> '</span></label>
                            <div class="checkbox col-md-6 col-sm-6 col-xs-12 lcolor">
                            <?php
                              foreach ($telefono_r as $tel) {
                                echo "<i class='fa fa-phone'></i>  ".$tel."<br />";
                              }
                            ?>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Correo Electrónico: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-envelope-o"></i>
                              <label class="control-label"><?php echo $correo_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Profesión/Oficio: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label"><?php echo $profesion_r; ?></label>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Nivel Escolar: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label"><?php echo $nivel_escolar_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Inscrito a Organización: <span style="color:	#000080;"> '</span></label>
                            <br />
                            <div class=" col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <?php if($nombre_organizacion_r=="No") echo "<label class='control-label'> No </label>";
                               else echo "<label class='control-label'> Si </label>"; ?>
                            </div>
                          </div>

                          <?php
                            if($nombre_organizacion_r!="No"){
                          ?>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Nombre  Organización: <span style="color:	#000080;"> '</span>
                            </label><br />
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label"><?php echo $nombre_organizacion_r; ?></label>
                            </div>
                          </div>

                          <?php
                            }
                          ?>

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Local: <span style="color:	#000080;"> '</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-circle-o"></i>
                            <label class="control-label  "><?php echo $tipo_local_r; ?> </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicio: día/mes/año <span style="color:	#000080;"> '</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                            <i class="fa fa-calendar-o"></i>
                            <label class="control-label  "><?php echo $fecha_inicio_r; ?> </label>
                          </div>
                        </div>

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Latitud: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $latitud_r; ?> </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitud: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $longitud_r; ?> </label>
                            </div>
                          </div>

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 6: <small>Descripción del Emprendimiento</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Actividad Económica Principal: <span style="color:	#000080;"> '</span></label>
                            <br />
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $act_eco_prin_de_r; ?> </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Infraestructura: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $infraestructura_r; ?> </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Equipo: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $equipo_r; ?> </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Productos o Servicios: <span style="color:	#000080;"> '</span></label>
                            <br />
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $productos_r; ?> </label>
                            </div>
                          </div>

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 7: <small>Descripción del Emprendimiento</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Recursos Humanos: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $recursos_humanos_r; ?> </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Perfil de Cliente: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $perfil_cliente_r; ?> </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mercado Objetivo: <span style="color:	#000080;"> '</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label"><?php echo $mercado_objetivo_r; ?> </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Competencia de Mercado: <span style="color:	#000080;"> '</span></label>
                            <br />
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label  "><?php echo $competencia_mercado_r; ?> </label>
                            </div>
                          </div>                  

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 8: <small>Financiamiento</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Propio: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 lcolor">
                              <i class="fa fa-usd"></i>
                              <input type="hidden" class="form-control has-feedback-left" id="fi_propio" name="fi_propio" value="<?php echo $credito_r; ?>">
                              <label class="control-label"><?php echo $credito_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Crédito: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 lcolor">
                              <i class="fa fa-usd"></i>
                              <input type="hidden" class="form-control has-feedback-left" id="fi_credito" name="fi_credito" value="<?php echo $credito_r; ?>">
                              <label class="control-label"><?php echo $credito_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Sub Vención: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 lcolor">
                              <i class="fa fa-usd"></i>
                              <input type="hidden" class="form-control has-feedback-left" id="fi_sub_vencion" name="fi_sub_vencion" value="<?php echo $sub_vencion_r; ?>">
                              <label class="control-label"><?php echo $sub_vencion_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Otro: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 lcolor">
                              <i class="fa fa-usd"></i>
                              <input type="hidden" class="form-control has-feedback-left" id="fi_otro" name="fi_otro" value="<?php echo $otro_r; ?>">
                              <label class="control-label"><?php echo $otro_r; ?></label>
                            </div>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Situacón Legal: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label "><?php echo $situacion_legal_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Nombre Comercial: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-user"></i>
                              <label class="control-label "><?php echo $nombre_comercial_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">NIT del Negocio: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-list-alt"></i>
                              <label class="control-label "><?php echo $nit_negocio_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Cuenta Bancaria: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-list-alt"></i>
                              <label class="control-label "><?php echo $cuenta_bancaria_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Matrícula de Comercio: <span style="color:	#000080;"> '</span>
                            </label><br />
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-list-alt"></i>
                              <label class="control-label "><?php echo $matricula_comercio_r; ?></label>
                            </div>
                          </div>

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default siguiente" type="button" id="btnsigiente" name="btnsigiente"><i class="fa fa-arrow-circle-right"></i>  Siguiente</button>
                        </fieldset>

                        <fieldset>
                        <h3><strong>Paso 10: <small>Situación Legal</small></strong></h3>
                          
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Factura: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-list-alt"></i>
                              <label class="control-label "><?php echo $factura_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Registro IVA: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-list-alt"></i>
                              <label class="control-label "><?php echo $registro_iva_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Actividad Económica Principal: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label "><?php echo $act_eco_prin_sl_r; ?></label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Otra: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label "><?php echo $otra_r; ?></label>
                            </div>
                          </div>

                          <h3><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <small>Limitaciones</small></strong></h3>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left">Limitaciones: <span style="color:	#000080;"> '</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                              <i class="fa fa-circle-o"></i>
                              <label class="control-label "><?php echo $limitaciones_r; ?></label>
                            </div>
                          </div>

                          <div class="ln_solid"></div>
                          <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                          <button class="btn btn-round btn-default anterior" type="button" id="btnanteior" name="btnanteior"><i class="fa fa-arrow-circle-left"></i>  Anterior</button>
                          <button class="btn btn-round btn-default" type="button" onclick="location.href='../production/lista_emprendedores.php'"><i class="fa fa-undo"></i>  Regresar</button>
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
    <!-- bootstrap-datepicker -->
    <script src="../vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  
    <!-- Validaciones -->
    <script src="../vendors/validar/jquery.validate.js"></script>
    <!-- Validaciones Form Emprendedor -->
    <script src="../build/js/validaciones/form_emprendedor.js"></script>
   
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>
<?php 

}else{

  header('location: login.php');
}

?>