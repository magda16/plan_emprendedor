<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){
include ("../build/conexion.php");
$nivel_usu=$_SESSION['nivel'];

  if(isset($_POST['mostrar'])){
    $id_cooperante=$_POST['mostrar'];

        $stmt= $pdo->prepare("SELECT c.nombre_cooperante, c.monto, c.tipo_ayuda, DATE_FORMAT(c.fecha_ingreso, '%d/%m/%Y') AS fecha_ingreso, c.id_emprendedor, e.nombre, e.apellido FROM cooperante AS c INNER JOIN emprendedor AS e ON (c.id_emprendedor=e.id_emprendedor) WHERE c.id_cooperante=:id_cooperante");
        $stmt->bindParam(":id_cooperante",$id_cooperante,PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $lista_cooperante){     
            $nombre_cooperante_r=$lista_cooperante['nombre_cooperante'];
            $monto_r=$lista_cooperante['monto'];
            $tipo_ayuda_r=$lista_cooperante['tipo_ayuda'];
            $fecha_ingreso_r= $lista_cooperante['fecha_ingreso'];
            $id_emprendedor_r=$lista_cooperante['id_emprendedor'];
            $emprendedor_r=$lista_cooperante['nombre']. " " .$lista_cooperante['apellido'];
        }
  }else{
    header('location: lista_ayudas_recibidas.php');
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
                <h2><i class="fa fa-folder-open-o"></i> Ayudas Recibidas</h2>
              </div>  
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Mostrar Ayudas Recibidas</h2>
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
                   
                    <form id="form_ayuda_recibida" name="form_ayuda_recibida" method="POST" class="form-horizontal form-label-left">
                      

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_cooperante">Nombre Cooperante: <span style="color:	#000080;"> '</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                        <i class="fa fa-building-o"></i>
                        <label class="control-label "><?php echo $nombre_cooperante_r; ?></label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monto">Monto: <span style="color:	#000080;"> '</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                        <i class="fa fa-usd"></i>
                        <label class="control-label "><?php echo $nombre_cooperante_r; ?></label>
                      </div>
                    </div>
                     
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Ayuda: <span style="color:	#000080;"> '</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                        <i class="fa fa-circle-o"></i>
                        <label class="control-label  "><?php echo $tipo_ayuda_r; ?> </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_ingreso">Fecha: día/mes/año <span style="color:	#000080;"> '</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                        <i class="fa fa-calendar-o"></i>
                        <label class="control-label "><?php echo $fecha_ingreso_r; ?></label>
                      </div>
                    </div>     
              
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Emprendedor: <span style="color:	#000080;"> '</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12 lcolor">
                        <i class="fa fa-user"></i>
                        <label class="control-label  "><?php echo $emprendedor_r; ?></label>
                      </div>
                    </div>
                    
                      <div class="ln_solid"></div>
                        <p style="color: RGB(0, 0, 128);">( ' ) Campos no Editables.</p>
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                          <button class="btn btn-round btn-default" type="button" onclick="location.href='../production/lista_ayudas_recibidas.php'"><i class="fa fa-undo"></i>  Regresar</button>
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
    

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>
<?php 

}else{

  header('location: login.php');
}

?>