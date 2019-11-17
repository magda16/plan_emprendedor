<?php

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("../conexion.php");
          
          $nombre=$_POST["nombre_institucion"];
          $areas_trabajo=$_POST["areas_trabajo"];
          $departamento=$_POST["departamento"];
          $municipio=$_POST["municipio"];
          $estado="Activo";
          $id_usuario=$_POST["id_usuario"];
          
          $stmt=$pdo->prepare("INSERT INTO institucion (nombre, areas_trabajo, id_departamento, id_municipio, estado, id_usuario) VALUES (:nombre, :areas_trabajo, :departamento, :municipio, :estado, :id_usuario)");
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":areas_trabajo",$areas_trabajo,PDO::PARAM_STR);
          $stmt->bindParam(":departamento",$departamento,PDO::PARAM_INT);
          $stmt->bindParam(":municipio",$municipio,PDO::PARAM_INT);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);

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
        $id_institucion=$_POST["actualizar"];

        $nombre=$_POST["nombre_institucion"];
        $areas_trabajo=$_POST["areas_trabajo"];
        if($_POST["departamento"]!=""){
          $departamento=$_POST["departamento"];
          $municipio=$_POST["municipio"];
        }else{
          $departamento=$_POST["id_departamento"];
          $municipio=$_POST["id_municipio"];
        }
        
        $stmt=$pdo->prepare("UPDATE institucion SET nombre=:nombre, areas_trabajo=:areas_trabajo, id_departamento=:departamento, id_municipio=:municipio WHERE id_institucion=:id_institucion");
        $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $stmt->bindParam(":areas_trabajo",$areas_trabajo,PDO::PARAM_STR);
        $stmt->bindParam(":departamento",$departamento,PDO::PARAM_INT);
        $stmt->bindParam(":municipio",$municipio,PDO::PARAM_INT);
        $stmt->bindParam(":id_institucion",$id_institucion,PDO::PARAM_INT);

          if($stmt->execute()){
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