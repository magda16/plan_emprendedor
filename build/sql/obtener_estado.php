<?php
  if(isset($_REQUEST["id_d"])){

        require '../conexion.php'; 

        $id_demandante=$_POST["id_d"];
        $id_oferta=$_POST["id_o"];
     

        $stmt= $pdo->prepare("SELECT * FROM aplicaciones WHERE id_demandante=:id_demandante AND id_oferta=:id_oferta");
        $stmt->bindParam(":id_demandante",$id_demandante,PDO::PARAM_INT);
        $stmt->bindParam(":id_oferta",$id_oferta,PDO::PARAM_INT);

        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $fila){
             
              $datos = array(
                0 => $fila["estado"],
                1 => $fila["observacion"],
                
              );
            
        }
        
        echo json_encode($datos);
        
}        
?>
 