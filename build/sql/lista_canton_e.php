<?php
    
    if(isset($_POST['id_departamento'])){
        function obtenerCanton(){
        $id_departamento = $_POST['id_departamento'];
        $id_municipio = $_POST['id_municipio'];
        require '../conexion.php';
            $stmt= $pdo->prepare("SELECT DISTINCT canton FROM emprendedor WHERE departamento=:id_departamento AND municipio=:id_municipio");
            $stmt->bindParam(":id_departamento",$id_departamento,PDO::PARAM_INT);
            $stmt->bindParam(":id_municipio",$id_municipio,PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            $listas = "<option value=''>Seleccione Cantón</option>";
            if ($result) {
                foreach($result as $lista_canton){
                $listas .= "<option value='".$lista_canton['canton']."'>".$lista_canton['canton']."</option>";
                }//fin for
                return $listas;
            }
        }
    }

    echo obtenerCanton();
?> 