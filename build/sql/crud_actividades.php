<?php

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("../conexion.php");
          
          $nombre_actividad=$_POST["nombre_actividad"];
          $fecha_inici=$_POST["fecha_inicio"];
          $fecha_fi=$_POST["fecha_fin"];
          $hora_inicio=$_POST["hora_inicio"];
          $hora_fin=$_POST["hora_fin"];
          $descripcion=$_POST["descripcion"];
          $estado="Activo";
          $id_usuario=$_POST["id_usuario"];
          $transaccion="Registro";
          $descripcion_b="Actividad ".$nombre_actividad;

          date_default_timezone_set('America/El_Salvador');

          $fecha= date('Y-m-d');
        
          $fecha_inicio=$fecha_inici;
          list($dia, $mes, $year)=explode("/", $fecha_inici);
          $fecha_inicio=$year."-".$mes."-".$dia;

          $fecha_fin=$fecha_fi;
          list($dia, $mes, $year)=explode("/", $fecha_fi);
          $fecha_fin=$year."-".$mes."-".$dia;
          
          $stmt=$pdo->prepare("INSERT INTO actividad (nombre, fecha_inicio, fecha_fin, hora_inicio, hora_fin, descripcion, estado, id_usuario) VALUES (:nombre_actividad, :fecha_inicio, :fecha_fin, :hora_inicio, :hora_fin, :descripcion, :estado, :id_usuario)");
          $stmt->bindParam(":nombre_actividad",$nombre_actividad,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_inicio",$fecha_inicio,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_fin",$fecha_fin,PDO::PARAM_STR);
          $stmt->bindParam(":hora_inicio",$hora_inicio,PDO::PARAM_STR);
          $stmt->bindParam(":hora_fin",$hora_fin,PDO::PARAM_STR);
          $stmt->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);

          if($stmt->execute()){
            $stmt1=$pdo->prepare("INSERT INTO bitacora (transaccion, descripcion, fecha, id_usuario) VALUES (:transaccion, :descripcion_b, :fecha, :id_usuario)");
            $stmt1->bindParam(":transaccion",$transaccion,PDO::PARAM_STR);
            $stmt1->bindParam(":descripcion_b",$descripcion_b,PDO::PARAM_STR);
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
    }else if($bandera=="edit"){
      $msj="Error";
    
      function obtenerResultado(){
        include ("../conexion.php");
        $id_actividad=$_POST["actualizar"];

        $nombre_actividad=$_POST["nombre_actividad"];
        $fecha_inici=$_POST["fecha_inicio"];
        $fecha_fi=$_POST["fecha_fin"];
        $hora_inicio=$_POST["hora_inicio"];
        $hora_fin=$_POST["hora_fin"];
        $descripcion=$_POST["descripcion"];
        $id_usuario=$_POST["id_usuario"];
        $transaccion="Actualización";
        $descripcion_b="Actividad ".$nombre_actividad;
       
        date_default_timezone_set('America/El_Salvador');

        $fecha= date('Y-m-d');
      
        $fecha_inicio=$fecha_inici;
        list($dia, $mes, $year)=explode("/", $fecha_inici);
        $fecha_inicio=$year."-".$mes."-".$dia;

        $fecha_fin=$fecha_fi;
        list($dia, $mes, $year)=explode("/", $fecha_fi);
        $fecha_fin=$year."-".$mes."-".$dia;
        
        $stmt=$pdo->prepare("UPDATE actividad SET nombre=:nombre_actividad, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, hora_inicio=:hora_inicio, hora_fin=:hora_fin, descripcion=:descripcion WHERE id_actividad=:id_actividad");
        $stmt->bindParam(":nombre_actividad",$nombre_actividad,PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio",$fecha_inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin",$fecha_fin,PDO::PARAM_STR);
        $stmt->bindParam(":hora_inicio",$hora_inicio,PDO::PARAM_STR);
        $stmt->bindParam(":hora_fin",$hora_fin,PDO::PARAM_STR);
        $stmt->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
        $stmt->bindParam(":id_actividad",$id_actividad,PDO::PARAM_INT);

          if($stmt->execute()){
            $stmt1=$pdo->prepare("INSERT INTO bitacora (transaccion, descripcion, fecha, id_usuario) VALUES (:transaccion, :descripcion_b, :fecha, :id_usuario)");
            $stmt1->bindParam(":transaccion",$transaccion,PDO::PARAM_STR);
            $stmt1->bindParam(":descripcion_b",$descripcion_b,PDO::PARAM_STR);
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
  }else if($bandera=="dar_baja"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("../conexion.php");
        $id_actividad=$_POST["id"];
        $estado="Inactivo";
    
        $stmt=$pdo->prepare("UPDATE actividad SET estado=:estado WHERE id_actividad=:id_actividad");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_actividad",$id_actividad,PDO::PARAM_INT);

        if($stmt->execute()){
          return "Exito";
        }else{
          return "Error";
        }
        $stmt->close();
    
      return $msj;
    }
  }else if($bandera=="dar_alta"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("../conexion.php");
        $id_actividad=$_POST["id"];
        $estado="Activo";
    
        $stmt=$pdo->prepare("UPDATE actividad SET estado=:estado WHERE id_actividad=:id_actividad");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_actividad",$id_actividad,PDO::PARAM_INT);

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