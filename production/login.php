<?php
session_start();
include("../build/conexion.php");

$usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";
$clave=(isset($_POST["clave"]))?$_POST["clave"]:"";

if($usuario!="" and $clave!="")
{
  $sentencia= $pdo->prepare("Select id_usuario,usuario,clave,nivel from usuarios where usuario='".$usuario."'");
  $sentencia->execute();
  $datosUsuario=$sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($datosUsuario as $usuario_a){
  $clave2=$usuario_a['clave'];
  $nivel_usuario=$usuario_a['nivel'];
  $idusuario=$usuario_a['id_usuario'];
}
if($clave==$clave2){
  $_SESSION['usuario']  = $usuario;
  $_SESSION['acceso']  = "si";
  $_SESSION['nivel']  = $nivel_usuario;
  $_SESSION['id_usuario_admin']  = $idusuario;
  header("location:index.php");
  
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

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <div>
          <section class="login_content">
            <form id="form_login" name="form_login" method="POST" action="login.php">

              <!-- <img src="" width="100%" height="100%"> -->

              <h1>Iniciar Sesión</h1>

              <div class="form-group" id="result_usuario">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="usuario">Usuario: 
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control has-feedback-left" id="usuario" name="usuario" required="required" placeholder="Ingrese Usuario">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>
                <span class="help-block" id="result_usuario_error"></span>
              </div>

              <div class="form-group" id="result_clave">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 text-left" for="clave">Contraseña: 
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="password" class="form-control has-feedback-left" id="clave" name="clave" required="required" placeholder="Ingrese Contraseña">
                  <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                </div>
                <span class="help-block" id="result_clave_error"></span>
              </div>

              <div>
                <button class="btn btn-round btn-primary" type="button"  id="btningresar"><i class="fa fa-sign-in"></i>  Ingresar</button>
                
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>© 2019 Todos los Derechos Reservados.</p>
                </div>
              </div>
            </form>
          </section>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
   
    <!-- PNotify -->
    <script src="../vendors/PNotify/dist/iife/PNotify.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyButtons.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyMobile.js"></script>

    <!-- Validaciones -->
    <script src="../vendors/validar/jquery.validate.js"></script>
    <!-- Validaciones Form Login -->
    <script src="../build/js/validaciones/form_login.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>
