<?php

session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){
include ("../build/conexion.php");
$demandantes=0;
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

        <?php
        date_default_timezone_set('America/El_Salvador');
        
        // contar demandantes del mes actual
        $month=date("m");
        $year=date("Y");
        $ultimo_dia= date("d",(mktime(0,0,0,$month+1,1,$year)-1));
        $fecha_inicial= ($year."-".$month."-1");
        $fecha_final=($year."-".$month."-".$ultimo_dia);
        $sentencia1= $pdo->prepare("Select count(id_demandante) as demandantes_t from demandantes WHERE fecha_ingreso BETWEEN  '$fecha_inicial' AND '$fecha_final'");
        $sentencia1->execute();
        $datos_demandantes=$sentencia1->fetchAll(PDO::FETCH_ASSOC);
      foreach($datos_demandantes as $demandantes_a){
        $demandantes=$demandantes_a['demandantes_t'];
      }


      //contar ofertantes registrados el mes actual

      
      $sentencia2= $pdo->prepare("Select count(id_empresa) as empresas_t from empresas WHERE fecha_ingreso BETWEEN  '$fecha_inicial' AND '$fecha_final'");
      $sentencia2->execute();
      $datos_empresas=$sentencia2->fetchAll(PDO::FETCH_ASSOC);
    foreach($datos_empresas as $empresas_a){
      
      $empresas=$empresas_a['empresas_t'];
    }

    //contar ofertas registradas el mes actual

      
    $sentencia3= $pdo->prepare("Select count(id_oferta) as ofertas_t from ofertas WHERE fecha_ingreso BETWEEN  '$fecha_inicial' AND '$fecha_final'");
    $sentencia3->execute();
    $datos_ofertas=$sentencia3->fetchAll(PDO::FETCH_ASSOC);
  foreach($datos_ofertas as $ofertas_a){
    
    $ofertas=$ofertas_a['ofertas_t'];
  }


   //contar ofertas registradas el mes actual

      
   $sentencia4= $pdo->prepare("Select count(id_aplicacion) as aplicaciones_t from aplicaciones WHERE fecha_ingreso BETWEEN  '$fecha_inicial' AND '$fecha_final'");
   $sentencia4->execute();
   $datos_aplicaciones=$sentencia4->fetchAll(PDO::FETCH_ASSOC);
 foreach($datos_aplicaciones as $aplicaciones_a){
   
   $aplicaciones=$aplicaciones_a['aplicaciones_t'];
 }

        ?>
        <!-- page content -->
        <div id="panel_inicio" name="panel_inicio">
          <div class="right_col" role="main">
            <div class="">
            <?php
              if($nivel_usuario=="Gestor Empresarial"){ 
            ?>
              <div class="row top_tiles">
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-group"></i></div>
                      <div class="count"><?php echo $demandantes; ?></div>
                      <h3>Demandantes</h3>
                      <p>Demandantes ingresados este mes</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-industry"></i></div>
                      <div class="count"><?php echo $empresas; ?></div>
                      <h3>Empresas</h3>
                      <p>Empresas registradas este mes</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-fax"></i></div>
                      <div class="count"><?php echo $ofertas; ?></div>
                      <h3>Ofertas</h3>
                      <p>Ofertas ingresadas este mes</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="	fa fa-file-text"></i></div>
                      <div class="count"><?php echo $aplicaciones; ?></div>
                      <h3>Aplicaciones</h3>
                      <p>Aplicaiones de demandantes a ofertas durante el mes actual</p>
                    </div>
                  </div>
              </div>
            <?php
              }else if($nivel_usuario=="Gestor Empleo Plan"){ 
            ?>
              <div class="row top_tiles">
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-group"></i></div>
                      <div class="count"><?php echo $demandantes; ?></div>
                      <h3>Demandantes</h3>
                      <p>Demandantes ingresados este mes</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-fax"></i></div>
                      <div class="count"><?php echo $ofertas; ?></div>
                      <h3>Ofertas</h3>
                      <p>Ofertas ingresadas este mes</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="	fa fa-file-text"></i></div>
                      <div class="count"><?php echo $aplicaciones; ?></div>
                      <h3>Aplicaciones</h3>
                      <p>Aplicaiones de demandantes a ofertas durante el mes actual</p>
                    </div>
                  </div>
              </div>
            <?php
              }else if($nivel_usuario=="Gestor Empleo"){ 
            ?>
              <div class="row top_tiles">
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-group"></i></div>
                      <div class="count"><?php echo $demandantes; ?></div>
                      <h3>Demandantes</h3>
                      <p>Demandantes ingresados este mes</p>
                    </div>
                  </div>
              </div>

            <?php
              }else if($nivel_usuario=="Empresa"){ 
            ?>
              <div class="row top_tiles">
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-fax"></i></div>
                      <div class="count"><?php echo $ofertas; ?></div>
                      <h3>Ofertas</h3>
                      <p>Ofertas ingresadas este mes</p>
                    </div>
                  </div>
              </div>

            <?php
              }
            ?>
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
    
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>

  </body>
</html>
<?php 

}else{

  header('location: login.php');
}

?>