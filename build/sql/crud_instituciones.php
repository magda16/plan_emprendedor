<?php

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("../conexion.php");
          
          $nombre=$_POST["nombre_institucion"];
          $areas_trabajo=$_POST["areas_trabajo"];
          $producto_servicio_emp=$_POST["producto_servicio_emp"];
          $departamento=$_POST["departamento"];
          $municipio=$_POST["municipio"];
          $estado="Activo";
          $id_usuario=$_POST["id_usuario"];
          $transaccion="Registro";
          $descripcion_b="Nombre Institución ".$nombre;

          date_default_timezone_set('America/El_Salvador');

          $fecha= date('Y-m-d');
          
          $stmt=$pdo->prepare("INSERT INTO institucion (nombre, areas_trabajo, producto_servicio_emp, id_departamento, id_municipio, estado, id_usuario) VALUES (:nombre, :areas_trabajo, :producto_servicio_emp, :departamento, :municipio, :estado, :id_usuario)");
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":areas_trabajo",$areas_trabajo,PDO::PARAM_STR);
          $stmt->bindParam(":producto_servicio_emp",$producto_servicio_emp,PDO::PARAM_STR);
          $stmt->bindParam(":departamento",$departamento,PDO::PARAM_INT);
          $stmt->bindParam(":municipio",$municipio,PDO::PARAM_INT);
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
        $id_institucion=$_POST["actualizar"];

        $nombre=$_POST["nombre_institucion"];
        $areas_trabajo=$_POST["areas_trabajo"];
        $producto_servicio_emp=$_POST["producto_servicio_emp"];
        if($_POST["departamento"]!=""){
          $departamento=$_POST["departamento"];
          $municipio=$_POST["municipio"];
        }else{
          $departamento=$_POST["id_departamento"];
          $municipio=$_POST["id_municipio"];
        }

        $id_usuario=$_POST["id_usuario"];
        $transaccion="Actualización";
          $descripcion_b="Nombre Institución ".$nombre;

          date_default_timezone_set('America/El_Salvador');

          $fecha= date('Y-m-d');
        
        $stmt=$pdo->prepare("UPDATE institucion SET nombre=:nombre, areas_trabajo=:areas_trabajo, producto_servicio_emp=:producto_servicio_emp, id_departamento=:departamento, id_municipio=:municipio WHERE id_institucion=:id_institucion");
        $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $stmt->bindParam(":areas_trabajo",$areas_trabajo,PDO::PARAM_STR);
        $stmt->bindParam(":producto_servicio_emp",$producto_servicio_emp,PDO::PARAM_STR);
        $stmt->bindParam(":departamento",$departamento,PDO::PARAM_INT);
        $stmt->bindParam(":municipio",$municipio,PDO::PARAM_INT);
        $stmt->bindParam(":id_institucion",$id_institucion,PDO::PARAM_INT);

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
          $id_institucion=$_POST["id"];
          $estado="Inactivo";
      
          $stmt=$pdo->prepare("UPDATE institucion SET estado=:estado WHERE id_institucion=:id_institucion");
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_institucion",$id_institucion,PDO::PARAM_INT);

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
          $id_institucion=$_POST["id"];
          $estado="Activo";
      
          $stmt=$pdo->prepare("UPDATE institucion SET estado=:estado WHERE id_institucion=:id_institucion");
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_institucion",$id_institucion,PDO::PARAM_INT);

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