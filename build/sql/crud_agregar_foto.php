<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("../conexion.php");
          
          $id_emprendedor=$_POST["baccion"];
          $descripcion=$_POST["descripcion"];
          
          $dato = "";

          if(($_FILES['foto']['tmp_name'])!=""){
           $ruta = "../../Archivos";
           $ruta2 = "../../Archivos/".$id_emprendedor;
          
           function llenarArchivos($ruta3){
            $cv = null;
    
            $cv = $_FILES['foto']['tmp_name'];
            
            if(move_uploaded_file($cv, $ruta3."/".$_FILES['foto']['name'])){
                $dbfoto = $ruta3."/".$_FILES['foto']['name'];
            }
  
            return $dbfoto;    
            }
         
         if(!file_exists($ruta)){
          mkdir($ruta, 0777,true);
             if(!file_exists($ruta2)){
                 mkdir($ruta2, 0777,true);
                 if(file_exists($ruta2)){
         
                     $dato = llenarArchivos($ruta2);
                 }
             }else{
                 
                 $dato = llenarArchivos($ruta2);
             }
        }else{
          if(!file_exists($ruta2)){
              mkdir($ruta2, 0777,true);
              if(file_exists($ruta2)){
      
                  $dato = llenarArchivos($ruta2);
              }
          }else{
              
              $dato = llenarArchivos($ruta2);
          }
        }
      }
          $foto= substr($dato, 6);
          $stmt=$pdo->prepare("INSERT INTO foto (foto, descripcion, id_emprendedor) VALUES (:foto, :descripcion, :id_emprendedor)");
          $stmt->bindParam(":foto",$foto,PDO::PARAM_STR);
          $stmt->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
          $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);

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
        $id_cooperante=$_POST["actualizar"];

        $nombre_cooperante=$_POST["nombre_cooperante"];
          $monto=$_POST["monto"];
          
          
          $tipo_ayuda=$_POST["tipo_ayuda"];
          if($_POST["otro_tipo_ayuda"]!=""){
            $tipo_ayuda=$_POST["otro_tipo_ayuda"];
          }

          $fecha_ingres=$_POST["fecha_ingreso"];
          
          $id_emprendedor=$_POST["emp"];
          if($_POST["emprendedor"]!=""){
            $id_emprendedor=$_POST["emprendedor"];
          }

          if($tipo_ayuda==""){ $tipo_ayuda=$_POST["tipo_a"]; } 
          
          date_default_timezone_set('America/El_Salvador');
        
          $fecha_ingreso=$fecha_ingres;
          list($dia, $mes, $year)=explode("/", $fecha_ingres);
          $fecha_ingreso=$year."-".$mes."-".$dia;
          
          $stmt=$pdo->prepare("UPDATE cooperante SET nombre_cooperante=:nombre_cooperante, monto=:monto, tipo_ayuda=:tipo_ayuda, fecha_ingreso=:fecha_ingreso, id_emprendedor=:id_emprendedor WHERE id_cooperante=:id_cooperante");
          $stmt->bindParam(":nombre_cooperante",$nombre_cooperante,PDO::PARAM_STR);
          $stmt->bindParam(":monto",$monto,PDO::PARAM_STR);
          $stmt->bindParam(":tipo_ayuda",$tipo_ayuda,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
          $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);
          $stmt->bindParam(":id_cooperante",$id_cooperante,PDO::PARAM_INT);

          if($stmt->execute()){
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
          $id_cooperante=$_POST["id"];
      
          $stmt=$pdo->prepare("DELETE FROM cooperante WHERE id_cooperante=:id_cooperante");
          $stmt->bindParam(":id_cooperante",$id_cooperante,PDO::PARAM_INT);

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

}else{
  throw new Exception("Error Processing Request", 1);   
}
 
    echo obtenerResultado();
?>