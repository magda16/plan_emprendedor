<?php

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("../conexion.php");
          
          $nombre=$_POST["nombre"];
          $apellido=$_POST["apellido"];
          $dui=$_POST["dui"];
          $nit=$_POST["nit"];
          $usuario=$_POST["usuario"];
          $clave=$_POST["clave"];
          $correo=$_POST["correo"];
          $nivel=$_POST["nivel"];
          $estado="Activo";
          $respuesta_secreta="";

          if(empty($_POST["jefe"])){
            $id_jefe=0;
          } else {
            $id_jefe=$_POST["jefe"];
          }

          
          $stmt=$pdo->prepare("INSERT INTO usuarios (nombre, apellido, dui, nit, usuario, clave, correo, nivel, estado, respuesta_secreta, id_jefe) VALUES (:nombre, :apellido, :dui, :nit, :usuario, :clave, :correo, :nivel, :estado, :respuesta_secreta, :id_jefe)");
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":apellido",$apellido,PDO::PARAM_STR);
          $stmt->bindParam(":dui",$dui,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":usuario",$usuario,PDO::PARAM_STR);
          $stmt->bindParam(":clave",$clave,PDO::PARAM_STR);
          $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
          $stmt->bindParam(":nivel",$nivel,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":respuesta_secreta",$respuesta_secreta,PDO::PARAM_STR);
          $stmt->bindParam(":id_jefe",$id_jefe,PDO::PARAM_INT);

          if($stmt->execute()){
            return "Exito";
          }else{
            return "Error";
          }
          $stmt->close();
        
          return $msj;
        }
    }else if($bandera=="edit"){
      $msj="Error";
    
      function obtenerResultado(){
        include ("../conexion.php");
        $id_usuario=$_POST["actualizar"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $dui=$_POST["dui"];
        $nit=$_POST["nit"];
        $usuario=$_POST["usuario"];
        $estado=$_POST["estado"];
        $clave=$_POST["clave"];
        $correo=$_POST["correo"];
        $respuesta_secreta="";

        /*if(empty($_POST["empresa"])){
          if($nivel=="Empresa"){
            $id_empresa=$_POST["id_empresa"];
          }else{
            $id_empresa=0;
          }
        } else {
          $id_empresa=$_POST["empresa"];
        }*/
        
        
         
          $stmt=$pdo->prepare("UPDATE usuarios SET 
          nombre=:nombre, 
          apellido=:apellido, 
          dui=:dui, 
          nit=:nit, 
          usuario=:usuario, 
          clave=:clave, 
          correo=:correo, 
          estado=:estado, 
          respuesta_secreta=:respuesta_secreta WHERE id_usuario=:id_usuario");
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":apellido",$apellido,PDO::PARAM_STR);
          $stmt->bindParam(":dui",$dui,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":usuario",$usuario,PDO::PARAM_STR);
          $stmt->bindParam(":clave",$clave,PDO::PARAM_STR);
          $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":respuesta_secreta",$respuesta_secreta,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);

          if($stmt->execute()){
            return "Exito";
          }else{
            return "Error";
          }
          $stmt->close();
      
        return $msj;
      }
  }else if($bandera=="edit_clave"){
    $msj="Error";
  
    function obtenerResultado(){
      include ("../conexion.php");
      $id_usuario=$_POST["id_usuario"];
      $clave=$_POST["clave"];
      $nueva_clave=$_POST["nueva_clave"];
      $transaccion="Actualización";
      $descripcion="Cambio de Contraseña";

      date_default_timezone_set('America/El_Salvador');
        
      $fecha= date('Y-m-d');

        $stmt=$pdo->prepare("UPDATE usuarios SET clave=:nueva_clave WHERE clave=:clave AND id_usuario=:id_usuario");
        $stmt->bindParam(":clave",$clave,PDO::PARAM_STR);
        $stmt->bindParam(":nueva_clave",$nueva_clave,PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
        $stmt->execute();
        $fila=$stmt->rowCount();
        if($fila > 0){
          $stmt1=$pdo->prepare("INSERT INTO bitacora (transaccion, descripcion, fecha, id_usuario) VALUES (:transaccion, :descripcion, :fecha, :id_usuario)");
          $stmt1->bindParam(":transaccion",$transaccion,PDO::PARAM_STR);
          $stmt1->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
          $stmt1->bindParam(":fecha",$fecha,PDO::PARAM_STR);
          $stmt1->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
          $stmt1->execute();
          return "Exito";
        }else{
          return "Error";
        }
        $stmt->close();
    
      return $msj;
    }
  }else if($bandera=="delete"){
      $msj="Error";
    
      function obtenerResultado(){
          include ("../conexion.php");
          $id_usuario=$_POST["id"];
      
          $stmt=$pdo->prepare("DELETE FROM usuarios WHERE id_usuario=:id_usuario");
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);

          if($stmt->execute()){
            return "Exito";
          }else{
            return "Error";
          }
          $stmt->close();
      
        return $msj;
      }
    }

  }
 
    echo obtenerResultado();
?>